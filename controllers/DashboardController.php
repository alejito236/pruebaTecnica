<?php
require_once 'models/Proyecto.php';
require_once 'models/Tarea.php';

class DashboardController
{
    public function index()
    {
        session_start();
        if (!isset($_SESSION['usuario_id'])) {
            header("HTTP/1.1 401 Unauthorized");
            exit;
        }

        $usuario_id = $_SESSION['usuario_id'];

        $proyectoModel = new Proyecto();
        $tareaModel = new Tarea();

        $totalProyectos = $proyectoModel->contarPorUsuario($usuario_id);
        $totalTareas = $tareaModel->contarPorUsuario($usuario_id);

        include 'views/dashboard/index.php';
    }
}