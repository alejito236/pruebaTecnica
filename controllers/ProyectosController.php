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

        $proyecto = new Proyecto();

        if ($proyecto->crearProyecto($usuarioId, $nombre, $descripcion)) {
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
}
