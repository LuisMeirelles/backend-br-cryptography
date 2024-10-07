<?php

global $router;

use Meirelles\BackendBrCryptography\User\Controllers\CreateUser;
use Meirelles\BackendBrCryptography\User\Controllers\GetUser;

$router->post('/users', new CreateUser());
$router->get('/users/:id', new GetUser());
