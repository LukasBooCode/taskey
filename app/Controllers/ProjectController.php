<?php

namespace App\Controllers;

use App\Repositories\ProjectRepositoryInterface;
use Framework\ResponseFactory;
use Framework\Response;

class ProjectController
{
    private ResponseFactory $responseFactory;

    private ProjectRepositoryInterface $projectRepository;

    public function __construct(
        ResponseFactory $responseFactory,
        ProjectRepositoryInterface $projectRepository
    ) {
        $this->responseFactory = $responseFactory;
        $this->projectRepository = $projectRepository;
    }

    public function index(): Response
    {
        $projects = $this->projectRepository->all();
        return $this->responseFactory->view("projects/index.html.twig", ["projects" => $projects]);
    }
}
