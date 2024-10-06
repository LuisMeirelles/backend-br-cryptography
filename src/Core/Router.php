<?php

namespace Meirelles\BackendBrCryptography\Core;

use Meirelles\BackendBrCryptography\Exceptions\NotFoundException;

class Router
{
    use Singleton;

    /** @var array<string, array<string, callable>> $routes */
    private array $routes = [];

    private DynamicRouteMatcher $dynamicRouteMatcher;

    private function __construct()
    {
        $this->dynamicRouteMatcher = new DynamicRouteMatcher();
    }

    public function register(string $uri, AbstractController $action, HttpMethod $method): void
    {
        $this->routes[$method->value][$uri] = $action;
    }

    public function post(string $uri, AbstractController $action): void
    {
        $this->register($uri, $action, HttpMethod::POST);
    }

    public function get(string $uri, AbstractController $action): void
    {
        $this->register($uri, $action, HttpMethod::GET);
    }

    public function put(string $uri, AbstractController $action): void
    {
        $this->register($uri, $action, HttpMethod::PUT);
    }

    public function delete(string $uri, AbstractController $action): void
    {
        $this->register($uri, $action, HttpMethod::DELETE);
    }

    /**
     * @throws \Meirelles\BackendBrCryptography\Exceptions\NotImplementedException
     * @throws \Meirelles\BackendBrCryptography\Exceptions\NotFoundException
     */
    public function dispatch(Request $request): mixed
    {
        $httpMethod = $request->getMethod();
        $routesByHttpMethod = $this->routes[$httpMethod->value];

        $action = $this->dynamicRouteMatcher->match($request, $routesByHttpMethod);

        $action ??= $routesByHttpMethod[$request->getUri()] ?? null;

        if ($action === null) {
            throw new NotFoundException('The requested route was not found');
        }

        return call_user_func($action, $request);
    }
}