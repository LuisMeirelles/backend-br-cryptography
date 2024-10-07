<?php

namespace Meirelles\BackendBrCryptography\Core\Environment\Validators;

use Attribute;
use BackedEnum;
use Meirelles\BackendBrCryptography\Core\AppException;
use ValueError;

#[Attribute]
class OpensslCipherAlgo extends EnvValidator
{
    /**
     * @throws \Meirelles\BackendBrCryptography\Core\AppException
     */
    public function validate(): void
    {
        $opensslCipherMethods = openssl_get_cipher_methods();
        $validCypherMethod = in_array($this->value, $opensslCipherMethods);

        if (!$validCypherMethod) {
            $opensslCypherMethods = implode(', ', $opensslCipherMethods);
            $message = "Invalid OPENSSL_CIPHER_ALGO value: `$this->value`. Valid values are: $opensslCypherMethods";

            throw new AppException($message);
        }
    }
}
