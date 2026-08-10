<?php
require_once __DIR__ . '/../core/Controller.php';

class CarreraController extends Controller
{
    private $carreraModel;

    public function __construct()
    {
        session_start();
        $this->carreraModel = $this->model('Carrera');
    }

    public function index()
    {
        $carreras = $this->carreraModel->getAll();
        $this->view('admin/carrera', ['carreras' => $carreras]);
    }

    public function create()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            return $this->view('admin/carrera');
        }

        $data = $this->datosDelFormulario();

        if (trim($data['nombre']) === '') {
            return $this->respondJson(['success' => false, 'message' => 'El nombre de la carrera es obligatorio'], 400);
        }

        $carrera = $this->carreraModel->create($data);
        if ($carrera) {
            return $this->respondJson(['success' => true, 'message' => 'Carrera creada correctamente', 'data' => $carrera]);
        }

        return $this->respondJson(['success' => false, 'message' => 'No se pudo crear la carrera'], 500);
    }

    public function edit($id = null)
    {
        if (!$id) {
            return $this->view('admin/carrera');
        }

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            return $this->view('admin/carrera', ['carrera' => $this->carreraModel->getById($id)]);
        }

        $data = $this->datosDelFormulario();

        if (trim($data['nombre']) === '') {
            return $this->respondJson(['success' => false, 'message' => 'El nombre de la carrera es obligatorio'], 400);
        }

        $carrera = $this->carreraModel->update($id, $data);
        if ($carrera) {
            return $this->respondJson(['success' => true, 'message' => 'Carrera actualizada correctamente', 'data' => $carrera]);
        }

        return $this->respondJson(['success' => false, 'message' => 'No se pudo actualizar la carrera'], 500);
    }

    public function delete($id = null)
    {
        if (!$id) {
            return $this->respondJson(['success' => false, 'message' => 'ID de carrera no proporcionado'], 400);
        }

        if ($this->carreraModel->delete($id)) {
            return $this->respondJson(['success' => true, 'message' => 'Carrera eliminada correctamente']);
        }

        return $this->respondJson(['success' => false, 'message' => 'No se pudo eliminar la carrera'], 500);
    }

    public function apiList()
    {
        $carreras = $this->carreraModel->getAll();
        $this->respondJson($carreras);
    }

    public function lista()
    {
        $this->view('carreras/carreraList');
    }

    public function detalle($id = null)
    {
        $this->view('carreras/detalleCarrera');
    }

    public function apiStore()
    {
        $data = $this->datosJson();

        if (trim($data['nombre'] ?? '') === '') {
            return $this->respondJson(['success' => false, 'message' => 'El nombre de la carrera es obligatorio'], 400);
        }

        $carrera = $this->carreraModel->create($data);
        if ($carrera) {
            return $this->respondJson(['success' => true, 'message' => 'Carrera creada exitosamente', 'data' => $carrera]);
        }

        return $this->respondJson(['success' => false, 'message' => 'Error al crear la carrera'], 500);
    }

    public function apiShow($id)
    {
        $carrera = $this->carreraModel->getById($id);
        if ($carrera) {
            return $this->respondJson(['success' => true, 'data' => $carrera]);
        }

        return $this->respondJson(['success' => false, 'message' => 'Carrera no encontrada'], 404);
    }

    public function apiUpdate($id)
    {
        $data = $this->datosJson();

        if (trim($data['nombre'] ?? '') === '') {
            return $this->respondJson(['success' => false, 'message' => 'El nombre de la carrera es obligatorio'], 400);
        }

        $carrera = $this->carreraModel->update($id, $data);
        if ($carrera) {
            return $this->respondJson(['success' => true, 'message' => 'Carrera actualizada exitosamente', 'data' => $carrera]);
        }

        return $this->respondJson(['success' => false, 'message' => 'Error al actualizar la carrera'], 500);
    }

    public function apiDelete($id)
    {
        if (empty($id)) {
            return $this->respondJson(['success' => false, 'message' => 'ID de carrera no proporcionado'], 400);
        }

        if ($this->carreraModel->delete($id)) {
            return $this->respondJson(['success' => true, 'message' => 'Carrera eliminada exitosamente']);
        }

        return $this->respondJson(['success' => false, 'message' => 'Error al eliminar la carrera'], 500);
    }

    private function datosDelFormulario()
    {
        $body = json_decode(file_get_contents('php://input'), true);
        if (is_array($body)) {
            return $this->normalizarDatos($body);
        }

        return $this->normalizarDatos($_POST);
    }

    private function datosJson()
    {
        return json_decode(file_get_contents('php://input'), true) ?? [];
    }

    private function normalizarDatos($datos)
    {
        return [
            'nombre' => $datos['nombre'] ?? '',
            'dificultad' => $datos['dificultad'] ?? 'Media',
            'disponibilidad' => $datos['disponibilidad'] ?? 'Disponible',
            'estadoId' => $datos['estadoId'] ?? 1,
            'imagen' => $datos['imagen'] ?? '',
        ];
    }

    private function respondJson($data, $code = 200)
    {
        http_response_code($code);
        header('Content-Type: application/json');
        echo json_encode($data);
        exit;
    }
}