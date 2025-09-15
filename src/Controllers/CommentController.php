<?php

namespace App\Controllers;

use App\Services\CommentService;
use App\Services\UnauthorizedAccessException;

class CommentController
{
    private $commentService;

    public function __construct()
    {
        $this->commentService = new CommentService();
    }

    public function index()
    {
        $taskId = $_GET['task_id'] ?? null;
        if (!$taskId) {
            $this->redirect('/');
            return;
        }

        try {
            $comments = $this->commentService->getCommentsByTaskId($taskId);
            $this->render('comments/index', [
                'comments' => $comments,
                'taskId' => $taskId
            ]);
        } catch (Exception $e) {
            $this->handleError($e);
        }
    }

    public function create()
    {
        $taskId = $_GET['task_id'] ?? null;
        if (!$taskId) {
            $this->redirect('/');
            return;
        }

        $this->render('comments/create', ['taskId' => $taskId]);
    }

    public function store()
    {
        try {
            $taskId = $_POST['task_id'] ?? '';
            $content = $_POST['content'] ?? '';
            $author = $_POST['author'] ?? 'Anonymous';

            $comment = $this->commentService->createComment($taskId, $content, $author);
            
            $this->setFlashMessage('Comment added successfully!', 'success');
            $this->redirect('/?action=edit&id=' . $taskId);
        } catch (Exception $e) {
            $this->setFlashMessage('Error: ' . $e->getMessage(), 'error');
            $this->redirect('/?action=create_comment&task_id=' . ($_POST['task_id'] ?? ''));
        }
    }

    public function edit($id)
    {
        try {
            $comment = $this->commentService->getCommentById($id);
            if (!$comment) {
                $this->setFlashMessage('Comment not found', 'error');
                $this->redirect('/');
                return;
            }

            $this->render('comments/edit', ['comment' => $comment]);
        } catch (Exception $e) {
            $this->handleError($e);
        }
    }

    public function update($id)
    {
        try {
            $content = $_POST['content'] ?? '';
            $author = $_POST['author'] ?? 'Anonymous';

            $this->commentService->updateComment($id, $content, $author);
            
            $comment = $this->commentService->getCommentById($id);
            $this->setFlashMessage('Comment updated successfully!', 'success');
            $this->redirect('/?action=edit&id=' . $comment->getTaskId());
        } catch (UnauthorizedAccessException $e) {
            $this->setFlashMessage('Unauthorized: ' . $e->getMessage(), 'error');
            $this->redirect('/');
        } catch (Exception $e) {
            $this->setFlashMessage('Error: ' . $e->getMessage(), 'error');
            $this->redirect('/?action=edit_comment&id=' . $id);
        }
    }

    public function updateAjax($id)
    {
        header('Content-Type: application/json');
        
        try {
            $content = $_POST['content'] ?? '';
            $author = $_POST['author'] ?? 'Anonymous';

            $this->commentService->updateComment($id, $content, $author);
            
            echo json_encode([
                'success' => true,
                'message' => 'Comment updated successfully!'
            ]);
        } catch (UnauthorizedAccessException $e) {
            http_response_code(403);
            echo json_encode([
                'success' => false,
                'message' => 'Unauthorized: ' . $e->getMessage()
            ]);
        } catch (Exception $e) {
            http_response_code(500);
            echo json_encode([
                'success' => false,
                'message' => 'Error: ' . $e->getMessage()
            ]);
        }
        exit;
    }

    public function delete($id)
    {
        try {
            $author = $_POST['author'] ?? $_GET['author'] ?? 'Anonymous';
            
            $comment = $this->commentService->getCommentById($id);
            if (!$comment) {
                $this->setFlashMessage('Comment not found', 'error');
                $this->redirect('/');
                return;
            }

            $taskId = $comment->getTaskId();
            $this->commentService->deleteComment($id, $author);
            
            $this->setFlashMessage('Comment deleted successfully!', 'success');
            $this->redirect('/?action=edit&id=' . $taskId);
        } catch (UnauthorizedAccessException $e) {
            $this->setFlashMessage('Unauthorized: ' . $e->getMessage(), 'error');
            $this->redirect('/');
        } catch (Exception $e) {
            $this->setFlashMessage('Error: ' . $e->getMessage(), 'error');
            $this->redirect('/');
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
