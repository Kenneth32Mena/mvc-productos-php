<?php
require_once __DIR__ . '/../config/config.php';

$controllerParam = $_GET['controller'] ?? 'producto';
$action = $_GET['action'] ?? 'index';

$allowedControllers = [
    'producto'  => 'ProductoController',
    'categoria' => 'CategoriaController'
];

if (!isset($allowedControllers[$controllerParam])) {
    http_response_code(404);
    die('Controlador no permitido');
}

$controllerClass = $allowedControllers[$controllerParam];
$controllerFile = __DIR__ . '/../app/controllers/' . $controllerClass . '.php';

if (!file_exists($controllerFile)) {
    http_response_code(404);
    die('Archivo del controlador no encontrado');
}

require_once $controllerFile;
$instance = new $controllerClass();

if (!method_exists($instance, $action)) {
    http_response_code(404);
    die('Acción no válida');
}

$instance->$action();
