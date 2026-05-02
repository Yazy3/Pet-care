<?php
declare(strict_types=1);

define('BASE_PATH', dirname(__DIR__));

require_once BASE_PATH . '/app/core/Session.php';
require_once BASE_PATH . '/app/core/Flash.php';
Session::start();

ini_set('display_errors', 1);
error_reporting(E_ALL);

$controllerName = preg_replace('/[^a-zA-Z]/', '', $_GET['controller'] ?? 'auth');
$action = preg_replace('/[^a-zA-Z]/', '', $_GET['action'] ?? 'index');
$id = isset($_GET['id']) ? (int) $_GET['id'] : 0;

// dynamic controller
$controllerClass = ucfirst($controllerName) . 'Controller';
$controllerFile = BASE_PATH . "/app/controllers/{$controllerClass}.php";

if (!file_exists($controllerFile)) {
    http_response_code(404);
    exit("Controller '{$controllerClass}' not found.");
}

require_once $controllerFile;

if (!class_exists($controllerClass)) {
    http_response_code(500);
    exit("Controller class '{$controllerClass}' not found.");
}

$controller = new $controllerClass();

if (!method_exists($controller, $action)) {
    http_response_code(404);
    exit("Action '{$action}' not found.");
}

// call method
if ($id !== 0) {
    $controller->$action($id);
} else {
    $controller->$action();
}