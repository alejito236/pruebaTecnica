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
    require_once 'views/tareas/index.php';
}
public function crear()
{
    session_start();
    if (!isset($_SESSION['usuario_id'])) {
        header('Location: /pruebaTecnica/usuarios/login');
        exit;
    }

    $usuario_id = $_SESSION['usuario_id'];

    require_once 'models/Proyecto.php';
    $proyectoModel = new Proyecto();
    $proyectos = $proyectoModel->obtenerProyectosPorUsuario($usuario_id);
    require_once 'views/tareas/crear.php';
}

public function guardar_post()
{
    session_start();

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $titulo = $_POST['titulo'] ?? '';
        $descripcion = $_POST['descripcion'] ?? '';
        $proyectosPorUsuarioId = $_POST['proyectos_por_usuario_id'] ?? '';
        $fechaInicio = $_POST['fecha_inicio'] ?? null;
        require_once 'models/Tarea.php';
        $tareaModel = new Tarea();
        $resultado = $tareaModel->crearTarea($titulo, $descripcion, $proyectosPorUsuarioId,$fechaInicio);

        if ($resultado) {
            $_SESSION['mensaje'] = "Tarea creada con éxito";
        } else {
            $_SESSION['error'] = "Error al crear la tarea";
        }

        header('Location: /pruebaTecnica/tareas/crear');
        exit;
    }
}

}
