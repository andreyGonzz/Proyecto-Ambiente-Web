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
                ? BASE_URL . '/public/usuario/index'
                : BASE_URL . '/public/';

            $this->respond([
                'ok' => true,
                'message' => 'Inicio de sesión exitoso. Redirigiendo...',
                'role' => $user['rol'],
                'redirect' => $redirect,
            ]);
        }

        if (isset($_SESSION['user_id'])) {
            if ($_SESSION['user_rol'] === 'ADMIN') {
                $this->view('admin/usuarios');
                return;
            }

            $this->view('main/index');
            return;
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
            return $this->respond([
                'ok' => true,
                'message' => 'Tu cuenta fue creada correctamente. Serás redirigido para iniciar sesión.',
            ]);
        }

        $this->respond(['ok' => false, 'message' => $error], 400);
    }

    public function recover()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $correo = trim($_POST['email'] ?? '');

            if ($correo === '' || !filter_var($correo, FILTER_VALIDATE_EMAIL)) {
                $this->respond(['ok' => false, 'message' => 'Ingresa un correo electrónico válido.'], 400);
            }

            $usuario = $this->model('Usuario');
            $user = $usuario->getByCorreo($correo);

            if ($user) {
                $token = bin2hex(random_bytes(32));
                $expira = date('Y-m-d H:i:s', strtotime('+1 hour'));

                if ($usuario->setToken($correo, $token, $expira)) {
                    $enlace = str_replace(' ', '%20', BASE_URL . '/public/auth/reset/' . $token);
                    if (!$this->enviarCorreo($correo, $enlace)) {
                        $this->respond([
                            'ok' => false,
                            'message' => 'No se pudo enviar el correo. Revisa la configuración SMTP en sendmail.ini.',
                        ], 500);
                    }
                }
            }

            $this->respond([
                'ok' => true,
                'message' => 'Si el correo existe, hemos enviado un enlace de recuperación. Revisa tu bandeja de entrada y spam.',
            ]);
        }

        $this->view('login/recover');
    }

    public function reset($token = null)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $input = json_decode(file_get_contents('php://input'), true) ?? [];
            $token = trim($_POST['token'] ?? $input['token'] ?? $token ?? '');
            $nueva = $_POST['password'] ?? $input['password'] ?? '';
            $confirmacion = $_POST['confirm_password'] ?? $input['confirm_password'] ?? '';

            $error = null;
            $usuario = $this->model('Usuario');

            if (!$usuario->getByToken($token)) {
                $error = 'El enlace es inválido o ha expirado. Solicita un nuevo enlace de recuperación.';
            } elseif ($nueva === '' || $confirmacion === '') {
                $error = 'Ingresa y confirma tu nueva contraseña.';
            } elseif ($nueva !== $confirmacion) {
                $error = 'Las contraseñas no coinciden.';
            } elseif (strlen($nueva) < 6) {
                $error = 'La contraseña debe tener al menos 6 caracteres.';
            }

            if ($error === null) {
                $user = $usuario->getByToken($token);
                if ($usuario->actualizarContrasena($user['correo'], $nueva)) {
                    $usuario->setToken($user['correo'], null, null);
                    return $this->respond([
                        'ok' => true,
                        'message' => 'Tu contraseña fue actualizada. Serás redirigido para iniciar sesión.',
                    ]);
                }
                $error = 'No se pudo actualizar la contraseña. Inténtalo de nuevo.';
            }

            $this->respond(['ok' => false, 'message' => $error], 400);
        }

        $this->view('login/reset');
    }

    public function apiValidarToken($token = null)
    {
        $usuario = $this->model('Usuario');
        $valido = $usuario->getByToken($token ?? '') ? true : false;
        $this->respond(['ok' => true, 'valido' => $valido]);
    }

    public function apiSesion()
    {
        $this->respond([
            'ok' => true,
            'logueado' => isset($_SESSION['user_id']),
            'nombre' => $_SESSION['user_nombre'] ?? '',
            'rol' => $_SESSION['user_rol'] ?? '',
        ]);
    }

    public function logout()
    {
        $_SESSION = [];
        session_destroy();
        $this->redirect('/public/');
    }

    private function enviarCorreo($correo, $enlace)
    {
        require_once '../app/config/mail.php';
        require_once '../app/libs/phpmailer/PHPMailer.php';
        require_once '../app/libs/phpmailer/SMTP.php';
        require_once '../app/libs/phpmailer/Exception.php';

        $mail = new PHPMailer\PHPMailer\PHPMailer(true);
        try {
            $mail->isSMTP();
            $mail->Host = MAIL_HOST;
            $mail->SMTPAuth = true;
            $mail->Username = MAIL_USER;
            $mail->Password = MAIL_PASS;
            $mail->SMTPSecure = MAIL_SECURE;
            $mail->Port = MAIL_PORT;
            $mail->CharSet = 'UTF-8';

            $mail->setFrom(MAIL_FROM, MAIL_FROM_NAME);
            $mail->addAddress($correo);

            $mail->Subject = 'Recupera tu contraseña - ' . siteName;
            $mail->Body = "Hola,\n\n"
                . "Recibimos una solicitud para restablecer la contraseña de tu cuenta.\n\n"
                . "Para continuar, haz clic en el siguiente enlace (válido por 1 hora):\n\n"
                . "<" . $enlace . ">\n\n"
                . "Si no solicitaste este cambio, puedes ignorar este correo.\n\n"
                . "— " . siteName;

            $mail->send();
            return true;
        } catch (PHPMailer\PHPMailer\Exception $e) {
            error_log('Correo no enviado: ' . $mail->ErrorInfo);
            return false;
        }
    }

    private function respond($data, $code = 200)
    {
        http_response_code($code);
        header('Content-Type: application/json');
        echo json_encode($data);
        exit;
    }
}
