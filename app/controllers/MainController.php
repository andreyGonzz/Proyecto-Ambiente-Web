<?php
require_once '../app/core/Controller.php';

class MainController extends Controller
{
    public function __construct()
    {
        session_start();
    }

    public function index()
    {
        if (isset($_SESSION['user_rol']) && $_SESSION['user_rol'] === 'ADMIN') {
            $this->view('admin/usuarios');
            return;
        }

        $this->view('main/index');
    }

}