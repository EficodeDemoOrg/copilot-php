<?php

namespace App\Controllers;

use App\Services\TaskService;
use App\Services\CommentService;
use App\Utils\Validator;
use App\Utils\Security;

class TaskController
{
    private $taskService;
    private $validator;

    public function __construct()
    {
        $this->taskService = new TaskService();
        $this->validator = new Validator();
    }

    public function index(): void
    {
        try {
            $tasks = $this->taskService->getAllTasks();
            
            // Get tag information for tasks
            $tagService = new \App\Services\TagService();
            $taskTagsMap = [];
            foreach ($tasks as $task) {
                $taskTagsMap[$task->getId()] = $tagService->getTagsByIds($task->getTags());
            }
            
            $this->render('tasks/index', [
                'tasks' => $tasks,
                'taskTagsMap' => $taskTagsMap
            ]);
        } catch (\Exception $e) {
            $this->handleError($e->getMessage());
        }
    }

    public function create(): void
    {
        // Get all tags for the form
        $tagService = new \App\Services\TagService();
        $allTags = $tagService->getAllTags();
        
        $this->render('tasks/create', ['allTags' => $allTags]);
    }

    public function store(): void
    {
        try {
            $title = $_POST['title'] ?? '';
            $status = $_POST['status'] ?? 'To Do';
            $selectedTags = $_POST['tags'] ?? [];

            // Validate input
            $errors = $this->validator->validateTask($title, $status);
            if (!empty($errors)) {
                // Get tags for redisplay
                $tagService = new \App\Services\TagService();
                $allTags = $tagService->getAllTags();
                
                $this->render('tasks/create', [
                    'errors' => $errors,
                    'title' => $title,
                    'status' => $status,
                    'allTags' => $allTags
                ]);
                return;
            }

            // Sanitize input
            $title = Security::sanitizeInput($title);
            
            // Create task with tags
            $this->taskService->createTask($title, $status, $selectedTags);
            $this->redirect('index');
            
        } catch (\Exception $e) {
            $this->handleError($e->getMessage());
        }
    }

    public function edit(string $id): void
    {
        try {
            $task = $this->taskService->getTaskById($id);
            if (!$task) {
                $this->handleError('Task not found');
                return;
            }
            
            // Get all tags and assigned tags for the form
            $tagService = new \App\Services\TagService();
            $allTags = $tagService->getAllTags();
            $assignedTags = $tagService->getTagsByIds($task->getTags());
            
            // Get comments for this task
            $commentService = new \App\Services\CommentService();
            $comments = $commentService->getCommentsByTaskId($id);
            
            $this->render('tasks/edit', [
                'task' => $task,
                'allTags' => $allTags,
                'assignedTags' => $assignedTags,
                'comments' => $comments
            ]);
        } catch (\Exception $e) {
            $this->handleError($e->getMessage());
        }
    }

    public function update(string $id): void
    {
        try {
            $task = $this->taskService->getTaskById($id);
            if (!$task) {
                $this->handleError('Task not found');
                return;
            }

            $title = $_POST['title'] ?? '';
            $status = $_POST['status'] ?? '';
            $selectedTags = $_POST['tags'] ?? [];

            // Validate input
            $errors = $this->validator->validateTask($title, $status);
            if (!empty($errors)) {
                // Get tags for redisplay
                $tagService = new \App\Services\TagService();
                $allTags = $tagService->getAllTags();
                $assignedTags = $tagService->getTagsByIds($task->getTags());
                
                // Get comments for this task
                $commentService = new \App\Services\CommentService();
                $comments = $commentService->getCommentsByTaskId($id);
                
                $this->render('tasks/edit', [
                    'task' => $task,
                    'allTags' => $allTags,
                    'assignedTags' => $assignedTags,
                    'comments' => $comments,
                    'errors' => $errors,
                    'title' => $title,
                    'status' => $status
                ]);
                return;
            }

            // Sanitize input
            $title = Security::sanitizeInput($title);
            
            // Update task
            $updatedTask = $this->taskService->updateTask($id, $title, $status);
            
            // Update tags
            if (is_array($selectedTags)) {
                $updatedTask->setTags($selectedTags);
                $this->taskService->saveTask($updatedTask);
            }
            
            $this->redirect('index');
            
        } catch (\Exception $e) {
            $this->handleError($e->getMessage());
        }
    }

    public function delete(string $id): void
    {
        try {
            $this->taskService->deleteTask($id);
            $this->redirect('index');
        } catch (\Exception $e) {
            $this->handleError($e->getMessage());
        }
    }

    private function render(string $view, array $data = []): void
    {
        extract($data);
        $viewFile = __DIR__ . "/../../views/{$view}.php";
        
        if (!file_exists($viewFile)) {
            throw new \RuntimeException("View file not found: {$viewFile}");
        }
        
        include $viewFile;
    }

    private function redirect(string $action): void
    {
        $url = "index.php?action={$action}";
        header("Location: {$url}");
        exit;
    }

    private function handleError(string $message): void
    {
        error_log("TaskController Error: {$message}");
        $this->render('error', ['message' => $message]);
    }
}
