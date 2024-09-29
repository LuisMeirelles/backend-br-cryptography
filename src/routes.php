<?php

global $router;

use Meirelles\BackendBrCriptografia\Controllers\EncryptController;

$router->post('/encrypt', new EncryptController);
