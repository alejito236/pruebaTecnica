<?php
if (!isset($_SESSION)) session_start();
$mensaje = $_SESSION['mensaje'] ?? '';
$error = $_SESSION['error'] ?? '';
$usuarioId = $_SESSION['usuario_id'];
unset($_SESSION['mensaje'], $_SESSION['error']);
if (!isset($_SESSION['usuario_id'])) {
    header('Location: /pruebaTecnica/usuarios/login');
    exit;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Crear Tarea</title>
    <link rel="stylesheet" href="/pruebaTecnica/assets/css/style.css">
    <style>
        .form-container {
            max-width: 600px;
            margin: 60px auto;
            padding: 30px;
            background: #2c2f4a;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.4);
        }

        .form-container h3 {
            text-align: center;
            font-size: 26px;
            margin-bottom: 30px;
            color: #ffffff;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            font-weight: bold;
            margin-bottom: 8px;
            color: #dddddd;
        }

        .form-group input,
        .form-group textarea {
            width: 100%;
            padding: 10px;
            border: none;
            border-radius: 5px;
            background-color: #40444b;
            color: white;
        }

        .form-group input:focus,
        .form-group textarea:focus {
            outline: none;
            background-color: #555b65;
        }

        .btn-submit {
            display: block;
            width: 100%;
            padding: 12px;
            background-color: #7289da;
            border: none;
            border-radius: 5px;
            color: white;
            font-size: 16px;
            cursor: pointer;
        }

        .btn-submit:hover {
            background-color: #5b6eae;
        }

        .btn-back {
            display: block;
            margin-top: 20px;
            text-align: center;
            color: #7289da;
            text-decoration: none;
        }

        .btn-back:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

<div class="form-container">
    <h3>Crear Tarea</h3>
    <form action="/pruebaTecnica/tareas/guardar" method="post">
        <div class="form-group">
            <label for="titulo">Título de la Tarea:</label>
            <input type="text" name="titulo" id="titulo" required>
        </div>

        <div class="form-group">
            <label for="descripcion">Descripción:</label>
            <textarea name="descripcion" id="descripcion" rows="4" required></textarea>
        </div>

        <div class="form-group">
            <label for="proyecto">Proyecto:</label>
            <select name="proyectos_por_usuario_id" required>
                <option value="">-- Selecciona un proyecto --</option>
                <?php foreach ($proyectos as $proyecto): ?>
                    <option value="<?= $proyecto['idproyectos_por_usuario'] ?>">
                        <?= htmlspecialchars($proyecto['nombre_proyecto']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="form-group">
        <label for="fecha_inicio">Fecha de Inicio:</label>
        <input type="date" name="fecha_inicio" id="fecha_inicio" required>
        </div>

        <button type="submit" class="btn-submit">Crear Tarea</button>
    </form>

    <a href="/pruebaTecnica/dashboard/index" class="btn-back">← Volver al Dashboard</a>
</div>
</body>
<?php if ($mensaje): ?>
<script>
    alert("<?php echo $mensaje; ?>");
</script>
<?php endif; ?>

<?php if ($error): ?>
<script>
    alert("<?php echo $error; ?>");
</script>
<?php endif; ?>
</html>
