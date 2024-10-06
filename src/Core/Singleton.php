<?php

namespace Meirelles\BackendBrCryptography\Core;

trait Singleton
{
    protected static ?self $instance = null;

    private function __construct()
    {
    }

    public static function getInstance(): static
    {
        if (self::$instance === null) {
            self::$instance = new static();
        }

        return self::$instance;
    }
}