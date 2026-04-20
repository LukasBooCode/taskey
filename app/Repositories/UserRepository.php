<?php

namespace App\Repositories;

use App\Models\User;
use Framework\Database;

class UserRepository implements UserRepositoryInterface
{
    private Database $database;
    public function __construct(Database $database)
    {
        $this->database = $database;
    }
    /** @return User[] */
    public function all(): array
    {
        $stmt = $this->database->run("SELECT * FROM users", [])->fetchAll();
        $users = [];
        foreach ($stmt as $row) {
            $user = $this->fromDbRow($row);
            $users[] = $user;
        }
        return $users;
    }
    public function findById(int $id): ?User
    {
        $row = $this->database->run("SELECT * FROM users WHERE id = :id", [
            'id' => $id
        ])->fetch();
        $user = $this->fromDbRow($row);
        return $user;
    }
    public function findByUsername(string $username): ?User
    {
        $row = $this->database->run("SELECT * FROM users WHERE username = :username", [
            'username' => $username
        ])->fetch();
        $user = $this->fromDbRow($row);
        return $user;
    }
    public function insert(User $user): User
    {
        $stmt = $this->database->run("INSERT INTO users
            VALUES (:name, :username, :password)", [
                'name' => $user->name,
                'username' => $user->username,
                'password' => $user->password
        ]);
        return $user;
    }
    public function update(User $user): User
    {
        $stmt = $this->database->run("UPDATE users
            SET name = :name, username = :username, password = :password", [
            'name' => $user->name,
            'username' => $user->username,
            'password' => $user->password
        ]);
        return $user;
    }
    private function fromDbRow(mixed $row): User
    {
        $user = new User();
        $user->id = $row->id;
        $user->name = $row->name;
        $user->username = $row->username;
        $user->password = $row->password;
        return $user;
    }
}
