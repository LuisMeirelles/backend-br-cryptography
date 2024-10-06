<?php

namespace Meirelles\BackendBrCryptography\Core;

enum HttpMethod: string
{
    case POST = 'POST';
    case GET = 'GET';
    case PUT = 'PUT';
    case DELETE = 'DELETE';
}
