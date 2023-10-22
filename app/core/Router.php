<?php

namespace app\core;

use app\ErrorHandler;

class Router
{
    protected Request $request;
    protected array $routes = [];

    /**
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * @param string $path
     * @param array $callback
     * @return $this
     */
    public function get(string $path, array $callback): static
    {
        $this->routes['get'][$path] = $callback;

        return $this;
    }

    /**
     * @param string $path
     * @param array $callback
     * @return $this
     */
    public function post(string $path, array $callback): static
    {
        $this->routes['post'][$path] = $callback;

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

            //the controller is in $callback[0] and the action is in $callback[1]
            $this->performAction($callback[0], $callback[1]);
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
