<?php

namespace App\Models;

class Task
{
    private $id;
    private $title;
    private $status;
    private $createdAt;
    private $updatedAt;
    private $tags;
    private $commentCount;

    const STATUS_TODO = 'To Do';
    const STATUS_IN_PROGRESS = 'In Progress';
    const STATUS_DONE = 'Done';

    public function __construct($title = '', $status = self::STATUS_TODO, $id = null)
    {
        $this->id = $id ?? $this->generateId();
        $this->title = $title;
        $this->status = $status;
        $this->createdAt = new \DateTime();
        $this->updatedAt = new \DateTime();
        $this->tags = [];
        $this->commentCount = 0;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): void
    {
        $this->title = $title;
        $this->updatedAt = new \DateTime();
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    public function setStatus(string $status): void
    {
        if (!in_array($status, $this->getAllowedStatuses())) {
            throw new \InvalidArgumentException("Invalid status: $status");
        }
        $this->status = $status;
        $this->updatedAt = new \DateTime();
    }

    public function getCreatedAt(): \DateTime
    {
        return $this->createdAt;
    }

    public function getUpdatedAt(): \DateTime
    {
        return $this->updatedAt;
    }

    public function getTags(): array
    {
        return $this->tags;
    }

    public function setTags(array $tags): void
    {
        $this->tags = $tags;
        $this->updatedAt = new \DateTime();
    }

    public function addTag(string $tagId): void
    {
        if (!in_array($tagId, $this->tags)) {
            $this->tags[] = $tagId;
            $this->updatedAt = new \DateTime();
        }
    }

    public function removeTag(string $tagId): void
    {
        $this->tags = array_filter($this->tags, function($id) use ($tagId) {
            return $id !== $tagId;
        });
        $this->tags = array_values($this->tags); // Re-index array
        $this->updatedAt = new \DateTime();
    }

    public function getCommentCount(): int
    {
        return $this->commentCount;
    }

    public function setCommentCount(int $count): void
    {
        $this->commentCount = $count;
    }

    public static function getAllowedStatuses(): array
    {
        return [
            self::STATUS_TODO,
            self::STATUS_IN_PROGRESS,
            self::STATUS_DONE
        ];
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'status' => $this->status,
            'tags' => $this->tags,
            'comment_count' => $this->commentCount,
            'created_at' => $this->createdAt->format('Y-m-d H:i:s'),
            'updated_at' => $this->updatedAt->format('Y-m-d H:i:s')
        ];
    }

    public static function fromArray(array $data): self
    {
        $task = new self($data['title'], $data['status'], $data['id']);
        $task->createdAt = new \DateTime($data['created_at']);
        $task->updatedAt = new \DateTime($data['updated_at']);
        $task->tags = $data['tags'] ?? [];
        $task->commentCount = $data['comment_count'] ?? 0;
        return $task;
    }

    private function generateId(): string
    {
        return uniqid('task_', true);
    }
}
