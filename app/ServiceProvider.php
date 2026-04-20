<?php

namespace App;

use App\Controllers\HomeController;
use App\Controllers\ProjectController;
use App\Controllers\TagController;
use App\Controllers\TaskController;
use App\Controllers\UserController;
use App\Repositories\ProjectRepository;
use App\Repositories\ProjectRepositoryInterface;
use App\Repositories\TagRepository;
use App\Repositories\TaskRepository;
use App\Repositories\TaskRepositoryInterface;
use App\Repositories\UserRepository;
use App\Repositories\UserRepositoryInterface;
use App\Services\AuthService;
use Exception;
use Framework\Database;
use Framework\ResponseFactory;
use Framework\ServiceContainer;
use Framework\ServiceProviderInterface;

class ServiceProvider implements ServiceProviderInterface
{
    /**
     * @throws Exception
     */
    public function register(ServiceContainer $container): void
    {
        $responseFactory = $container->get(ResponseFactory::class);

        $database = $container->get(Database::class);

        $tagRepository = new TagRepository($database);

        $taskRepository = new TaskRepository($database, $tagRepository);
        $container->set(TaskRepositoryInterface::class, $taskRepository);

        $projectRepository = new ProjectRepository($database);
        $container->set(ProjectRepositoryInterface::class, $projectRepository);

        $userRepository = new UserRepository($database);
        $container->set(UserRepositoryInterface::class, $userRepository);

        $authService = new AuthService($userRepository);
        $container->set(AuthService::class, $authService);

        $tagController = new TagController($responseFactory, $tagRepository, $taskRepository);
        $container->set(TagController::class, $tagController);

        $homeController = new HomeController($responseFactory);
        $container->set(HomeController::class, $homeController);

        $taskController = new TaskController($responseFactory, $taskRepository, $projectRepository, $tagRepository);
        $container->set(TaskController::class, $taskController);

        $projectController = new ProjectController($responseFactory, $projectRepository, $taskRepository);
        $container->set(ProjectController::class, $projectController);

        $userController = new UserController($responseFactory, $userRepository, $authService);
        $container->set(UserController::class, $userController);
    }
}
