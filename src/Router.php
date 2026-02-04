<?php

namespace Framework;

class Router
{
    /** @var Route[] */
    public array $routes;
    public function __construct()
    {
    }

    public function dispatch(Request $request): Response
    {
        foreach ($this->routes as $route) {
            if ($route->matches($request->method, $request->path)) {
                return new Response($route->return);
            }
        }
        return new Response("Page not found", 404);
    }

    public function addRoute(string $method, string $path, string $return): void
    {
        $this->routes[] = new Route($method, $path, $return);
    }
}
