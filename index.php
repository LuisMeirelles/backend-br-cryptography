<?php

use Meirelles\BackendBrCriptografia\Core\AppException;
use Meirelles\BackendBrCriptografia\Core\EnvLoader;
use Meirelles\BackendBrCriptografia\Core\Request;
use Meirelles\BackendBrCriptografia\Core\Router;
use Meirelles\BackendBrCriptografia\Cryptography\Exceptions\InternalServerErrorException;

require 'vendor/autoload.php';

$router = Router::getInstance();

require 'src/routes.php';

$method = $_SERVER['REQUEST_METHOD'];
$uri = $_SERVER['REQUEST_URI'];

header('Content-Type: application/json');

try {
    EnvLoader::init();
    $request = new Request();
    $response = $router->dispatch($request);
} catch (AppException $e) {
    $response = $e->handleResponse();
} catch (Throwable $throwable) {
    $response = (new InternalServerErrorException(previous: $throwable))->handleResponse();
}

if ($response !== null) {
    echo json_encode($response);
}
