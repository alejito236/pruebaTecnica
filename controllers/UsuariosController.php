<?php 
session_start();
require_once 'models/Usuario.php';

class UsuariosController
{
    public function login()
    {
        require_once 'views/login.php';
    }

    public function autenticar()
    {
        $username = $_POST['username'] ?? '';
        $password = $_POST['password'] ?? '';

        $usuarioModel = new Usuario();
        $usuario = $usuarioModel->verificarCredenciales($username, $password);

        if ($usuario) {
            $_SESSION['usuario_id'] = $usuario['idusuario'];
            $_SESSION['username'] = $usuario['user_usuario'];
            header('Location: /pruebaTecnica/dashboard/index');
            exit;
        } else {
            $_SESSION['error'] = "Usuario o contraseña incorrectos.";
            header('Location: /pruebaTecnica/usuarios/login');
            exit;
        }
    }

    public function logout()
    {
        session_destroy();
        header('Location: /pruebaTecnica/usuarios/login');
        exit;
    }
}

?>