<?php
require_once 'config/database.php';

class Proyecto
{

    private $conn;
    
    public function __construct()
    {
        $this->conn = Database::connect();
    }

    public function contarPorUsuario($usuarioId)
    {
        $db = Database::connect();
        $stmt = $db->prepare("SELECT COUNT(*) AS total FROM proyectos_por_usuario WHERE usuario_id = :usuario_id");
        $stmt->bindParam(':usuario_id', $usuarioId, PDO::PARAM_INT);
        $stmt->execute();
        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
        return $resultado['total'] ?? 0;
    }

     public function obtenerProyectosPorUsuario($usuario_id){
        $sql = "select p.idProyectos,pu.idproyectos_por_usuario, p.nombre_proyecto,p.descripcion_proyecto from proyectos_por_usuario pu inner join proyectos p on pu.proyecto_id= p.idProyectos inner join usuarios  u on pu.usuario_id= u.idusuario where usuario_id ='$usuario_id';";
        $stmt = $this->conn->prepare($sql);
        $stmt-> execute();
        return  $stmt->fetchAll(PDO::FETCH_ASSOC); 
    }


   public function crearProyecto($usuarioId, $nombre, $descripcion)
{
    try {
        $this->conn->beginTransaction();

        $sqlProyecto = "INSERT INTO proyectos (nombre_proyecto, descripcion_proyecto) VALUES (:nombre, :descripcion)";
        $stmtProyecto = $this->conn->prepare($sqlProyecto);
        $stmtProyecto->bindParam(':nombre', $nombre);
        $stmtProyecto->bindParam(':descripcion', $descripcion);
        $stmtProyecto->execute();

        $proyectoId = $this->conn->lastInsertId();

        $sqlRelacion = "INSERT INTO proyectos_por_usuario (usuario_id, proyecto_id) VALUES (:usuarioId, :proyectoId)";
        $stmtRelacion = $this->conn->prepare($sqlRelacion);
        $stmtRelacion->bindParam(':usuarioId', $usuarioId);
        $stmtRelacion->bindParam(':proyectoId', $proyectoId);
        $stmtRelacion->execute();

        $this->conn->commit();

        return true;

    } catch (Exception $e) {
        $this->conn->rollBack();
        echo "Error al crear proyecto: " . $e->getMessage();
        return false;
    }
}

}

?>