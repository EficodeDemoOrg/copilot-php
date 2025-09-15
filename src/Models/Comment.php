<?php

namespace App\Models;

class Comment
{
    private $id;
    private $taskId;
    private $content;
    private $author;
    private $createdAt;
    private $updatedAt;

    public function __construct(string $taskId, string $content, string $author, ?string $id = null)
    {
        $this->id = $id ?? $this->generateId();
        $this->taskId = $taskId;
        $this->content = $content;
        $this->author = $author;
        $this->createdAt = new \DateTime();
        $this->updatedAt = new \DateTime();
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getTaskId(): string
    {
        return $this->taskId;
    }

    public function getContent(): string
    {
        return $this->content;
    }

    public function setContent(string $content): void
    {
        $this->content = $content;
        $this->updatedAt = new \DateTime();
    }

    public function getAuthor(): string
    {
        return $this->author;
    }

    public function getCreatedAt(): \DateTime
    {
        return $this->createdAt;
    }

    public function getUpdatedAt(): \DateTime
    {
        return $this->updatedAt;
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'task_id' => $this->taskId,
            'content' => $this->content,
            'author' => $this->author,
            'created_at' => $this->createdAt->format('Y-m-d H:i:s'),
            'updated_at' => $this->updatedAt->format('Y-m-d H:i:s')
        ];
    }

    public static function fromArray(array $data): self
    {
        $comment = new self($data['task_id'], $data['content'], $data['author'], $data['id']);
        $comment->createdAt = new \DateTime($data['created_at']);
        $comment->updatedAt = new \DateTime($data['updated_at']);
        return $comment;
    }

    private function generateId(): string
    {
        return uniqid('comment_', true);
    }
}
