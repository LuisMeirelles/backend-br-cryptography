<?php

namespace Meirelles\BackendBrCryptography\Core;

use Attribute;

#[Attribute]
abstract class EnvValidator
{
    public string $value;
    public string $name;

    abstract function validate(): void;
}