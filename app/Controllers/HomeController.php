<?php

namespace App\Controllers;

use Framework\Response;
use Framework\ResponseFactory;

class HomeController
{
    private ResponseFactory $responseFactory;
    public function __construct(ResponseFactory $responseFactory)
    {
        $this->responseFactory = $responseFactory;
    }
    public function index(): Response
    {
        $response = $this->responseFactory->body("Welcome to Taskey");
        return $response;
    }
    public function about(): Response
    {
        $response = $this->responseFactory->body("Taskey is Awesome");
        return $response;
    }
}
