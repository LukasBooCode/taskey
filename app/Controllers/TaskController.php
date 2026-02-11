<?php

namespace App\Controllers;

use Framework\Response;
use Framework\ResponseFactory;

class TaskController
{
    private ResponseFactory $responseFactory;
    public function __construct(ResponseFactory $responseFactory)
    {
        $this->responseFactory = $responseFactory;
    }
    public function index(): Response
    {
        $response = $this->responseFactory->body("These are the Tasks");
        return $response;
    }
    public function create(): Response
    {
        $response = $this->responseFactory->body("Create a new Task");
        return $response;
    }
}
