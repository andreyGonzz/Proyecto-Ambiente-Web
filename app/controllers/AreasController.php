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
        $this->view('areas/index');
    }
}
