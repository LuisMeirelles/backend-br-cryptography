<?php

namespace Meirelles\BackendBrCriptografia\Cryptography\Exceptions;

use Meirelles\BackendBrCriptografia\Core\AppException;

class NotImplementedException extends AppException
{
    protected $code = 501;
    protected $message = 'Not Implemented';
}