<?php

namespace App\Controllers;

use App\Repositories\UserRepositoryInterface;
use App\Services\AuthService;
use Framework\Request;
use Framework\Response;
use Framework\ResponseFactory;

class UserController
{
    private ResponseFactory $responseFactory;
    private UserRepositoryInterface $userRepository;
    private AuthService $authService;
    public function __construct(
        ResponseFactory $responseFactory,
        UserRepositoryInterface $userRepository,
        AuthService $authService
    ) {
        $this->responseFactory = $responseFactory;
        $this->userRepository = $userRepository;
        $this->authService = $authService;
    }
    public function registerForm(Request $request): Response
    {
        return $this->responseFactory->view('users/register.html.twig');
    }
    public function register(Request $request): Response
    {
        return $this->responseFactory->redirect('/');
    }
    public function loginForm(Request $request): Response
    {
        return $this->responseFactory->view('users/login.html.twig');
    }
    public function login(Request $request): Response
    {
        return $this->responseFactory->view('index.html.twig', [
            'loggedIn' => true
        ]);
    }
    public function logout(Request $request): Response
    {
        return $this->responseFactory->view('index.html.twig', [
            'loggedIn' => false
        ]);
    }
    public function profile(Request $request): Response
    {
        return new Response();
    }
}
