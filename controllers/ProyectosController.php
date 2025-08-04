<?php

class ProyectosController
{
    public function usuario($idUsuario)
    {
       
        $proyectosModel = new Proyecto();  
        $proyectos = $proyectosModel->obtenerProyectosPorUsuario($idUsuario);
        require_once __DIR__ . '/../views/proyectos/index.php';
    }


        public function crear()
    {
        require_once __DIR__ . '/../views/proyectos/crear.php';
    }


    public function crear_post()
{   

    session_start();    
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $nombre = $_POST['nombre'] ?? '';
        $descripcion = $_POST['descripcion'] ?? '';
        $usuarioId = $_SESSION['usuario_id'] ?? null;
        $tarifa = $_SESSION['tarifa'] ?? null;

        $proyecto = new Proyecto();

        if ($proyecto->crearProyecto($usuarioId, $nombre, $descripcion,$tarifa)) {
            $_SESSION['mensaje'] = "Proyecto creado con éxito";
            header('Location: /pruebaTecnica/proyectos/crear');
            exit;
        } else {
            $_SESSION['error'] = "Error al crear el proyecto";
            header('Location: /pruebaTecnica/proyectos/crear');
            exit;
        }
    }
}

public function editar($id)
{   
    $proyectoModel = new Proyecto();
    $resultado = $proyectoModel->obtenerProyectoPorId($id);
    if (!$resultado) {
        $_SESSION['error'] = "Proyecto no encontrado.";
        header('Location: /pruebaTecnica/dashboard/index');
        exit;
    }
    require_once 'views/proyectos/editar.php';
}

    public function actualizar_post()
{
    session_start();

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $id = $_POST['id'] ?? null;
        $nombre = $_POST['nombre'] ?? '';
        $descripcion = $_POST['descripcion'] ?? '';
        $tarifa = $_POST['tarifa'] ?? '';
        if (!$id) {
            $_SESSION['error'] = "ID de proyecto no válido.";
            header('Location: /pruebaTecnica/dashboard/index');
            exit;
        }

        $proyecto = new Proyecto();
        if ($proyecto->actualizarProyecto($id, $nombre, $descripcion, $tarifa)) {
            $_SESSION['mensaje'] = "Proyecto actualizado con éxito.";
        } else {
            $_SESSION['error'] = "Error al actualizar el proyecto.";
        }

        header("Location: /pruebaTecnica/proyectos/editar/$id");
        exit;
    }
}

}
