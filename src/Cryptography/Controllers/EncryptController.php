<?php

declare(strict_types=1);

namespace Meirelles\BackendBrCryptography\Cryptography\Controllers;

use Meirelles\BackendBrCryptography\Core\AbstractController;
use Meirelles\BackendBrCryptography\Core\Request;
use Meirelles\BackendBrCryptography\Cryptography\Models\UserInfo;

class EncryptController extends AbstractController
{
    /**
     * @throws \JsonException
     */
    public function __invoke(Request $request): void
    {
        $params = $request->body();

        $userDocument = $params->userDocument;
        $creditCardToken = $params->creditCardToken;
        $value = $params->value;

        $userInfo = new UserInfo(
            $userDocument,
            $creditCardToken,
            $value,
        );

        $userInfo->save();

        http_response_code(201);
    }
}