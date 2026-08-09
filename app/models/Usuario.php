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
        $query = "INSERT INTO usuarios (nombre, correo, contrasena,rol) VALUES (?, ?, ?,?)";
        $stmt = $this->db->prepare($query);
        $hashedPassword = password_hash($data['contrasena'], PASSWORD_DEFAULT);
        $rol = 'USUARIO';
        $stmt->bind_param("ssss", $data['nombre'], $data['correo'], $hashedPassword, $rol);
        return $stmt->execute();
    }

    public function update($id, $data)
    {
        $query = "UPDATE usuarios SET nombre = ?, correo = ? WHERE id = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("ssi", $data['nombre'], $data['correo'], $id);
        return $stmt->execute();
    }

    public function delete($id)
    {
        $query = "DELETE FROM usuarios WHERE id = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("i", $id);
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

    public function setToken($correo, $token, $expira)
    {
        if ($token === null) {
            $query = "UPDATE usuarios SET token = NULL, token_expira = NULL WHERE correo = ?";
            $stmt = $this->db->prepare($query);
            $stmt->bind_param("s", $correo);
            return $stmt->execute();
        }

        $query = "UPDATE usuarios SET token = ?, token_expira = ? WHERE correo = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("sss", $token, $expira, $correo);
        return $stmt->execute();
    }

    public function getByToken($token)
    {
        $query = "SELECT * FROM usuarios WHERE token = ? AND token_expira > NOW() LIMIT 1";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("s", $token);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
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
