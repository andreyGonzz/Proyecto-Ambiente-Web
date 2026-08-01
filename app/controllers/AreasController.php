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
            $this->redirect('/public/auth/login');
        }

        $this->view('areas/index');
    }
}
