<?php

namespace Meirelles\BackendBrCryptography\Cryptography\Exceptions;

use Meirelles\BackendBrCryptography\Core\AppException;

class NotImplementedException extends AppException
{
    protected $code = 501;
    protected $message = 'Not Implemented';
}