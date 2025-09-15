<?php

namespace App\Storage;

use App\Models\Task;

class JsonStorage
{
    private $filePath;

    public function __construct(?string $filePath = null)
    {
        $this->filePath = $filePath ?? __DIR__ . '/../../data/tasks.json';
        $this->ensureFileExists();
    }

    public function getAllTasks(): array
    {
        $data = $this->readFile();
        $tasks = [];
        
        foreach ($data as $taskData) {
            $tasks[] = Task::fromArray($taskData);
        }
        
        return $tasks;
    }

    public function getTaskById(string $id): ?Task
    {
        $tasks = $this->getAllTasks();
        
        foreach ($tasks as $task) {
            if ($task->getId() === $id) {
                return $task;
            }
        }
        
        return null;
    }

    public function saveTask(Task $task): bool
    {
        $tasks = $this->getAllTasks();
        $found = false;
        
        // Update existing task or add new one
        for ($i = 0; $i < count($tasks); $i++) {
            if ($tasks[$i]->getId() === $task->getId()) {
                $tasks[$i] = $task;
                $found = true;
                break;
            }
        }
        
        if (!$found) {
            $tasks[] = $task;
        }
        
        return $this->saveTasks($tasks);
    }

    public function deleteTask(string $id): bool
    {
        $tasks = $this->getAllTasks();
        $filteredTasks = [];
        
        foreach ($tasks as $task) {
            if ($task->getId() !== $id) {
                $filteredTasks[] = $task;
            }
        }
        
        return $this->saveTasks($filteredTasks);
    }

    private function saveTasks(array $tasks): bool
    {
        $data = [];
        foreach ($tasks as $task) {
            $data[] = $task->toArray();
        }
        
        return $this->writeFile($data);
    }

    private function readFile(): array
    {
        if (!file_exists($this->filePath)) {
            return [];
        }
        
        $content = file_get_contents($this->filePath);
        if ($content === false) {
            throw new \RuntimeException("Unable to read tasks file: {$this->filePath}");
        }
        
        $data = json_decode($content, true);
        if (json_last_error() !== JSON_ERROR_NONE) {
            throw new \RuntimeException("Invalid JSON in tasks file: " . json_last_error_msg());
        }
        
        return $data ?? [];
    }

    private function writeFile(array $data): bool
    {
        $json = json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        if ($json === false) {
            throw new \RuntimeException("Unable to encode tasks to JSON: " . json_last_error_msg());
        }
        
        // Use file locking to prevent concurrent access issues
        $result = file_put_contents($this->filePath, $json, LOCK_EX);
        if ($result === false) {
            throw new \RuntimeException("Unable to write tasks file: {$this->filePath}");
        }
        
        return true;
    }

    private function ensureFileExists(): void
    {
        if (!file_exists($this->filePath)) {
            $directory = dirname($this->filePath);
            if (!is_dir($directory)) {
                mkdir($directory, 0755, true);
            }
            $this->writeFile([]);
        }
    }
}
