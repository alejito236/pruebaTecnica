<?php
if (!isset($_SESSION)) session_start();
$mensaje = $_SESSION['mensaje'] ?? '';
$error = $_SESSION['error'] ?? '';
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
    <title>Editar Proyecto</title>
    <link rel="stylesheet" href="/pruebaTecnica/assets/css/style.css">
    <style>
        /* (Usamos los mismos estilos de "Crear Proyecto") */
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
    <h3>Editar Proyecto</h3>

    <form action="/pruebaTecnica/proyectos/actualizar" method="post">
        <input type="hidden" name="id" value="<?php echo htmlspecialchars($resultado[0]['idProyectos']); ?>">

        <div class="form-group">
            <label for="nombre">Nombre del Proyecto:</label>
            <input type="text" name="nombre" id="nombre" value="<?php echo htmlspecialchars($resultado[0]['nombre_proyecto']); ?>" required>
        </div>

        <div class="form-group">
            <label for="descripcion">Descripción:</label>
            <textarea name="descripcion" id="descripcion" rows="4" required><?php echo htmlspecialchars($resultado[0]['descripcion_proyecto']); ?></textarea>
        </div>

        <div class="form-group">
            <label for="tarifa">Tarifa:</label>
            <textarea name="tarifa" id="tarifa" rows="4" required><?php echo htmlspecialchars($resultado[0]['tarifa_proyecto']); ?></textarea>
        </div>

        <button type="submit" class="btn-submit">Actualizar Proyecto</button>
    </form>

    <a href="/pruebaTecnica/dashboard/index" class="btn-back">← Volver al Dashboard</a>
</div>

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

</body>
</html>
