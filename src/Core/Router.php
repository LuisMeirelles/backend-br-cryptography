<?php

namespace Meirelles\BackendBrCryptography\Core;

use Meirelles\BackendBrCryptography\Cryptography\Exceptions\NotFoundException;

class Router
{
    private static ?Router $instance = null;
    private array $routes = [];

    private function __construct()
    {
    }

    public static function getInstance(): Router
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    public function register(string $uri, AbstractController $action, HttpMethod $method): void
    {
        $this->routes[$method->value][$uri] = $action;
    }

    public function post(string $uri, AbstractController $action): void
    {
        $this->register($uri, $action, HttpMethod::POST);
    }

    /**
     * @throws \Meirelles\BackendBrCryptography\Cryptography\Exceptions\NotImplementedException
     * @throws \Meirelles\BackendBrCryptography\Cryptography\Exceptions\NotFoundException
     */
    public function dispatch(Request $request): mixed
    {
        $action = $this->routes[$request->getMethod()->value][$request->getUri()] ?? null;

        if ($action === null) {
            throw new NotFoundException('The requested route was not found');
        }

        return call_user_func($action, $request);
    }
}