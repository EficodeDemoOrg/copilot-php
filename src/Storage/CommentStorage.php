<?php

namespace App\Storage;

use App\Models\Comment;

class CommentStorage
{
    private $filePath;

    public function __construct(?string $filePath = null)
    {
        $this->filePath = $filePath ?? __DIR__ . '/../../data/comments.json';
        $this->ensureFileExists();
    }

    public function getAllComments(): array
    {
        $data = $this->readFile();
        $comments = [];
        
        foreach ($data as $commentData) {
            $comments[] = Comment::fromArray($commentData);
        }
        
        return $comments;
    }

    public function getCommentsByTaskId(string $taskId): array
    {
        $comments = $this->getAllComments();
        return array_filter($comments, function($comment) use ($taskId) {
            return $comment->getTaskId() === $taskId;
        });
    }

    public function getCommentById(string $id): ?Comment
    {
        $comments = $this->getAllComments();
        
        foreach ($comments as $comment) {
            if ($comment->getId() === $id) {
                return $comment;
            }
        }
        
        return null;
    }

    public function saveComment(Comment $comment): bool
    {
        $comments = $this->getAllComments();
        $found = false;
        
        // Update existing comment or add new one
        for ($i = 0; $i < count($comments); $i++) {
            if ($comments[$i]->getId() === $comment->getId()) {
                $comments[$i] = $comment;
                $found = true;
                break;
            }
        }
        
        if (!$found) {
            $comments[] = $comment;
        }
        
        return $this->saveComments($comments);
    }

    public function deleteComment(string $id): bool
    {
        $comments = $this->getAllComments();
        $comments = array_filter($comments, function($comment) use ($id) {
            return $comment->getId() !== $id;
        });
        
        return $this->saveComments(array_values($comments));
    }

    public function countCommentsByTaskId(string $taskId): int
    {
        $comments = $this->getCommentsByTaskId($taskId);
        return count($comments);
    }

    private function saveComments(array $comments): bool
    {
        $data = [];
        foreach ($comments as $comment) {
            $data[] = $comment->toArray();
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
            throw new \RuntimeException("Could not read comments file");
        }
        
        $data = json_decode($content, true);
        if (json_last_error() !== JSON_ERROR_NONE) {
            throw new \RuntimeException("Invalid JSON in comments file");
        }
        
        return $data ?: [];
    }

    private function writeFile(array $data): bool
    {
        $json = json_encode($data, JSON_PRETTY_PRINT);
        if ($json === false) {
            throw new \RuntimeException("Could not encode comments data to JSON");
        }
        
        $result = file_put_contents($this->filePath, $json);
        return $result !== false;
    }

    private function ensureFileExists(): void
    {
        if (!file_exists($this->filePath)) {
            $dir = dirname($this->filePath);
            if (!is_dir($dir)) {
                mkdir($dir, 0755, true);
            }
            file_put_contents($this->filePath, '[]');
        }
    }
}
