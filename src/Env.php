<?php

namespace Meirelles\BackendBrCryptography;

use Meirelles\BackendBrCryptography\Core\Environment\BaseEnv;

class Env extends BaseEnv
{
    public string $serverName;
    public string $email;
    public string $environment;
    public string $dbHost;
    public string $dbDatabase;
    public string $dbUsername;
    public string $dbPassword;
    public string $dbRootPassword;
    public string $encryptionPassphrase;
    public string $cypherAlgo;
}