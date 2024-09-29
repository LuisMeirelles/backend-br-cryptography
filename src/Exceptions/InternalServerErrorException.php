<?php

namespace Meirelles\BackendBrCriptografia\Exceptions;

use Meirelles\BackendBrCriptografia\Infra\AppException;

class InternalServerErrorException extends AppException
{
    protected $code = 500;
    protected $message = 'Internal Server Error';
}