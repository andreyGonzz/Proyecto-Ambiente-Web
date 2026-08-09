<?php
require_once __DIR__ . '/../core/Controller.php';

class UsuarioController extends Controller
{
    private $userModel;

    public function __construct()
    {
        session_start();
        $this->userModel = $this->model('Usuario');
    }

    public function index()
    {
        $users = $this->userModel->getAll();
        $this->view('admin/usuarios', ['users' => $users]);
    }

    public function create()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            return $this->view('admin/usuarios');
        }

        $data = [
            'nombre' => trim($_POST['name'] ?? ''),
            'correo' => trim($_POST['email'] ?? ''),
            'contrasena' => $_POST['password'] ?? ''
        ];

        if ($data['nombre'] === '' || $data['correo'] === '' || $data['contrasena'] === '') {
            return $this->respondJson(['success' => false, 'message' => 'Todos los campos son obligatorios'], 400);
        }

        if (!filter_var($data['correo'], FILTER_VALIDATE_EMAIL)) {
            return $this->respondJson(['success' => false, 'message' => 'Ingresa un correo válido'], 400);
        }

        if ($this->userModel->getByCorreo($data['correo'])) {
            return $this->respondJson(['success' => false, 'message' => 'El correo ya está registrado'], 409);
        }

        $result = $this->userModel->create($data);
        if ($result) {
            return $this->respondJson(['success' => true, 'message' => 'Usuario creado correctamente']);
        }

        return $this->respondJson(['success' => false, 'message' => 'No se pudo crear el usuario'], 500);
    }

    public function edit($id = null)
    {
        if (!$id) {
            return $this->redirect('/public/index.php?url=usuario/index');
        }

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $user = $this->userModel->getById($id);
            return $this->view('admin/usuarios', ['user' => $user]);
        }

        $data = [
            'nombre' => trim($_POST['name'] ?? ''),
            'correo' => trim($_POST['email'] ?? ''),
        ];

        if ($data['nombre'] === '' || $data['correo'] === '') {
            return $this->respondJson(['success' => false, 'message' => 'Nombre y correo son obligatorios'], 400);
        }

        if (!filter_var($data['correo'], FILTER_VALIDATE_EMAIL)) {
            return $this->respondJson(['success' => false, 'message' => 'Ingresa un correo válido'], 400);
        }

        $existingUser = $this->userModel->getByCorreo($data['correo']);
        if ($existingUser && $existingUser['id'] != $id) {
            return $this->respondJson(['success' => false, 'message' => 'El correo ya está en uso por otro usuario'], 409);
        }

        $result = $this->userModel->update($id, $data);
        if ($result) {
            return $this->respondJson(['success' => true, 'message' => 'Usuario actualizado correctamente']);
        }

        return $this->respondJson(['success' => false, 'message' => 'No se pudo actualizar el usuario'], 500);
    }

    public function delete($id = null)
    {
        if (!$id) {
            return $this->respondJson(['success' => false, 'message' => 'ID de usuario no proporcionado'], 400);
        }

        $result = $this->userModel->delete($id);
        if ($result) {
            return $this->respondJson(['success' => true, 'message' => 'Usuario eliminado correctamente']);
        }

        return $this->respondJson(['success' => false, 'message' => 'No se pudo eliminar el usuario'], 500);
    }

    public function apiList()
    {
        $users = $this->userModel->getAll();
        $this->respondJson($users);
    }

    public function apiStore()
    {
        $data = json_decode(file_get_contents('php://input'), true) ?? [];

        if (empty($data['name']) || empty($data['email']) || empty($data['password'])) {
            return $this->respondJson(['success' => false, 'message' => 'Todos los campos son obligatorios'], 400);
        }

        $result = $this->userModel->create([
            'nombre' => trim($data['name']),
            'correo' => trim($data['email']),
            'contrasena' => $data['password'],
        ]);

        if ($result) {
            return $this->respondJson(['success' => true, 'message' => 'Usuario creado exitosamente']);
        }

        return $this->respondJson(['success' => false, 'message' => 'Error al crear el usuario'], 500);
    }

    public function apiShow($id)
    {
        $user = $this->userModel->getById($id);
        if ($user) {
            return $this->respondJson(['success' => true, 'data' => $user]);
        }

        return $this->respondJson(['success' => false, 'message' => 'Usuario no encontrado'], 404);
    }

    public function apiUpdate($id)
    {
        $data = json_decode(file_get_contents('php://input'), true) ?? [];

        if (empty($data['name']) || empty($data['email'])) {
            return $this->respondJson(['success' => false, 'message' => 'Nombre y correo son obligatorios'], 400);
        }

        $result = $this->userModel->update($id, [
            'nombre' => trim($data['name']),
            'correo' => trim($data['email']),
        ]);

        if ($result) {
            return $this->respondJson(['success' => true, 'message' => 'Usuario actualizado exitosamente']);
        }

        return $this->respondJson(['success' => false, 'message' => 'Error al actualizar el usuario'], 500);
    }

    public function apiDelete($id)
    {
        if (empty($id)) {
            return $this->respondJson(['success' => false, 'message' => 'ID de usuario no proporcionado'], 400);
        }

        $result = $this->userModel->delete($id);
        if ($result) {
            return $this->respondJson(['success' => true, 'message' => 'Usuario eliminado exitosamente']);
        }

        return $this->respondJson(['success' => false, 'message' => 'Error al eliminar el usuario'], 500);
    }

    private function respondJson($data, $code = 200)
    {
        http_response_code($code);
        header('Content-Type: application/json');
        echo json_encode($data);
        exit;
    }
}
