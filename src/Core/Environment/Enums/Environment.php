<?php

namespace Meirelles\BackendBrCryptography\Core\Environment\Enums;

enum Environment: string
{
    case Local = 'local';
    case Staging = 'staging';
    case Production = 'production';
}
