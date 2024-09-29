<?php

namespace Meirelles\BackendBrCriptografia\Exceptions;

use Meirelles\BackendBrCriptografia\Infra\AppException;

class NotFoundException extends AppException
{
    protected $code = 404;
    protected $message = 'Not Found';
}