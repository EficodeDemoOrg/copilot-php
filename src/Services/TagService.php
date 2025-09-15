<?php

namespace App\Services;

use App\Models\Tag;
use App\Storage\TagStorage;
use App\Storage\JsonStorage;
use App\Utils\Validator;

class TagService
{
    private $tagStorage;
    private $taskStorage;
    private $validator;

    public function __construct()
    {
        $this->tagStorage = new TagStorage();
        $this->taskStorage = new JsonStorage();
        $this->validator = new Validator();
    }

    public function createTag(string $name, string $color = '#007bff'): Tag
    {
        // Validate tag data
        $this->validator->validateRequiredField($name, 'Tag name');
        
        $name = trim($name);
        if (strlen($name) < 1) {
            throw new \InvalidArgumentException("Tag name cannot be empty");
        }

        // Check if tag already exists
        $existingTag = $this->tagStorage->getTagByName($name);
        if ($existingTag) {
            throw new \InvalidArgumentException("Tag with this name already exists");
        }

        // Validate color format (simple hex color validation)
        if (!preg_match('/^#[0-9A-Fa-f]{6}$/', $color)) {
            $color = '#007bff'; // Default color if invalid
        }

        $tag = new Tag($name, $color);
        
        if (!$this->tagStorage->saveTag($tag)) {
            throw new \RuntimeException("Failed to save tag");
        }

        return $tag;
    }

    public function getAllTags(): array
    {
        return $this->tagStorage->getAllTags();
    }

    public function getTagById(string $id): ?Tag
    {
        return $this->tagStorage->getTagById($id);
    }

    public function getTagsByIds(array $ids): array
    {
        return $this->tagStorage->getTagsByIds($ids);
    }

    public function updateTag(string $id, string $name, string $color): bool
    {
        $tag = $this->tagStorage->getTagById($id);
        if (!$tag) {
            throw new \InvalidArgumentException("Tag not found");
        }

        // Validate new data
        $this->validator->validateRequiredField($name, 'Tag name');
        
        $name = trim($name);
        if (strlen($name) < 1) {
            throw new \InvalidArgumentException("Tag name cannot be empty");
        }

        // Check if another tag with this name exists
        $existingTag = $this->tagStorage->getTagByName($name);
        if ($existingTag && $existingTag->getId() !== $id) {
            throw new \InvalidArgumentException("Another tag with this name already exists");
        }

        // Validate color format
        if (!preg_match('/^#[0-9A-Fa-f]{6}$/', $color)) {
            throw new \InvalidArgumentException("Invalid color format. Use hex format like #007bff");
        }

        $tag->setName($name);
        $tag->setColor($color);
        
        return $this->tagStorage->saveTag($tag);
    }

    public function deleteTag(string $id): bool
    {
        $tag = $this->tagStorage->getTagById($id);
        if (!$tag) {
            throw new \InvalidArgumentException("Tag not found");
        }

        // Remove tag from all tasks
        $this->removeTagFromAllTasks($id);
        
        return $this->tagStorage->deleteTag($id);
    }

    public function assignTagToTask(string $taskId, string $tagId): bool
    {
        $task = $this->taskStorage->getTaskById($taskId);
        if (!$task) {
            throw new \InvalidArgumentException("Task not found");
        }

        $tag = $this->tagStorage->getTagById($tagId);
        if (!$tag) {
            throw new \InvalidArgumentException("Tag not found");
        }

        $task->addTag($tagId);
        return $this->taskStorage->saveTask($task);
    }

    public function removeTagFromTask(string $taskId, string $tagId): bool
    {
        $task = $this->taskStorage->getTaskById($taskId);
        if (!$task) {
            throw new \InvalidArgumentException("Task not found");
        }

        $task->removeTag($tagId);
        return $this->taskStorage->saveTask($task);
    }

    public function getTasksByTagId(string $tagId): array
    {
        $allTasks = $this->taskStorage->getAllTasks();
        return array_filter($allTasks, function($task) use ($tagId) {
            return in_array($tagId, $task->getTags());
        });
    }

    private function removeTagFromAllTasks(string $tagId): void
    {
        $allTasks = $this->taskStorage->getAllTasks();
        foreach ($allTasks as $task) {
            if (in_array($tagId, $task->getTags())) {
                $task->removeTag($tagId);
                $this->taskStorage->saveTask($task);
            }
        }
    }
}
