<?php
require_once '../app/core/Controller.php';

class AreasController extends Controller
{
    public function __construct()
    {
        session_start();
    }

    public function index()
    {
        if (!isset($_SESSION['user_id'])) {
            $this->view('login/login');
            return;
        }

        $this->view('areas/index');
    }

    public function cuestionario()
    {
        $this->view('areas/cuestionario');
    }

    public function antesComenzar()
    {
        $this->view('areas/antes-comenzar');
    }

    public function completado()
    {
        $this->view('areas/cuestionario-completado');
    }
}