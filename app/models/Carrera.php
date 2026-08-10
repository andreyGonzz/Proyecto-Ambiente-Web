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
            "SELECT id AS carreraId, nombre, dificultad, disponibilidad, estado_id AS estadoId, imagen_url AS imagen
             FROM carreras
             ORDER BY id"
        );
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    public function getById($id)
    {
        $stmt = $this->conn->prepare(
            "SELECT id AS carreraId, nombre, dificultad, disponibilidad, estado_id AS estadoId, imagen_url AS imagen
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

        $stmt = $this->conn->prepare(
            "INSERT INTO carreras (nombre, dificultad, disponibilidad, estado_id, imagen_url)
             VALUES (?, ?, ?, ?, ?)"
        );
        $stmt->bind_param('sssis', $nombre, $dificultad, $disponibilidad, $estadoId, $imagen);

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

        $stmt = $this->conn->prepare(
            "UPDATE carreras
             SET nombre = ?, dificultad = ?, disponibilidad = ?, estado_id = ?, imagen_url = ?
             WHERE id = ?"
        );
        $stmt->bind_param('sssisi', $nombre, $dificultad, $disponibilidad, $estadoId, $imagen, $id);
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