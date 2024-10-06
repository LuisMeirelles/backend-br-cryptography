<?php

namespace Meirelles\BackendBrCryptography\User\Services;

use Meirelles\BackendBrCryptography\Env;

class SensitiveDataService
{
    private static function getCypherAlgo(): string
    {
        return Env::getInstance()->cypherAlgo;
    }

    private static function getPassphrase(): string
    {
        return Env::getInstance()->encryptionPassphrase;
    }

    public function encrypt($data): string
    {
        $cypher_algo = self::getCypherAlgo();

        $ivlen = openssl_cipher_iv_length($cypher_algo);
        $iv = openssl_random_pseudo_bytes($ivlen);
        $cyphertext = openssl_encrypt($data, $cypher_algo, self::getPassphrase(), iv: $iv);

        return $iv . $cyphertext;
    }

    public function decrypt($cyphertext): false|string
    {
        $iv = substr($cyphertext, 0, 16);
        $cyphertext = substr($cyphertext, 16);

        return openssl_decrypt($cyphertext, self::getCypherAlgo(), self::getPassphrase(), iv: $iv);
    }
}