<?php

namespace Meirelles\BackendBrCriptografia\Controllers;

use Meirelles\BackendBrCriptografia\Infra\AbstractController;
use Meirelles\BackendBrCriptografia\Infra\Request;

class EncryptController extends AbstractController
{
    /**
     * @throws \JsonException
     */
    public function __invoke(Request $request)
    {
        return $request->body();
    }
}