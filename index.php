<?php

use Meirelles\BackendBrCriptografia\Infra\AppException;
use Meirelles\BackendBrCriptografia\Infra\Router;

require 'vendor/autoload.php';

$router = Router::getInstance();

require 'src/routes.php';

$method = $_SERVER['REQUEST_METHOD'];
$uri = $_SERVER['REQUEST_URI'];

$response = compact('method', 'uri');

header('Content-Type: application/json');

try {
    $response = $router->route($method, $uri);
} catch (AppException $e) {
    $response = $e->handleResponse();
}

echo json_encode($response);
