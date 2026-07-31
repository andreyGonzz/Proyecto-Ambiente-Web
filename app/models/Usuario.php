<?php
require_once '../app/config/Database.php';

class Usuario
{
    private $db;

    public function __construct()
    {
        $this->db = Database::getInstance()->getConnection();
    }

    public function getAll()
    {
        $query = "SELECT * FROM usuarios ORDER BY id DESC";
        $result = $this->db->query($query);
        $usuarios = [];
        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $usuarios[] = $row;
            }
        }
        return $usuarios;
    }

    public function getById($id)
    {
        $query = "SELECT * FROM usuarios WHERE id = ? LIMIT 1";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    public function getByCorreo($correo)
    {
        $query = "SELECT * FROM usuarios WHERE correo = ? LIMIT 1";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("s", $correo);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    public function create($data)
    {
        $query = "INSERT INTO usuarios (nombre, correo, contrasena) VALUES (?, ?, ?)";
        $stmt = $this->db->prepare($query);
        $hashedPassword = password_hash($data['contrasena'], PASSWORD_DEFAULT);
        $stmt->bind_param("sss", $data['nombre'], $data['correo'], $hashedPassword);
        return $stmt->execute();
    }

    public function actualizarContrasena($correo, $nuevaContrasena)
    {
        $query = "UPDATE usuarios SET contrasena = ? WHERE correo = ?";
        $stmt = $this->db->prepare($query);
        $hashedPassword = password_hash($nuevaContrasena, PASSWORD_DEFAULT);
        $stmt->bind_param("ss", $hashedPassword, $correo);
        return $stmt->execute();
    }

    public function verificarCredenciales($correo, $contrasena)
    {
        $usuario = $this->getByCorreo($correo);
        if ($usuario && password_verify($contrasena, $usuario['contrasena'])) {
            return $usuario;
        }
        return false;
    }
}
