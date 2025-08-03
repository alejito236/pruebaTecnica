<?php
class Tarea{
    private $conn;
    
    public function __construct()
    {
        $this->conn = Database::connect();
    }

    public function obtenerTareasPorUsuario($usuario_id){
        $sql = "select * from proyectos_por_usuario where usuario_id ='$usuario_id';";
        $stmt = $this->conn->prepare($sql);
        $stmt-> execute();
        return  $stmt->fetchAll(PDO::FETCH_ASSOC); 
    }
}
?>