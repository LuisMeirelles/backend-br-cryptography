<?php

namespace Meirelles\BackendBrCriptografia\Cryptography\Exceptions;

use Meirelles\BackendBrCriptografia\Core\AppException;

class NotFoundException extends AppException
{
    protected $code = 404;
    protected $message = 'Not Found';
}