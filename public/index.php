<?php

require_once __DIR__ . '/../vendor/autoload.php';

$routes = require __DIR__ . '/routes.php';

$requestUri = strtok($_SERVER['REQUEST_URI'], '?');
$requestMethod = $_SERVER['REQUEST_METHOD'];

foreach ($routes as $route => $handler) {
    list($method, $uri) = explode(' ', $route);

    if ($method === $requestMethod && $uri === $requestUri) {
        [$controller, $action] = $handler;
        $controllerInstance = new $controller();
        $controllerInstance->$action();
        exit;
    }
}

http_response_code(404);
echo json_encode(['error' => 'Ruta no encontrada']);