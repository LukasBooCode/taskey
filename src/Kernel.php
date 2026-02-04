<?php

namespace Framework;

class Kernel
{
    private Router $router;
    public function __construct()
    {
        $this->router = new Router();
    }

    public function getRouter(): Router
    {
        return $this->router;
    }
    public function handle(Request $request): Response
    {
        $response = $this->router->dispatch($request);
        return $response;
    }
}
