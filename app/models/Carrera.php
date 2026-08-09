<?php
class Carrera
{
    private $filePath;

    public function __construct()
    {
        $this->filePath = __DIR__ . '/../storage/carreras.json';
        if (!is_dir(dirname($this->filePath))) {
            mkdir(dirname($this->filePath), 0777, true);
        }
    }

    public function getAll()
    {
        $data = $this->readData();
        return $data;
    }

    public function getById($id)
    {
        foreach ($this->getAll() as $item) {
            if ((int) $item['carreraId'] === (int) $id) {
                return $item;
            }
        }

        return null;
    }

    public function create($data)
    {
        $carreras = $this->getAll();
        $nextId = 1;
        foreach ($carreras as $item) {
            $nextId = max($nextId, (int) $item['carreraId'] + 1);
        }

        $carrera = [
            'carreraId' => $nextId,
            'nombre' => trim($data['nombre'] ?? ''),
            'dificultad' => $data['dificultad'] ?? 'Media',
            'disponibilidad' => $data['disponibilidad'] ?? 'Disponible',
            'estadoId' => (int) ($data['estadoId'] ?? 1),
        ];

        $carreras[] = $carrera;
        $this->saveData($carreras);
        return $carrera;
    }

    public function update($id, $data)
    {
        $carreras = $this->getAll();
        foreach ($carreras as &$item) {
            if ((int) $item['carreraId'] === (int) $id) {
                $item['nombre'] = trim($data['nombre'] ?? $item['nombre']);
                $item['dificultad'] = $data['dificultad'] ?? $item['dificultad'];
                $item['disponibilidad'] = $data['disponibilidad'] ?? $item['disponibilidad'];
                $item['estadoId'] = isset($data['estadoId']) ? (int) $data['estadoId'] : $item['estadoId'];
                $this->saveData($carreras);
                return true;
            }
        }

        return false;
    }

    public function delete($id)
    {
        $carreras = $this->getAll();
        $filtered = [];
        $deleted = false;

        foreach ($carreras as $item) {
            if ((int) $item['carreraId'] === (int) $id) {
                $deleted = true;
                continue;
            }
            $filtered[] = $item;
        }

        if ($deleted) {
            $this->saveData($filtered);
        }

        return $deleted;
    }

    private function readData()
    {
        if (!file_exists($this->filePath)) {
            return [];
        }

        $content = file_get_contents($this->filePath);
        if ($content === false || trim($content) === '') {
            return [];
        }

        $decoded = json_decode($content, true);
        return is_array($decoded) ? $decoded : [];
    }

    private function saveData($data)
    {
        file_put_contents($this->filePath, json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
    }
}
