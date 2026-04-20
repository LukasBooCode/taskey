<?php

namespace App\Controllers;

use App\Models\User;
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
    public function registerForm(): Response
    {
        return $this->responseFactory->view('users/register.html.twig');
    }
    public function register(Request $request): Response
    {
        $errors = $this->validateRegister($request);
        if (!empty($errors)) {
            return $this->responseFactory->view('users/register.html.twig', [
                'errors' => $errors
            ]);
        }

        $user = new User();
        $user->name = $request->get('full-name') ?? '';
        $user->username = $request->get('username') ?? '';
        $password = $request->get('password') ?? '';

        $user = $this->authService->register($user, $password);

        return $this->responseFactory->redirect('/');
    }
    public function loginForm(): Response
    {
        return $this->responseFactory->view('users/login.html.twig');
    }
    public function login(Request $request): Response
    {
        $errors = $this->validateLogin($request);
        if (!empty($errors)) {
            return $this->responseFactory->view('users/login.html.twig', [
                'errors' => $errors
            ]);
        }
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
    /** @return string[] */
    private function validateRegister(Request $request): array
    {
        $errors = [];

        if (!$request->get('full-name')) {
            $errors['fullName'] = 'Name may not be empty';
        }

        $username = $request->get('username') ?? '';
        if (!$username) {
            $errors['username'] = 'Username may not be empty';
        }
        if ($this->userRepository->findByUsername($username)) {
            $errors['usernameExists'] = 'User with this name already exists';
        }

        if (!$request->get('password')) {
            $errors['password'] = 'Password may not be empty';
        }

        return $errors;
    }
    /** @return string[] */
    private function validateLogin(Request $request): array
    {
        $errors = [];

        $username = $request->get('username') ?? '';
        $password = $request->get('password');
        if (!$username) {
            $errors['username'] = 'Username may not be empty';
        }
        if (!$password) {
            $errors['password'] = 'Password may not be empty';
        }

        $user = $this->userRepository->findByUsername($username);
        if (
            $username &&
            $password &&
            !$user
        ) {
            $errors['usernameNotFound'] = "User doesn't exist.";
        }
        if (
            $username &&
            $password &&
            $user &&
            !$this->authService->login($username, $password)
        ) {
            $errors['credentials'] = 'Invalid credentials. Either username or password is incorrect.';
        }

        return $errors;
    }
}
