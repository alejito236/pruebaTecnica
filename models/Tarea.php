<?php
class Tarea{
    private $conn;
    
    public function __construct()
    {
        $this->conn = Database::connect();
    }



     public function contarPorUsuario($usuarioId)
    {
        $db = Database::connect();
        $stmt = $db->prepare("SELECT count(*)  AS total FROM prueba_practica.tareas p INNER JOIN proyectos_por_usuario pu on p.id_proyecto_usuario = pu.idproyectos_por_usuario inner join  usuarios u on pu.usuario_id= u.idusuario where u.idusuario = :usuario_id;");
        $stmt->bindParam(':usuario_id', $usuarioId, PDO::PARAM_INT);
        $stmt->execute();
        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
        return $resultado['total'] ?? 0;
    }
    public function obtenerTareasPorUsuario($usuario_id){
        $sql = " SELECT t.idtareas,t.nombre_tarea AS nombre_tarea, t.descripicion_tarea AS descripcion, t.fecha_inicio as fecha_inicio, p.nombre_proyecto as nombre_proyecto FROM tareas t INNER JOIN proyectos_por_usuario pu ON t.id_proyecto_usuario = pu.idproyectos_por_usuario INNER JOIN usuarios u ON pu.usuario_id = u.idusuario INNER JOIN proyectos p ON pu.proyecto_id = p.idProyectos where u.idusuario ='$usuario_id';";
        $stmt = $this->conn->prepare($sql);
        $stmt-> execute();
        return  $stmt->fetchAll(PDO::FETCH_ASSOC); 
    }


    public function crearTarea($titulo, $descripcion, $proyectosPorUsuarioId,$fechaInicio)
{
    $sql = "INSERT INTO tareas (nombre_tarea, descripicion_tarea, fecha_inicio, id_proyecto_usuario) 
            VALUES (:nombre_tarea, :descripicion_tarea, :fecha_inicio, :id_proyecto_usuario)";
    $stmt = $this->conn->prepare($sql);
    $stmt->bindParam(':nombre_tarea', $titulo);
    $stmt->bindParam(':descripicion_tarea', $descripcion);
    $stmt->bindParam(':id_proyecto_usuario', $proyectosPorUsuarioId);
    $stmt->bindParam(':fecha_inicio', $fechaInicio);

    return $stmt->execute();
}


    public function obtenerTareaPorId($id)
    {

        $sql = "SELECT * FROM tareas WHERE idtareas  ='$id';";
        $stmt = $this->conn->prepare($sql);
        $stmt-> execute();
        return  $stmt->fetchAll(PDO::FETCH_ASSOC); 
    }

public function actualizarTarea($id, $nombre, $descripcion)
{
    try {
        $sql = "UPDATE tareas SET nombre_tarea = :nombre, descripicion_tarea = :descripcion WHERE idtareas = :id";
        $stmtRelacion = $this->conn->prepare($sql);
        $stmtRelacion->bindParam(':nombre', $nombre);
        $stmtRelacion->bindParam(':descripcion', $descripcion);
        $stmtRelacion->bindParam(':id', $id);
        $stmtRelacion->execute();
        return true;
    } catch (Exception $e) {
        echo "Error al actualizar tarea: " . $e->getMessage();
        return false;
    }
}

}
?>