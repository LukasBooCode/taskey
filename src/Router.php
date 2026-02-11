<?php

namespace Framework;

class Router
{
    public ResponseFactory $responseFactory;
    /** @var Route[] */
    public array $routes;
    public function __construct(ResponseFactory $responseFactory)
    {
        $this->responseFactory = $responseFactory;
    }

    public function dispatch(Request $request): Response
    {
        $matchedRoute = null;
        foreach ($this->routes as $route) {
            if ($route->matches($request->method, $request->path)) {
                $matchedRoute = $route;
                break;
            }
        }
        if ($matchedRoute === null) {
            return $this->responseFactory->notFound();
        }
        $callback = $matchedRoute->callback;
        $response = $callback(); //To clarify: the callback returns a Response object with a string inside the body.
        return $response;
    }

    public function addRoute(string $method, string $path, callable $callback): void
    {
        $this->routes[] = new Route($method, $path, $callback);
    }
}
