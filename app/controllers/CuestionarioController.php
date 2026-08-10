<?php
require_once __DIR__ . '/../core/Controller.php';

class CuestionarioController extends Controller
{
    private $cuestionarioModel;

    public function __construct()
    {
        session_start();
        $this->cuestionarioModel = $this->model('Cuestionario');
    }

    private function usuarioLogueado()
    {
        return isset($_SESSION['user_id']) ? (int) $_SESSION['user_id'] : null;
    }

    private function requerirLogin()
    {
        if (!$this->usuarioLogueado()) {
            $this->redirect('/public/auth/login');
        }
    }

    public function index()
    {
        $this->requerirLogin();
        $this->view('areas/cuestionario', [
            'totalPreguntas' => $this->cuestionarioModel->getTotalPreguntas(),
        ]);
    }

    public function apiPreguntas()
    {
        if (!$this->usuarioLogueado()) {
            return $this->respondJson(['success' => false, 'message' => 'No autorizado'], 401);
        }

        $this->respondJson([
            'success' => true,
            'total' => $this->cuestionarioModel->getTotalPreguntas(),
            'preguntas' => $this->cuestionarioModel->getPreguntasConOpciones(),
        ]);
    }

    private function recomendarPara($usuarioId)
    {
        $areas = $this->cuestionarioModel->calcularResultado($usuarioId);
        $areaPrincipalId = (int) ($areas[0]['area_id'] ?? 0);

        $carreraRecomendada = null;
        if ($areaPrincipalId > 0) {
            $carrerasArea = $this->model('Carrera')->getByArea($areaPrincipalId);
            $carreraRecomendada = $carrerasArea[0] ?? null;
        }

        return [
            'areas' => $areas,
            'areaPrincipalId' => $areaPrincipalId,
            'carreraRecomendada' => $carreraRecomendada,
        ];
    }

    public function apiGuardar()
    {
        $usuarioId = $this->usuarioLogueado();
        if (!$usuarioId) {
            return $this->respondJson(['success' => false, 'message' => 'No autorizado'], 401);
        }

        $body = json_decode(file_get_contents('php://input'), true);
        $respuestas = is_array($body['respuestas'] ?? null) ? $body['respuestas'] : [];

        if (empty($respuestas)) {
            return $this->respondJson(['success' => false, 'message' => 'No se recibieron respuestas'], 400);
        }

        $guardadas = $this->cuestionarioModel->guardarRespuestas($usuarioId, $respuestas);

        $recomendacion = $this->recomendarPara($usuarioId);
        $this->cuestionarioModel->guardarResultado(
            $usuarioId,
            $recomendacion['areas'],
            $recomendacion['areaPrincipalId'],
            $recomendacion['carreraRecomendada']
        );

        return $this->respondJson([
            'success' => true,
            'message' => 'Respuestas y resultados guardados correctamente',
            'guardadas' => $guardadas,
        ]);
    }

    public function resultado()
    {
        $this->requerirLogin();
        $usuarioId = $this->usuarioLogueado();

        if (!$this->cuestionarioModel->haRespondido($usuarioId)) {
            $this->redirect('/public/cuestionario');
        }

        $recomendacion = $this->recomendarPara($usuarioId);

        $this->view('areas/index', [
            'areas' => $recomendacion['areas'],
            'areaPrincipalId' => $recomendacion['areaPrincipalId'],
            'carreraRecomendada' => $recomendacion['carreraRecomendada'],
            'nombreUsuario' => $_SESSION['user_nombre'] ?? '',
        ]);
    }

    public function reiniciar()
    {
        $this->requerirLogin();
        $this->cuestionarioModel->reiniciar($this->usuarioLogueado());
        $this->redirect('/public/cuestionario');
    }

    private function respondJson($data, $code = 200)
    {
        http_response_code($code);
        header('Content-Type: application/json');
        echo json_encode($data);
        exit;
    }
}