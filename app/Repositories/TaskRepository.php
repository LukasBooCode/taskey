<?php

namespace App\Repositories;

use App\Models\Task;
use Framework\Database;

class TaskRepository implements TaskRepositoryInterface
{
    private Database $database;

    public function __construct(Database $database)
    {
        $this->database = $database;
    }

    /**
     * @return Task[]
     */
    public function all(): array
    {
        $tasks = array();
        $data = $this->database->run("SELECT * FROM tasks ORDER BY tasks.title")->fetchAll();

        foreach ($data as $row) {
            $task = $this->createTaskFrom($row);
            $tasks[] = $task;
        }

        return $tasks;
    }

    public function find(int $id): ?Task
    {
        $row = $this->database->run("SELECT * FROM tasks WHERE id = :id", [
            'id' => $id
        ])->fetch();

        if ($row['id'] === $id) {
            $task = $this->createTaskFrom($row);
            return $task;
        }
        return null;
    }
    private function createTaskFrom(mixed $data): Task
    {
        $task = new Task();

        $task->id = $data['id'];
        $task->title = $data['title'];
        $task->description = $data['description'];
        $task->priority = $data['priority'];
        $task->status = $data['status'];
        $task->progress = $data['progress'];
        $task->createdAt = $data['created_at'];
        $task->completedAt = $data['completed_at'];

        return $task;
    }
}
