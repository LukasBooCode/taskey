<?php

namespace App\Repositories;

use App\Models\Task;

interface TaskRepositoryInterface
{
    /**
     * @return array<Task>
     */
    public function all(): array;
    public function find(int $id): ?Task;
}
