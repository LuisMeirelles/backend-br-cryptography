<?php

namespace Meirelles\BackendBrCryptography;

use Meirelles\BackendBrCryptography\Core\Environment\BaseEnv;
use Meirelles\BackendBrCryptography\Core\Environment\Enums\Environment;
use Meirelles\BackendBrCryptography\Core\Environment\Validators\Enum;
use Meirelles\BackendBrCryptography\Core\Environment\Validators\OpensslCipherAlgo;

class Env extends BaseEnv
{
    #[Enum(Environment::class)]
    public Environment $environment;

    public string $dbHost;
    public string $dbDatabase;
    public string $dbUsername;
    public string $dbPassword;
    public string $encryptionPassphrase;

    #[OpensslCipherAlgo]
    public string $cypherAlgo;
}