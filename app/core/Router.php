<?php

namespace app\core;

use app\ErrorHandler;

class Router
{
    protected Request $request;
    public array $routes = [];

    /**
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    private function add(string $method, string $path, array $callback): void
    {
        $callback['middleware'] = null;
        $this->routes[$method][$path] = $callback;
    }

    /**
     * @param string $path
     * @param array $callback
     * @return $this
     */
    public function get(string $path, array $callback): static
    {
        $this->add(method: 'get', path: $path, callback: $callback);

        return $this;
    }

    /**
     * @param string $path
     * @param array $callback
     * @return $this
     */
    public function post(string $path, array $callback): static
    {
        $this->add(method: 'post', path: $path, callback: $callback);

        return $this;
    }

    public function only(string $allowed, string $method): static
    {
        $this->routes[$method][array_key_last($this->routes[$method])]['middleware'] = $allowed;
        return $this;
    }

    /**
     * @return void
     */
    public function resolve(): void
    {
        $path = $this->request->getPath();
        $method = $this->request->getMethod();
        if (isset($this->routes[$method][$path])) {
            $callback = $this->routes[$method][$path];

            $this->performAction($callback['controller'], $callback['action']);
        }
        else {
            ErrorHandler::handleErrors(404);
        }
    }

    private function performAction(mixed $controller, string $action): void
    {
        $controller = new $controller;
        $controller->{$action}();
    }
}
