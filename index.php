<?php

$url = $_GET['url'] ?? '';
$url = rtrim($url, '/');
$segments = explode('/', $url);

$controllerName = !empty($segments[0]) ? ucfirst($segments[0]) .'Controller' : 'ApiController';
$actionName = $segments[1] ?? 'index';
$params = array_slice($segments, 2);

require_once 'config/database.php';
require_once 'models/Proyecto.php';
require_once 'models/Usuario.php';
require_once 'models/Tarea.php';

$controllerPath = 'controllers/' . $controllerName . '.php';

if (!file_exists($controllerPath)) {
    http_response_code(404);
    echo "Controlador '$controllerName' no encontrado.";
    exit;
}

require_once $controllerPath;

if (!class_exists($controllerName)) {
    http_response_code(500);
    echo "Clase '$controllerName' no encontrada.";
    exit;
}

$controller = new $controllerName();

if (!method_exists($controller, $actionName)) {
    http_response_code(404);
    echo "Método '$actionName' no encontrado en el controlador '$controllerName'.";
    exit;
}

call_user_func_array([$controller, $actionName], $params);