<?php
if (!isset($_SESSION)) session_start();
if (!isset($_SESSION['usuario_id'])) {
    header('Location: /pruebaTecnica/usuarios/login');
    exit;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Mis Proyectos</title>
    <link rel="stylesheet" href="/pruebaTecnica/assets/css/style.css">
</head>
<body>
    <div class="dashboard">

        <div class="card-container full-width">
            <div class="card proyectos large">
                <h3>Mis Proyectos</h3>

                <?php if (!empty($proyectos)) : ?>
                    <table class="styled-table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nombre</th>
                                <th>Descripción</th>
                                <th>tarifa</th>
                                <th>accion</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($proyectos as $proyecto) : ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($proyecto['idProyectos']); ?></td>
                                    <td><?php echo htmlspecialchars($proyecto['nombre_proyecto']); ?></td>
                                    <td><?php echo htmlspecialchars($proyecto['descripcion_proyecto']); ?></td>
                                    <td><?php echo htmlspecialchars($proyecto['tarifa_proyecto']); ?></td>
                                    <td>
                                        <a href="/pruebaTecnica/proyectos/editar/<?php echo $proyecto['idProyectos']; ?>" class="btn-edit">Editar</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>

                    <a href="/pruebaTecnica/proyectos/crear" class="btn-add-task">+ Nuevo proyecto</a>
                <?php else : ?>
                    <p>No tienes proyectos asignados.</p>
                <?php endif; ?>
                    <a href="/pruebaTecnica/dashboard/index" class="btn-back">← Volver al Dashboard</a>
                </div>
        </div>
    </div>
</body>
</html>
