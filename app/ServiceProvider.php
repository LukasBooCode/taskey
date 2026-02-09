<?php

namespace App;

use App\Controllers\HomeController;
use App\Controllers\TaskController;
use Framework\ServiceProviderInterface;
use Framework\ServiceContainer;

class ServiceProvider implements ServiceProviderInterface
{
    public function register(ServiceContainer $container): void
    {
        $container->set(HomeController::class, new HomeController());
        $container->set(TaskController::class, new TaskController());
    }
}
