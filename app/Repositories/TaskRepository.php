<?php

namespace App\Repositories;

use App\Models\Task;

class TaskRepository implements TaskRepositoryInterface
{
    /** @var array<int, mixed> */
    private array $tempTasks = array(
        array(
            "id" => 1,
            "title" => "Form the Fellowship",
            "description" => "Assemble representatives of the Free Peoples in Rivendell",
            "priority" => 3,
            "status" => 4,
            "progress" => 100,
            "created_at" => 1008710400,
            "completed_at" => 1008720400),
        array(
            "id" => 2,
            "title" => "Cross the Misty Mountains",
            "description" => "Find a safe passage through or around the mountains",
            "priority" => 2,
            "status" => 1,
            "progress" => 50,
            "created_at" => 1008720400,
            "completed_at" => null),
        array(
            "id" => 3,
            "title" => "Enter Moria",
            "description" => "Take the risky path through the Mines of Moria",
            "priority" => 2,
            "status" => 3,
            "progress" => 0,
            "created_at" => 1008740400,
            "completed_at" => null)
    );

    /**
     * @return array<Task>
     */
    public function all(): array
    {
        $tasks = array();
        foreach ($this->tempTasks as $task) {
            $tasks[] = $task;
        }
        return $tasks;
    }

    public function find(int $id): ?Task
    {
        $task = new Task();
        foreach ($this->tempTasks as $singleTask) {
            if ($id === $singleTask['id']) {
                $task->id = $singleTask['id'];
                $task->title = $singleTask['title'];
                $task->description = $singleTask['description'];
                $task->priority = $singleTask['priority'];
                $task->status = $singleTask['status'];
                $task->progress = $singleTask['progress'];
                $task->createdAt = $singleTask['created_at'];
                $task->completedAt = $singleTask['completed_at'];
                return $task;
            }
        }
        return null;
    }
}
