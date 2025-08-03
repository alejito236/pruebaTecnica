<?php

require_once 'config/database.php';


class Usuario
{
    private $db;

    public function __construct()
    {
        $this->db = Database::connect();
    }

    public function verificarCredenciales($username, $password)
    {
        $stmt = $this->db->prepare("SELECT * FROM usuarios WHERE user_usuario= ? AND clave_usuario = ?");
        $stmt->execute([$username, $password]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}



?>