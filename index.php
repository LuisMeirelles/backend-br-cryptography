<?php

use Meirelles\BackendBrCriptografia\Exceptions\InternalServerErrorException;
use Meirelles\BackendBrCriptografia\Infra\AppException;
use Meirelles\BackendBrCriptografia\Infra\Request;
use Meirelles\BackendBrCriptografia\Infra\Router;

require 'vendor/autoload.php';

$router = Router::getInstance();

require 'src/routes.php';

$method = $_SERVER['REQUEST_METHOD'];
$uri = $_SERVER['REQUEST_URI'];

header('Content-Type: application/json');

try {
    $request = new Request();
    $response = $router->dispatch($request);
} catch (AppException $e) {
    $response = $e->handleResponse();
} catch (Throwable $throwable) {
    $response = (new InternalServerErrorException(previous: $throwable))->handleResponse();
}

echo json_encode($response);
