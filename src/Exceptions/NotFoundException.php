<?php

namespace Meirelles\BackendBrCryptography\Exceptions;

use Meirelles\BackendBrCryptography\Core\AppException;

class NotFoundException extends AppException
{
    protected $code = 404;
    protected $message = 'Not Found';
}