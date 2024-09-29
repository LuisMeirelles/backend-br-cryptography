<?php

namespace Meirelles\BackendBrCriptografia\Exceptions;

use Meirelles\BackendBrCriptografia\Infra\AppException;

class NotImplementedException extends AppException
{
    protected $code = 501;
    protected $message = 'Not Implemented';
}