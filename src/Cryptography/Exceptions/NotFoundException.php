<?php

namespace Meirelles\BackendBrCryptography\Cryptography\Exceptions;

use Meirelles\BackendBrCryptography\Core\AppException;

class NotFoundException extends AppException
{
    protected $code = 404;
    protected $message = 'Not Found';
}