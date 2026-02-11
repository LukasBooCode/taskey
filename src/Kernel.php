<?php

namespace Framework;

class Kernel
{
    private Router $router;
    private ServiceContainer $container;
    public function __construct()
    {
        $this->container = new ServiceContainer();
        $responseFactory = new ResponseFactory();
        $this->container->set(ResponseFactory::class, $responseFactory);
        $this->router = new Router($responseFactory);
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
