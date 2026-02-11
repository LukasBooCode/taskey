<?php

namespace App;

use App\Controllers\HomeController;
use App\Controllers\TaskController;
use Framework\Response;
use Framework\ServiceProviderInterface;
use Framework\ServiceContainer;
use Framework\ResponseFactory;

class ServiceProvider implements ServiceProviderInterface
{
    public function register(ServiceContainer $container): void
    {
        $responseFactory = $container->get(ResponseFactory::class);
        $container->set(HomeController::class, new HomeController($responseFactory));
        $container->set(TaskController::class, new TaskController($responseFactory));
    }
}
