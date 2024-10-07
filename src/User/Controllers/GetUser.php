<?php

declare(strict_types=1);

namespace Meirelles\BackendBrCryptography\User\Controllers;

use Meirelles\BackendBrCryptography\Core\AbstractController;
use Meirelles\BackendBrCryptography\Core\Request;
use Meirelles\BackendBrCryptography\Exceptions\NotFoundException;
use Meirelles\BackendBrCryptography\User\Models\User;

class GetUser extends AbstractController
{
    /**
     * @throws \ReflectionException
     * @throws \Meirelles\BackendBrCryptography\Exceptions\NotFoundException
     */
    public function __invoke(Request $request): User
    {
        $params = $request->route();
        $id = $params->id;

        $user = User::find($id);

        if ($user === null) {
            throw new NotFoundException('The requested user was not found', [
                'resource' => 'user',
                'id' => $id,
            ]);
        }

        return $user;
    }
}