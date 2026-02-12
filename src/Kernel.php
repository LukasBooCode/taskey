<?php

namespace Framework;

use PHP_CodeSniffer\Config;

class Kernel
{
    private Router $router;

    private ServiceContainer $container;
    private ConfigManager $configManager;

    /**
     * @param string[] $config
     * @throws \Exception
     */
    public function __construct(array $config)
    {
        $this->container = new ServiceContainer();

        $configManager = new ConfigManager($config);
        $debugMode = $configManager->get('APP_ENV');
        $viewsPath = $configManager->get('VIEWS_PATH');

        $responseFactory = new ResponseFactory($debugMode, $viewsPath);
        $this->container->set(ResponseFactory::class, $responseFactory);

        $this->router = new Router($responseFactory);
    }

    public function registerRoutes(RouteProviderInterface $routerProvider): void
    {
        $routerProvider->register($this->router, $this->container);
    }

    public function registerServices(ServiceProviderInterface $serviceProvider): void
    {
        $serviceProvider->register($this->container);
    }

    /**
     * Handle the incoming Request and produce a Response.
     *
     * @param Request $request
     * @return Response
     */
    public function handle(Request $request): Response
    {
        return $this->router->dispatch($request);
    }
}
