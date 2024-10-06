<?php

namespace Meirelles\BackendBrCryptography\Cryptography\Models;

use Meirelles\BackendBrCryptography\Core\Model;

class UserInfo extends Model
{
    public readonly int $id;

    public function __construct(
        public readonly string $userDocument,
        public readonly string $creditCardToken,
        public readonly int $value,
    )
    {
        parent::__construct();
    }
}