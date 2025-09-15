<?php

namespace App\Services;

use App\Models\Comment;
use App\Storage\CommentStorage;
use App\Storage\JsonStorage;
use App\Utils\Validator;

class CommentService
{
    private $commentStorage;
    private $taskStorage;
    private $validator;

    public function __construct()
    {
        $this->commentStorage = new CommentStorage();
        $this->taskStorage = new JsonStorage();
        $this->validator = new Validator();
    }

    public function createComment(string $taskId, string $content, string $author): Comment
    {
        // Validate task exists
        $task = $this->taskStorage->getTaskById($taskId);
        if (!$task) {
            throw new \InvalidArgumentException("Task not found");
        }

        // Validate comment data
        $this->validator->validateRequiredField($content, 'Comment content');
        $this->validator->validateRequiredField($author, 'Author');
        
        if (strlen(trim($content)) < 1) {
            throw new \InvalidArgumentException("Comment content cannot be empty");
        }

        $comment = new Comment($taskId, trim($content), trim($author));
        
        if (!$this->commentStorage->saveComment($comment)) {
            throw new \RuntimeException("Failed to save comment");
        }

        // Update task comment count
        $this->updateTaskCommentCount($taskId);

        return $comment;
    }

    public function getCommentsByTaskId(string $taskId): array
    {
        return $this->commentStorage->getCommentsByTaskId($taskId);
    }

    public function getCommentById(string $id): ?Comment
    {
        return $this->commentStorage->getCommentById($id);
    }

    public function updateComment(string $id, string $content, string $author): bool
    {
        $comment = $this->commentStorage->getCommentById($id);
        if (!$comment) {
            throw new \InvalidArgumentException("Comment not found");
        }

        // Check if user can edit this comment
        if ($comment->getAuthor() !== $author) {
            throw new \UnauthorizedAccessException("You can only edit your own comments");
        }

        // Validate new content
        $this->validator->validateRequiredField($content, 'Comment content');
        
        if (strlen(trim($content)) < 1) {
            throw new \InvalidArgumentException("Comment content cannot be empty");
        }

        $comment->setContent(trim($content));
        
        return $this->commentStorage->saveComment($comment);
    }

    public function deleteComment(string $id, string $author): bool
    {
        $comment = $this->commentStorage->getCommentById($id);
        if (!$comment) {
            throw new \InvalidArgumentException("Comment not found");
        }

        // Check if user can delete this comment
        if ($comment->getAuthor() !== $author) {
            throw new \UnauthorizedAccessException("You can only delete your own comments");
        }

        $taskId = $comment->getTaskId();
        $result = $this->commentStorage->deleteComment($id);
        
        if ($result) {
            // Update task comment count
            $this->updateTaskCommentCount($taskId);
        }
        
        return $result;
    }

    private function updateTaskCommentCount(string $taskId): void
    {
        $task = $this->taskStorage->getTaskById($taskId);
        if ($task) {
            $commentCount = $this->commentStorage->countCommentsByTaskId($taskId);
            $task->setCommentCount($commentCount);
            $this->taskStorage->saveTask($task);
        }
    }
}

class UnauthorizedAccessException extends \Exception {}
