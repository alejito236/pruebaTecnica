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
    <title>Zona de Reportes</title>
    <link rel="stylesheet" href="/pruebaTecnica/assets/css/style.css">
</head>

<body>
<div class="dashboard">
    <div class="card-container full-width">
        <div class="card proyectos large">
            <h3>Zona de Reportes</h3>
            <p>Selecciona qué tabla deseas exportar a Excel:</p>
        <div style="position: relative;left: -130px;">
  <form action="/pruebaTecnica/reportes/exportar" method="post" style="display: flex; gap: 10px; align-items: center; margin-bottom: 20px;">
                <select name="tabla" class="form-select" required>
                    <option value="">Selecciona una tabla</option>
                    <option value="tareas">📋 Tareas</option>
                    <option value="proyectos">📁 Proyectos</option>
                </select>
                <button type="submit" class="btn-add-task">Exportar</button>
            </form>
        </div>
          

            <a href="/pruebaTecnica/dashboard/index" class="btn-back">← Volver al Dashboard</a>
        </div>
    </div>
</div>
</body>

</html>