<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mi Dashboard</title>
    <link rel="stylesheet" href="/pruebaTecnica/assets/css/style.css">
</head>
<body>


<div class="saludo-box">
    Bienvenido, <strong><?php echo isset($_SESSION['username']) ? htmlspecialchars($_SESSION['username']) : 'Usuario'; ?></strong>
</div>
<div class="dashboard">
    <a class="card proyectos" href="/pruebaTecnica/proyectos/usuario/<?= $_SESSION['usuario_id'] ?>">
        <h3>Mis Proyectos</h3>
        <p>Total: <?= $totalProyectos ?></p>
        <span class="link-text">Ver proyectos</span>
    </a>

    <a class="card tareas" href="/pruebaTecnica/tareas/vista/<?= $_SESSION['usuario_id'] ?>">
        <h3>Mis Tareas</h3>
        <p>Total: <?= $totalTareas ?></p>
        <span class="link-text">Ver tareas</span>
    </a>

   <a class="card reportes" href="/pruebaTecnica/reportes/index">
    <h3>Zona Reportes</h3>
    <p>Generar reportes personalizados</p>
    <span class="link-text">Ir a reportes</span>
</a>

</div>
<div class="logout-container">
    <form action="/pruebaTecnica/usuarios/logout" method="post">
        <button type="submit" class="btn-logout">Cerrar sesión</button>
    </form>
</div>