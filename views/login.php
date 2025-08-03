<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Iniciar sesión</title>
    <style>
        body { font-family: Arial; background-color: #f4f4f4; }
        .login-container { width: 300px; margin: 100px auto; padding: 20px; background: white; border-radius: 8px; box-shadow: 0 0 10px rgba(0,0,0,0.1); }
        input[type="text"], input[type="password"] { width: 100%; padding: 10px; margin: 8px 0; box-sizing: border-box; }
        input[type="submit"] { width: 100%; padding: 10px; background-color: #007BFF; border: none; color: white; cursor: pointer; }
        input[type="submit"]:hover { background-color: #0056b3; }
        .error { color: red; text-align: center; }
    </style>
</head>
<body>
    <div class="login-container">
        <h2 style="text-align:center;">Login</h2>
        <?php if (!empty($_SESSION['error'])) : ?>
            <p class="error"><?= $_SESSION['error']; unset($_SESSION['error']); ?></p>
        <?php endif; ?>
        <form method="POST" action="/pruebaTecnica/usuarios/autenticar">
            <input type="text" name="username" placeholder="Usuario" required>
            <input type="password" name="password" placeholder="Contraseña" required>
            <input type="submit" value="Ingresar">
        </form>
    </div>
</body>
</html>
