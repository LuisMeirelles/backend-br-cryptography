<?php

global $router;

use Meirelles\BackendBrCryptography\Cryptography\Controllers\EncryptController;

$router->post('/encrypt', new EncryptController());
