<?php

namespace Meirelles\BackendBrCriptografia\Controllers;

use Meirelles\BackendBrCriptografia\Infra\AbstractController;

class EncryptController extends AbstractController
{
    public function __invoke(): array
    {
        return ['ping' => 'pong'];
    }
}