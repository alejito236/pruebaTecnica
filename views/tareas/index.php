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
    <title>Mis Tareas</title>
    <link rel="stylesheet" href="/pruebaTecnica/assets/css/style.css">
</head>
<body>
    <div class="dashboard">

         <div class="card-container full-width">
            <div class="card proyectos large">
                <h3>Mis Tareas</h3>

                <?php if (!empty($tareas)) : ?>
                    <table class="styled-table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Tarea</th>
                                <th>Descripción</th>
                                <th>Proyecto</th>
                                <th>fecha inicio</th>
                                <th>Accion</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($tareas as $tarea) : ?>
                                <tr>
                                    <td><?= htmlspecialchars($tarea['idtareas']) ?></td>
                                    <td><?= htmlspecialchars($tarea['nombre_tarea']) ?></td>
                                    <td><?= htmlspecialchars($tarea['descripcion']) ?></td>
                                    <td><?= htmlspecialchars($tarea['nombre_proyecto']) ?></td>
                                    <td><?= htmlspecialchars($tarea['fecha_inicio']) ?></td>
                                    <td>
                                        <a href="/pruebaTecnica/tareas/editar/<?php echo $tarea['idtareas']; ?>" class="btn-edit">Editar</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>

                    <a href="/pruebaTecnica/tareas/crear" class="btn-add-task">+ Nueva tarea</a>
                <?php else : ?>
                    <p>No tienes tareas registradas.</p>
                <?php endif; ?>

                <a href="/pruebaTecnica/dashboard/index" class="btn-back">← Volver al Dashboard</a>
            </div>
        </div>
    </div>
</body>
</html>
