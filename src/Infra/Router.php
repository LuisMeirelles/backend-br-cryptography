<?php

namespace Meirelles\BackendBrCriptografia\Infra;

use Meirelles\BackendBrCriptografia\Exceptions\NotFoundException;
use Meirelles\BackendBrCriptografia\Exceptions\NotImplementedException;

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
     * @throws \Meirelles\BackendBrCriptografia\Exceptions\NotImplementedException
     * @throws \Meirelles\BackendBrCriptografia\Exceptions\NotFoundException
     */
    public function route(string $method, string $uri): mixed
    {
        $requestedMethod = HttpMethod::tryFrom($method);

        if ($requestedMethod === null) {
            throw new NotImplementedException(
                'The requested method was not implemented',
                [
                    'requested' => $method,
                    'allowed' => HttpMethod::cases()
                ]
            );
        }

        $action = $this->routes[$requestedMethod->value][$uri] ?? null;

        if ($action === null) {
            throw new NotFoundException('The requested route was not found');
        }

        return call_user_func($action);
    }
}