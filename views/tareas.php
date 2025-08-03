
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Listado de Tareas</title>
    <style>
        table { border-collapse: collapse; width: 70%; margin: 20px auto; }
        th, td { border: 1px solid #ccc; padding: 10px; text-align: center; }
        th { background-color: #f4f4f4; }
    </style>
</head>
<body>
    <h2 style="text-align:center;">Listado de Tareas del Usuario</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Tarea</th>
                <th>Proyecto</th>
                <th>Valor</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($tareas)) : ?>
                <?php foreach ($tareas as $tarea) : ?>
                    <tr>
                        <td><?= $tarea['nombre_usuario'] ?></td>
                        <td><?= $tarea['nombre_usuario'] ?></td>
                        <td><?= $tarea['nombre_usuario'] ?></td>
                        <td><?= $tarea['nombre_usuario'] ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php else : ?>
                <tr>
                    <td colspan="4">No hay tareas para este usuario.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</body>
</html>
