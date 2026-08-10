<?php
require_once __DIR__ . '/../config/Database.php';

class Cuestionario
{
    private $conn;

    public function __construct()
    {
        $this->conn = Database::getInstance()->getConnection();
    }

    public function getAreas()
    {
        $result = $this->conn->query(
            "SELECT area_id, nombre, label, icono, color, descripcion
             FROM areas
             ORDER BY area_id"
        );
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getTotalPreguntas()
    {
        $result = $this->conn->query("SELECT COUNT(*) AS total FROM preguntas");
        return (int) $result->fetch_assoc()['total'];
    }

    /**
     * Devuelve todas las preguntas con sus opciones.
     * Las opciones no exponen el área para no influir en el usuario.
     */
    public function getPreguntasConOpciones()
    {
        $preguntas = [];
        $result = $this->conn->query(
            "SELECT pregunta_id, modulo, enunciado, orden
             FROM preguntas
             ORDER BY orden"
        );

        while ($pregunta = $result->fetch_assoc()) {
            $stmt = $this->conn->prepare(
                "SELECT opcion_id, texto
                 FROM opciones
                 WHERE pregunta_id = ?
                 ORDER BY opcion_id"
            );
            $stmt->bind_param('i', $pregunta['pregunta_id']);
            $stmt->execute();
            $pregunta['opciones'] = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
            $preguntas[] = $pregunta;
        }

        return $preguntas;
    }

    /**
     * Guarda (o actualiza) las respuestas del usuario.
     * $respuestas: array de ['pregunta_id' => X, 'opcion_id' => Y]
     * Valida que cada opción pertenezca a su pregunta.
     */
    public function guardarRespuestas($usuarioId, $respuestas)
    {
        $count = 0;

        foreach ($respuestas as $respuesta) {
            $preguntaId = (int) ($respuesta['pregunta_id'] ?? 0);
            $opcionId = (int) ($respuesta['opcion_id'] ?? 0);

            if ($preguntaId <= 0 || $opcionId <= 0) {
                continue;
            }

            $validar = $this->conn->prepare(
                "SELECT 1 FROM opciones WHERE opcion_id = ? AND pregunta_id = ? LIMIT 1"
            );
            $validar->bind_param('ii', $opcionId, $preguntaId);
            $validar->execute();
            if (!$validar->get_result()->fetch_row()) {
                continue;
            }

            $stmt = $this->conn->prepare(
                "INSERT INTO respuestas (usuario_id, pregunta_id, opcion_id)
                 VALUES (?, ?, ?)
                 ON DUPLICATE KEY UPDATE opcion_id = VALUES(opcion_id)"
            );
            $stmt->bind_param('iii', $usuarioId, $preguntaId, $opcionId);
            if ($stmt->execute()) {
                $count++;
            }
        }

        return $count;
    }

    public function haRespondido($usuarioId)
    {
        $stmt = $this->conn->prepare("SELECT COUNT(*) AS total FROM respuestas WHERE usuario_id = ?");
        $stmt->bind_param('i', $usuarioId);
        $stmt->execute();
        return (int) $stmt->get_result()->fetch_assoc()['total'] > 0;
    }

    /**
     * Calcula el resultado vocacional del usuario.
     * Suma los puntos por área y calcula el porcentaje sobre el máximo
     * de opciones que tiene cada área (48 opciones por área).
     */
    public function calcularResultado($usuarioId)
    {
        $query = "
            SELECT o.area_id,
                   COALESCE(SUM(CASE WHEN r.opcion_id IS NOT NULL THEN o.puntos ELSE 0 END), 0) AS puntos,
                   (SELECT COUNT(*) FROM opciones WHERE area_id = o.area_id) AS max_posible
            FROM opciones o
            LEFT JOIN respuestas r ON r.opcion_id = o.opcion_id AND r.usuario_id = ?
            INNER JOIN areas a ON a.area_id = o.area_id
            GROUP BY o.area_id, max_posible
            ORDER BY puntos DESC
        ";

        $stmt = $this->conn->prepare($query);
        $stmt->bind_param('i', $usuarioId);
        $stmt->execute();
        $filas = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);

        $areas = $this->getAreas();
        $porId = [];
        foreach ($areas as $area) {
            $area['puntos'] = 0;
            $area['porcentaje'] = 0;
            $porId[(int) $area['area_id']] = $area;
        }

        foreach ($filas as $fila) {
            $id = (int) $fila['area_id'];
            if (!isset($porId[$id])) {
                continue;
            }
            $maxPosible = max(1, (int) $fila['max_posible']);
            $puntos = (int) $fila['puntos'];
            $porId[$id]['puntos'] = $puntos;
            $porId[$id]['porcentaje'] = min(100, (int) round($puntos / $maxPosible * 100));
        }

        $resultado = array_values($porId);
        usort($resultado, fn($a, $b) => $b['porcentaje'] <=> $a['porcentaje']);
        return $resultado;
    }

    public function reiniciar($usuarioId)
    {
        $stmt = $this->conn->prepare("DELETE FROM respuestas WHERE usuario_id = ?");
        $stmt->bind_param('i', $usuarioId);
        return $stmt->execute();
    }

    /**
     * Guarda el snapshot del resultado de un intento (historial consultable).
     */
    public function guardarResultado($usuarioId, $areas, $areaPrincipalId, $carreraRecomendada = null)
    {
        $principal = $areas[0] ?? null;
        if (!$principal) {
            return false;
        }

        $stmt = $this->conn->prepare(
            "INSERT INTO resultados
                (usuario_id, area_principal_id, area_principal_label, afinidad_principal, carrera_id, carrera_nombre, desglose)
             VALUES (?, ?, ?, ?, ?, ?, ?)"
        );

        $carreraId = $carreraRecomendada ? (int) $carreraRecomendada['carreraId'] : null;
        $carreraNombre = $carreraRecomendada ? ($carreraRecomendada['nombre'] ?? '') : '';
        $desglose = json_encode($areas, JSON_UNESCAPED_UNICODE);
        $afinidad = (int) $principal['porcentaje'];

        $stmt->bind_param(
            'iisiiss',
            $usuarioId,
            $areaPrincipalId,
            $principal['label'],
            $afinidad,
            $carreraId,
            $carreraNombre,
            $desglose
        );
        $stmt->execute();
        return $this->conn->insert_id;
    }

    /**
     * Último resultado guardado de un usuario (con desglose decodificado).
     */
    public function obtenerUltimoResultado($usuarioId)
    {
        $stmt = $this->conn->prepare(
            "SELECT r.*, u.nombre AS usuario_nombre, u.correo AS usuario_correo
             FROM resultados r
             JOIN usuarios u ON u.id = r.usuario_id
             WHERE r.usuario_id = ?
             ORDER BY r.resultado_id DESC
             LIMIT 1"
        );
        $stmt->bind_param('i', $usuarioId);
        $stmt->execute();
        $fila = $stmt->get_result()->fetch_assoc();
        if (!$fila) {
            return null;
        }

        $fila['desglose'] = json_decode($fila['desglose'] ?? '', true) ?: [];
        return $fila;
    }

    /**
     * Todos los resultados guardados (para consulta del administrador),
     * ordenados del más reciente al más antiguo.
     */
    public function obtenerResultados()
    {
        $result = $this->conn->query(
            "SELECT r.resultado_id, r.area_principal_label, r.afinidad_principal,
                    r.carrera_nombre, r.fecha, u.nombre AS usuario_nombre, u.correo AS usuario_correo
             FROM resultados r
             JOIN usuarios u ON u.id = r.usuario_id
             ORDER BY r.resultado_id DESC"
        );
        $filas = $result->fetch_all(MYSQLI_ASSOC);

        foreach ($filas as &$fila) {
            $fila['fecha'] = date('d/m/Y H:i', strtotime($fila['fecha']));
        }

        return $filas;
    }
}