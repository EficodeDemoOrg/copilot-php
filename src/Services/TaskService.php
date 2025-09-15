<?php

namespace App\Services;

use App\Models\Task;
use App\Storage\JsonStorage;

class TaskService
{
    private $storage;

    public function __construct()
    {
        $this->storage = new JsonStorage();
    }

    public function getAllTasks(): array
    {
        return $this->storage->getAllTasks();
    }

    public function getTaskById(string $id): ?Task
    {
        return $this->storage->getTaskById($id);
    }

    public function createTask(string $title, string $status = Task::STATUS_TODO, array $tagIds = []): Task
    {
        $task = new Task($title, $status);
        
        // Set tags if provided
        if (!empty($tagIds)) {
            $task->setTags($tagIds);
        }
        
        if (!$this->storage->saveTask($task)) {
            throw new \RuntimeException('Failed to save task');
        }
        
        return $task;
    }

    public function updateTask(string $id, string $title, string $status): Task
    {
        $task = $this->storage->getTaskById($id);
        
        if (!$task) {
            throw new \InvalidArgumentException("Task with ID {$id} not found");
        }
        
        $task->setTitle($title);
        $task->setStatus($status);
        
        if (!$this->storage->saveTask($task)) {
            throw new \RuntimeException('Failed to update task');
        }
        
        return $task;
    }

    public function deleteTask(string $id): bool
    {
        $task = $this->storage->getTaskById($id);
        
        if (!$task) {
            throw new \InvalidArgumentException("Task with ID {$id} not found");
        }
        
        return $this->storage->deleteTask($id);
    }

    public function getTasksByStatus(string $status): array
    {
        $allTasks = $this->getAllTasks();
        $filteredTasks = [];
        
        foreach ($allTasks as $task) {
            if ($task->getStatus() === $status) {
                $filteredTasks[] = $task;
            }
        }
        
        return $filteredTasks;
    }

    public function getTaskCount(): int
    {
        return count($this->getAllTasks());
    }

    public function getTaskCountByStatus(): array
    {
        $tasks = $this->getAllTasks();
        $counts = [
            Task::STATUS_TODO => 0,
            Task::STATUS_IN_PROGRESS => 0,
            Task::STATUS_DONE => 0
        ];
        
        foreach ($tasks as $task) {
            $status = $task->getStatus();
            if (isset($counts[$status])) {
                $counts[$status]++;
            }
        }
        
        return $counts;
    }

    public function saveTask(Task $task): bool
    {
        return $this->storage->saveTask($task);
    }
}
