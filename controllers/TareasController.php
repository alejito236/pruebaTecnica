<?php


require_once 'models/Tarea.php';

class TareasController
{
    public function usuario($usuario_id)
    {
        header('Content-Type: application/json');
        $tareaModel = new Tarea();
        $tareas = $tareaModel->obtenerTareasPorUsuario($usuario_id);
        echo json_encode($tareas);
    }

    public function vista()
    {
    session_start();
   
   
    if (!isset($_SESSION['usuario_id'])) {
        header('Location: /pruebaTecnica/usuarios/login');
        exit;
    }

    $usuario_id = $_SESSION['usuario_id'];

    $tareaModel = new Tarea();
    $tareas = $tareaModel->obtenerTareasPorUsuario($usuario_id);
    require_once 'views/tareas.php';
}
}
