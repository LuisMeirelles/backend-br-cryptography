<?php

namespace Meirelles\BackendBrCryptography\Exceptions;

use Meirelles\BackendBrCryptography\Core\AppException;

class NotImplementedException extends AppException
{
    protected $code = 501;
    protected $message = 'Not Implemented';
}