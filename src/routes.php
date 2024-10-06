<?php

global $router;

use Meirelles\BackendBrCryptography\User\Controllers\CreateUser;

$router->post('/users', new CreateUser());
