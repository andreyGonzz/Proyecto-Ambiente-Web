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
        $this->view('admin/carrera');
    }

    public function create()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            return $this->respondJson(['success' => false, 'message' => 'Método no permitido'], 405);
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
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            return $this->respondJson(['success' => false, 'message' => 'Método no permitido'], 405);
        }

        if (!$id) {
            return $this->respondJson(['success' => false, 'message' => 'ID de carrera no proporcionado'], 400);
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
        $this->respondJson(['success' => true, 'data' => $carreras]);
    }

    public function apiAreas()
    {
        $areas = $this->model('Cuestionario')->getAreas();
        $this->respondJson(['success' => true, 'data' => $areas]);
    }

    public function apiDetalle($id = null)
    {
        $carrera = $id ? $this->carreraModel->getById((int) $id) : null;
        if (!$carrera) {
            return $this->respondJson(['success' => false, 'message' => 'Carrera no encontrada'], 404);
        }

        $afinidad = null;
        if (isset($_SESSION['user_id'])) {
            $resultado = $this->model('Cuestionario')->obtenerUltimoResultado((int) $_SESSION['user_id']);
            if ($resultado && is_array($resultado['desglose'] ?? null)) {
                $areaCarrera = (int) $carrera['areaId'];
                foreach ($resultado['desglose'] as $area) {
                    if ((int) $area['area_id'] === $areaCarrera) {
                        $afinidad = (int) $area['porcentaje'];
                        break;
                    }
                }
            }
        }

        return $this->respondJson([
            'success' => true,
            'data' => [
                'carrera' => $carrera,
                'afinidad' => $afinidad,
            ],
        ]);
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
            'areaId' => $datos['areaId'] ?? 1,
            'dificultad' => $datos['dificultad'] ?? 'Media',
            'disponibilidad' => $datos['disponibilidad'] ?? 'Disponible',
            'estadoId' => $datos['estadoId'] ?? 1,
            'imagen' => $datos['imagen'] ?? '',
            'descripcion' => $datos['descripcion'] ?? '',
            'duracion' => $datos['duracion'] ?? '',
            'salario' => $datos['salario'] ?? '',
            'demanda' => $datos['demanda'] ?? '',
            'habilidades' => $datos['habilidades'] ?? '',
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