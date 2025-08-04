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


public function editar($id)
{   
    $tareaModel = new Tarea();
    $resultado = $tareaModel->obtenerTareaPorId($id);
    if (!$resultado) {
        $_SESSION['error'] = "Tarea no encontrada.";
        header('Location: /pruebaTecnica/dashboard/index');
        exit;
    }
    require_once 'views/tareas/editar.php';
}

    public function actualizar_post()
{
    session_start();

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $id = $_POST['id'] ?? null;
        $nombre = $_POST['nombre'] ?? '';
        $descripcion = $_POST['descripcion'] ?? '';
       
        if (!$id) {
            $_SESSION['error'] = "ID de proyecto no válido.";
            header('Location: /pruebaTecnica/dashboard/index');
            exit;
        }

    $tareaModel = new Tarea();
        if ($tareaModel->actualizarTarea($id, $nombre, $descripcion)) {
            $_SESSION['mensaje'] = "Proyecto actualizado con éxito.";
        } else {
            $_SESSION['error'] = "Error al actualizar el proyecto.";
        }

        header("Location: /pruebaTecnica/tareas/editar/$id");
        exit;
    }
}

public function finalizar_post()
{
    session_start();
    
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $tareaId = $_POST['tarea_id'] ?? null;
      
        if ($tareaId) {
            $tareaModel = new Tarea();

            if ($tareaModel->finalizarTarea($tareaId)) {
                $_SESSION['mensaje'] = "Tarea finalizada con éxito.";
            } else {
                $_SESSION['error'] = "No se pudo finalizar la tarea.";
            }
        } else {
            $_SESSION['error'] = "ID de tarea no proporcionado.";
        }

        header('Location: /pruebaTecnica/dashboard/index');
        exit;
    }
}


}
