<?php

namespace App\Services;

use App\Models\User;
use App\Repositories\UserRepositoryInterface;
use Framework\Session;

class AuthService
{
    private UserRepositoryInterface $userRepository;
    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }
    public function register(User $user, string $password): User
    {
        $passwordHashed = password_hash($password, PASSWORD_DEFAULT);
        $user->password = $passwordHashed;
        $this->userRepository->insert($user);
        return $user;
    }
    public function login(string $username, string $password, Session $session): User | null | false
    {
        $user = $this->userRepository->findByUsername($username);
        $passwordHashed = $user->password ?? '';
        if (password_verify($password, $passwordHashed)) {
            $session->setAttribute("user", $user);
            return $user;
        }
        return false;
    }
}
