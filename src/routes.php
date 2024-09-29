<?php

global $router;

use Meirelles\BackendBrCriptografia\Cryptography\Controllers\EncryptController;

$router->post('/encrypt', new EncryptController());
