<?php

namespace App\Storage;

use App\Models\Tag;

class TagStorage
{
    private $filePath;

    public function __construct(?string $filePath = null)
    {
        $this->filePath = $filePath ?? __DIR__ . '/../../data/tags.json';
        $this->ensureFileExists();
    }

    public function getAllTags(): array
    {
        $data = $this->readFile();
        $tags = [];
        
        foreach ($data as $tagData) {
            $tags[] = Tag::fromArray($tagData);
        }
        
        return $tags;
    }

    public function getTagById(string $id): ?Tag
    {
        $tags = $this->getAllTags();
        
        foreach ($tags as $tag) {
            if ($tag->getId() === $id) {
                return $tag;
            }
        }
        
        return null;
    }

    public function getTagByName(string $name): ?Tag
    {
        $tags = $this->getAllTags();
        
        foreach ($tags as $tag) {
            if (strtolower($tag->getName()) === strtolower($name)) {
                return $tag;
            }
        }
        
        return null;
    }

    public function getTagsByIds(array $ids): array
    {
        $tags = $this->getAllTags();
        return array_filter($tags, function($tag) use ($ids) {
            return in_array($tag->getId(), $ids);
        });
    }

    public function saveTag(Tag $tag): bool
    {
        $tags = $this->getAllTags();
        $found = false;
        
        // Update existing tag or add new one
        for ($i = 0; $i < count($tags); $i++) {
            if ($tags[$i]->getId() === $tag->getId()) {
                $tags[$i] = $tag;
                $found = true;
                break;
            }
        }
        
        if (!$found) {
            $tags[] = $tag;
        }
        
        return $this->saveTags($tags);
    }

    public function deleteTag(string $id): bool
    {
        $tags = $this->getAllTags();
        $tags = array_filter($tags, function($tag) use ($id) {
            return $tag->getId() !== $id;
        });
        
        return $this->saveTags(array_values($tags));
    }

    private function saveTags(array $tags): bool
    {
        $data = [];
        foreach ($tags as $tag) {
            $data[] = $tag->toArray();
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
            throw new \RuntimeException("Could not read tags file");
        }
        
        $data = json_decode($content, true);
        if (json_last_error() !== JSON_ERROR_NONE) {
            throw new \RuntimeException("Invalid JSON in tags file");
        }
        
        return $data ?: [];
    }

    private function writeFile(array $data): bool
    {
        $json = json_encode($data, JSON_PRETTY_PRINT);
        if ($json === false) {
            throw new \RuntimeException("Could not encode tags data to JSON");
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
