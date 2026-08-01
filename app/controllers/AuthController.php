<?php
require_once '../app/core/Controller.php';

class AuthController extends Controller
{
    public function __construct()
    {
        session_start();
    }

    public function index()
    {
        $this->login();
    }

    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $correo = trim($_POST['email'] ?? '');
            $contrasena = $_POST['password'] ?? '';

            if ($correo === '' || $contrasena === '') {
                $this->respond(['ok' => false, 'message' => 'Ingresa tu correo y tu contraseña.'], 400);
            }

            $usuario = $this->model('Usuario');
            $user = $usuario->verificarCredenciales($correo, $contrasena);

            if (!$user) {
                $this->respond(['ok' => false, 'message' => 'Las credenciales ingresadas son incorrectas.'], 401);
            }

            session_regenerate_id(true);
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_nombre'] = $user['nombre'];
            $_SESSION['user_correo'] = $user['correo'];
            $_SESSION['user_rol'] = $user['rol'];

            $redirect = $user['rol'] === 'ADMIN'
                ? BASE_URL . '/app/views/admin/admin.php'
                : BASE_URL . '/public/index.php';

            $this->respond([
                'ok' => true,
                'message' => 'Inicio de sesión exitoso. Redirigiendo...',
                'role' => $user['rol'],
                'redirect' => $redirect,
            ]);
        }

        if (isset($_SESSION['user_id'])) {
            $redirect = $_SESSION['user_rol'] === 'ADMIN'
                ? '/app/views/admin/admin.php'
                : '/public/index.php';
            $this->redirect($redirect);
        }

        $this->view('login/login');
    }

    public function register()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            return $this->view('login/register');
        }

        $nombre = trim($_POST['fullname'] ?? '');
        $correo = trim($_POST['email'] ?? '');
        $contrasena = $_POST['password'] ?? '';
        $confirmacion = $_POST['confirm_password'] ?? '';

        $error = null;

        if ($nombre === '' || $correo === '' || $contrasena === '' || $confirmacion === '') {
            $error = 'Todos los campos son obligatorios.';
        } elseif ($contrasena !== $confirmacion) {
            $error = 'Las contraseñas no coinciden.';
        } elseif (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
            $error = 'Ingresa un correo electrónico válido.';
        }

        if ($error === null) {
            $usuario = $this->model('Usuario');

            if ($usuario->getByCorreo($correo)) {
                $error = 'Ya existe una cuenta con este correo.';
            } elseif (!$usuario->create(['nombre' => $nombre, 'correo' => $correo, 'contrasena' => $contrasena])) {
                $error = 'No se pudo registrar el usuario. Inténtalo de nuevo.';
            }
        }

        if ($error === null) {
            return $this->redirect('/public/auth/login');
        }

        $this->view('login/register', ['error' => $error]);
    }

    public function logout()
    {
        $_SESSION = [];
        session_destroy();
        $this->redirect('/public/index.php');
    }

    private function respond($data, $code = 200)
    {
        http_response_code($code);
        header('Content-Type: application/json');
        echo json_encode($data);
        exit;
    }
}
