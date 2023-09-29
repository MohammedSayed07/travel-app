<?php
namespace app\core;

class Application
{
    protected Request $request;
    public Router $router;

    public function __construct()
    {
        $this->request = new Request();
        $this->router = new Router($this->request);
    }

    /**
     * @return void
     */
    public function run(): void
    {
        $this->router->resolve();
    }
}