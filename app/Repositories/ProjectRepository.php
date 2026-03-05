<?php

namespace App\Repositories;

use Framework\Database;
use App\Models\Project;

class ProjectRepository implements ProjectRepositoryInterface
{
    private Database $database;

    public function __construct(Database $database)
    {
        $this->database = $database;
    }

    /** @return Project[] */
    public function all(): array
    {
        $stmt = $this->database->run("SELECT * FROM projects ORDER BY title")->fetchAll();
        $projects = [];
        foreach ($stmt as $row) {
            $project = $this->fromDbRow($row);
            $projects[] = $project;
        }
        return $projects;
    }

    private function fromDbRow(mixed $row): Project
    {
        $project = new Project();
        $project->id = $row->id;
        $project->title = $row->title;
        $project->description = $row->description;
        return $project;
    }

    public function find(string $id): Project
    {
        return new Project();
    }

    public function insert(Project $project): Project
    {
        return new Project();
    }

    public function update(Project $project): bool
    {
        return true;
    }

    public function delete(Project $project): bool
    {
        return true;
    }
}
