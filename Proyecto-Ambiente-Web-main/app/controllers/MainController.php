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
        $this->view('main/index');
    }

}