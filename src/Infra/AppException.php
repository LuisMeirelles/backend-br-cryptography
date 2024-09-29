<?php

namespace Meirelles\BackendBrCriptografia\Infra;

use Exception;
use Throwable;

class AppException extends Exception
{
    public function __construct(
        string           $message = "",
        protected ?array $details = null,
        ?Throwable       $previous = null
    )
    {
        parent::__construct($message, $this->getCode(), $previous);
    }

    public function handleResponse(): array
    {
        http_response_code($this->getCode());

        $response = [
            'message' => $this->getMessage()
        ];

        $details = $this->details;

        if ($details !== null) {
            $response['details'] = $details;
        }

        return $response;
    }
}