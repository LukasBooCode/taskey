<?php

namespace Framework;

class Kernel
{
    private Router $router;
    private ServiceContainer $container;
    public function __construct()
    {
        $this->router = new Router();
        $this->container = new ServiceContainer();
    }

    public function registerRoutes(RouteProviderInterface $routeProvider): void
    {
        $routeProvider->register($this->router, $this->container);
    }

    public function registerServices(ServiceProviderInterface $serviceProvider): void
    {
        $serviceProvider->register($this->container);
    }
    public function handle(Request $request): Response
    {
        $response = $this->router->dispatch($request);
        return $response;
    }
}
