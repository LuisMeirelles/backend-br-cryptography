<?php

namespace Meirelles\BackendBrCriptografia\Cryptography\Exceptions;

use Meirelles\BackendBrCriptografia\Core\AppException;

class InternalServerErrorException extends AppException
{
    protected $code = 500;
    protected $message = 'Internal Server Error';
}