<?php
require_once __DIR__ . '/../config/Database.php';

class Carrera
{
    private $conn;

    public function __construct()
    {
        $this->conn = Database::getInstance()->getConnection();
    }

    public function getAll()
    {
        $stmt = $this->conn->prepare(
            "SELECT id AS carreraId, area_id AS areaId, nombre, dificultad, disponibilidad, estado_id AS estadoId,
                    imagen_url AS imagen, descripcion, duracion, salario, demanda, habilidades
             FROM carreras
             ORDER BY id"
        );
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    public function getByArea($areaId)
    {
        $stmt = $this->conn->prepare(
            "SELECT id AS carreraId, area_id AS areaId, nombre, dificultad, disponibilidad, estado_id AS estadoId,
                    imagen_url AS imagen, descripcion, duracion, salario, demanda, habilidades
             FROM carreras
             WHERE area_id = ?
             ORDER BY id"
        );
        $stmt->bind_param('i', $areaId);
        $stmt->execute();
        $filas = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        return $filas ?: [];
    }

    public function getById($id)
    {
        $stmt = $this->conn->prepare(
            "SELECT id AS carreraId, area_id AS areaId, nombre, dificultad, disponibilidad, estado_id AS estadoId,
                    imagen_url AS imagen, descripcion, duracion, salario, demanda, habilidades
             FROM carreras
             WHERE id = ?"
        );
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $row = $stmt->get_result()->fetch_assoc();
        return $row ?: null;
    }

    public function create($data)
    {
        $nombre = trim($data['nombre'] ?? '');
        $dificultad = $data['dificultad'] ?? 'Media';
        $disponibilidad = $data['disponibilidad'] ?? 'Disponible';
        $estadoId = (int) ($data['estadoId'] ?? 1);
        $imagen = trim($data['imagen'] ?? '');
        $descripcion = trim($data['descripcion'] ?? '');
        $duracion = trim($data['duracion'] ?? '');
        $salario = trim($data['salario'] ?? '');
        $demanda = trim($data['demanda'] ?? '');
        $habilidades = trim($data['habilidades'] ?? '');

        $stmt = $this->conn->prepare(
            "INSERT INTO carreras (nombre, dificultad, disponibilidad, estado_id, imagen_url,
                                   descripcion, duracion, salario, demanda, habilidades)
             VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)"
        );
        $stmt->bind_param('sssissssss', $nombre, $dificultad, $disponibilidad, $estadoId, $imagen,
            $descripcion, $duracion, $salario, $demanda, $habilidades);

        if (!$stmt->execute()) {
            return false;
        }

        return $this->getById($this->conn->insert_id);
    }

    public function update($id, $data)
    {
        $actual = $this->getById($id);
        if (!$actual) {
            return false;
        }

        $nombre = isset($data['nombre']) ? trim($data['nombre']) : $actual['nombre'];
        $dificultad = $data['dificultad'] ?? $actual['dificultad'];
        $disponibilidad = $data['disponibilidad'] ?? $actual['disponibilidad'];
        $estadoId = isset($data['estadoId']) ? (int) $data['estadoId'] : (int) $actual['estadoId'];
        $imagen = isset($data['imagen']) ? trim($data['imagen']) : $actual['imagen'];
        $descripcion = isset($data['descripcion']) ? trim($data['descripcion']) : ($actual['descripcion'] ?? '');
        $duracion = isset($data['duracion']) ? trim($data['duracion']) : ($actual['duracion'] ?? '');
        $salario = isset($data['salario']) ? trim($data['salario']) : ($actual['salario'] ?? '');
        $demanda = isset($data['demanda']) ? trim($data['demanda']) : ($actual['demanda'] ?? '');
        $habilidades = isset($data['habilidades']) ? trim($data['habilidades']) : ($actual['habilidades'] ?? '');

        $stmt = $this->conn->prepare(
            "UPDATE carreras
             SET nombre = ?, dificultad = ?, disponibilidad = ?, estado_id = ?, imagen_url = ?,
                 descripcion = ?, duracion = ?, salario = ?, demanda = ?, habilidades = ?
             WHERE id = ?"
        );
        $stmt->bind_param('sssissssssi', $nombre, $dificultad, $disponibilidad, $estadoId, $imagen,
            $descripcion, $duracion, $salario, $demanda, $habilidades, $id);
        $stmt->execute();

        return $this->getById($id);
    }

    public function delete($id)
    {
        $stmt = $this->conn->prepare("DELETE FROM carreras WHERE id = ?");
        $stmt->bind_param('i', $id);
        $stmt->execute();
        return $stmt->affected_rows > 0;
    }
}