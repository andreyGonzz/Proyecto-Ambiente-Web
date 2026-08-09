<?php
require_once __DIR__ . '/../core/Controller.php';

class AdminController extends Controller
{
    private $usuarioModel;
    private $carreraModel;

    public function __construct()
    {
        session_start();
        $this->usuarioModel = $this->model('Usuario');
        $this->carreraModel = $this->model('Carrera');
    }

    public function index()
    {
        $stats = [
            [
                'label' => 'Total de usuarios',
                'value' => count($this->usuarioModel->getAll()),
                'icon' => 'group',
                'theme' => 'primary',
                'detail' => '+12% vs el mes pasado',
                'caption' => 'Crecimiento sostenido',
            ],
            [
                'label' => 'Carreras registradas',
                'value' => count($this->carreraModel->getAll()),
                'icon' => 'work',
                'theme' => 'tertiary',
                'detail' => 'Estable',
                'caption' => 'Catálogo activo',
            ],
        ];

        $this->view('admin/admin', ['stats' => $stats]);
    }

    public function usuarios()
    {
        $users = $this->usuarioModel->getAll();
        $this->view('admin/usuarios', ['users' => $users]);
    }

    public function carreras()
    {
        $carreras = $this->carreraModel->getAll();
        $this->view('admin/carrera', ['carreras' => $carreras]);
    }

    public function apiUsuarios()
    {
        $this->respondJson($this->usuarioModel->getAll());
    }

    public function apiCarreras()
    {
        $this->respondJson($this->carreraModel->getAll());
    }

    private function respondJson($data, $code = 200)
    {
        http_response_code($code);
        header('Content-Type: application/json');
        echo json_encode($data);
        exit;
    }
}
