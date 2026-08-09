<?php
require_once __DIR__ . '/../core/Controller.php';

class CarrerasController extends Controller
{
    private $careerModel;

    public function __construct()
    {
        session_start();
        $this->careerModel = $this->model('Carrera');
    }

    public function index()
    {
        $carreras = $this->careerModel->getAll();
        $this->view('admin/carrera', ['carreras' => $carreras]);
    }

    public function create()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            return $this->view('admin/carrera');
        }

        $data = [
            'nombre' => trim($_POST['nombre'] ?? ''),
            'dificultad' => $_POST['dificultad'] ?? 'Media',
            'disponibilidad' => $_POST['disponibilidad'] ?? 'Disponible',
            'estadoId' => (int) ($_POST['estadoId'] ?? 1),
        ];

        if ($data['nombre'] === '') {
            return $this->respondJson(['success' => false, 'message' => 'El nombre de la carrera es obligatorio'], 400);
        }

        $result = $this->careerModel->create($data);
        if ($result) {
            return $this->respondJson(['success' => true, 'message' => 'Carrera creada correctamente']);
        }

        return $this->respondJson(['success' => false, 'message' => 'No se pudo crear la carrera'], 500);
    }

    public function edit($id = null)
    {
        if (!$id) {
            return $this->respondJson(['success' => false, 'message' => 'ID de carrera no proporcionado'], 400);
        }

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $carrera = $this->careerModel->getById($id);
            return $this->view('admin/carrera', ['carrera' => $carrera]);
        }

        $data = [
            'nombre' => trim($_POST['nombre'] ?? ''),
            'dificultad' => $_POST['dificultad'] ?? 'Media',
            'disponibilidad' => $_POST['disponibilidad'] ?? 'Disponible',
            'estadoId' => (int) ($_POST['estadoId'] ?? 1),
        ];

        if ($data['nombre'] === '') {
            return $this->respondJson(['success' => false, 'message' => 'El nombre de la carrera es obligatorio'], 400);
        }

        $result = $this->careerModel->update($id, $data);
        if ($result) {
            return $this->respondJson(['success' => true, 'message' => 'Carrera actualizada correctamente']);
        }

        return $this->respondJson(['success' => false, 'message' => 'No se pudo actualizar la carrera'], 500);
    }

    public function delete($id = null)
    {
        if (!$id) {
            return $this->respondJson(['success' => false, 'message' => 'ID de carrera no proporcionado'], 400);
        }

        $result = $this->careerModel->delete($id);
        if ($result) {
            return $this->respondJson(['success' => true, 'message' => 'Carrera eliminada correctamente']);
        }

        return $this->respondJson(['success' => false, 'message' => 'No se pudo eliminar la carrera'], 500);
    }

    public function apiList()
    {
        $carreras = $this->careerModel->getAll();
        $this->respondJson($carreras);
    }

    public function apiStore()
    {
        $data = json_decode(file_get_contents('php://input'), true) ?? [];

        if (empty($data['nombre'])) {
            return $this->respondJson(['success' => false, 'message' => 'El nombre de la carrera es obligatorio'], 400);
        }

        $result = $this->careerModel->create([
            'nombre' => trim($data['nombre']),
            'dificultad' => $data['dificultad'] ?? 'Media',
            'disponibilidad' => $data['disponibilidad'] ?? 'Disponible',
            'estadoId' => (int) ($data['estadoId'] ?? 1),
        ]);

        if ($result) {
            return $this->respondJson(['success' => true, 'message' => 'Carrera creada exitosamente']);
        }

        return $this->respondJson(['success' => false, 'message' => 'Error al crear la carrera'], 500);
    }

    public function apiShow($id)
    {
        $carrera = $this->careerModel->getById($id);
        if ($carrera) {
            return $this->respondJson(['success' => true, 'data' => $carrera]);
        }

        return $this->respondJson(['success' => false, 'message' => 'Carrera no encontrada'], 404);
    }

    public function apiUpdate($id)
    {
        $data = json_decode(file_get_contents('php://input'), true) ?? [];

        if (empty($data['nombre'])) {
            return $this->respondJson(['success' => false, 'message' => 'El nombre de la carrera es obligatorio'], 400);
        }

        $result = $this->careerModel->update($id, [
            'nombre' => trim($data['nombre']),
            'dificultad' => $data['dificultad'] ?? 'Media',
            'disponibilidad' => $data['disponibilidad'] ?? 'Disponible',
            'estadoId' => (int) ($data['estadoId'] ?? 1),
        ]);

        if ($result) {
            return $this->respondJson(['success' => true, 'message' => 'Carrera actualizada exitosamente']);
        }

        return $this->respondJson(['success' => false, 'message' => 'Error al actualizar la carrera'], 500);
    }

    public function apiDelete($id)
    {
        if (empty($id)) {
            return $this->respondJson(['success' => false, 'message' => 'ID de carrera no proporcionado'], 400);
        }

        $result = $this->careerModel->delete($id);
        if ($result) {
            return $this->respondJson(['success' => true, 'message' => 'Carrera eliminada exitosamente']);
        }

        return $this->respondJson(['success' => false, 'message' => 'Error al eliminar la carrera'], 500);
    }

    private function respondJson($data, $code = 200)
    {
        http_response_code($code);
        header('Content-Type: application/json');
        echo json_encode($data);
        exit;
    }
}
