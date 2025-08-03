<?php

class Database{
    public static function connect(){
        try {
            $host = 'localhost';
            $db = 'prueba_practica';
            $user ='root';
            $pass ='1912';
            
            $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8", $user,$pass);
            $pdo-> setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            
            return $pdo;
        } catch (PDOException $e) {
            die("Error en la conexion:" .$e->getMessage());
        }
    }

}
?>