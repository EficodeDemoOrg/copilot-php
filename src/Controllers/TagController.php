<?php

namespace App\Controllers;

use App\Services\TagService;
use Exception;

class TagController
{
    private $tagService;

    public function __construct()
    {
        $this->tagService = new TagService();
    }

    public function index()
    {
        try {
            $tags = $this->tagService->getAllTags();
            $this->render('tags/index', ['tags' => $tags]);
        } catch (Exception $e) {
            $this->handleError($e);
        }
    }

    public function create()
    {
        $this->render('tags/create');
    }

    public function store()
    {
        try {
            $name = $_POST['name'] ?? '';
            $color = $_POST['color'] ?? '#007bff';

            $tag = $this->tagService->createTag($name, $color);
            
            $this->setFlashMessage('Tag created successfully!', 'success');
            $this->redirect('/?action=tags');
        } catch (Exception $e) {
            $this->setFlashMessage('Error: ' . $e->getMessage(), 'error');
            $this->redirect('/?action=create_tag');
        }
    }

    public function edit($id)
    {
        try {
            $tag = $this->tagService->getTagById($id);
            if (!$tag) {
                $this->setFlashMessage('Tag not found', 'error');
                $this->redirect('/?action=tags');
                return;
            }

            $this->render('tags/edit', ['tag' => $tag]);
        } catch (Exception $e) {
            $this->handleError($e);
        }
    }

    public function update($id)
    {
        try {
            $name = $_POST['name'] ?? '';
            $color = $_POST['color'] ?? '#007bff';

            $this->tagService->updateTag($id, $name, $color);
            
            $this->setFlashMessage('Tag updated successfully!', 'success');
            $this->redirect('/?action=tags');
        } catch (Exception $e) {
            $this->setFlashMessage('Error: ' . $e->getMessage(), 'error');
            $this->redirect('/?action=edit_tag&id=' . $id);
        }
    }

    public function delete($id)
    {
        try {
            $this->tagService->deleteTag($id);
            
            $this->setFlashMessage('Tag deleted successfully!', 'success');
            $this->redirect('/?action=tags');
        } catch (Exception $e) {
            $this->setFlashMessage('Error: ' . $e->getMessage(), 'error');
            $this->redirect('/?action=tags');
        }
    }

    public function assignToTask()
    {
        try {
            $taskId = $_POST['task_id'] ?? '';
            $tagId = $_POST['tag_id'] ?? '';

            $this->tagService->assignTagToTask($taskId, $tagId);
            
            $this->setFlashMessage('Tag assigned to task successfully!', 'success');
            $this->redirect('/?action=edit&id=' . $taskId);
        } catch (Exception $e) {
            $this->setFlashMessage('Error: ' . $e->getMessage(), 'error');
            $this->redirect('/');
        }
    }

    public function removeFromTask()
    {
        try {
            $taskId = $_POST['task_id'] ?? $_GET['task_id'] ?? '';
            $tagId = $_POST['tag_id'] ?? $_GET['tag_id'] ?? '';

            $this->tagService->removeTagFromTask($taskId, $tagId);
            
            $this->setFlashMessage('Tag removed from task successfully!', 'success');
            $this->redirect('/?action=edit&id=' . $taskId);
        } catch (Exception $e) {
            $this->setFlashMessage('Error: ' . $e->getMessage(), 'error');
            $this->redirect('/');
        }
    }

    public function filterTasks()
    {
        try {
            $tagIds = $_GET['tags'] ?? [];
            if (!is_array($tagIds)) {
                $tagIds = [$tagIds];
            }

            $tasks = $this->tagService->filterTasksByTags($tagIds);
            $allTags = $this->tagService->getAllTags();
            
            // Get tag objects for the selected tags
            $selectedTags = $this->tagService->getTagsByIds($tagIds);
            
            // Get tag information for tasks
            $taskTagsMap = [];
            foreach ($tasks as $task) {
                $taskTagsMap[$task->getId()] = $this->tagService->getTagsByIds($task->getTags());
            }
            
            $this->render('tasks/index', [
                'tasks' => $tasks,
                'allTags' => $allTags,
                'selectedTags' => $selectedTags,
                'taskTagsMap' => $taskTagsMap,
                'filteredByTags' => !empty($tagIds)
            ]);
        } catch (Exception $e) {
            $this->handleError($e);
        }
    }

    private function render(string $view, array $data = []): void
    {
        extract($data);
        $viewPath = __DIR__ . '/../../views/' . $view . '.php';
        
        if (file_exists($viewPath)) {
            include $viewPath;
        } else {
            throw new \RuntimeException("View not found: $view");
        }
    }

    private function redirect(string $url): void
    {
        header("Location: $url");
        exit;
    }

    private function setFlashMessage(string $message, string $type = 'info'): void
    {
        if (!isset($_SESSION)) {
            session_start();
        }
        $_SESSION['flash_message'] = $message;
        $_SESSION['flash_type'] = $type;
    }

    private function handleError(\Exception $e): void
    {
        error_log($e->getMessage());
        $this->setFlashMessage('An error occurred: ' . $e->getMessage(), 'error');
        $this->redirect('/');
    }
}
