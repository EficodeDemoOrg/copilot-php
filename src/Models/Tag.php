<?php

namespace App\Models;

class Tag
{
    private $id;
    private $name;
    private $color;
    private $createdAt;

    public function __construct(string $name, string $color = '#007bff', ?string $id = null)
    {
        $this->id = $id ?? $this->generateId();
        $this->name = $name;
        $this->color = $color;
        $this->createdAt = new \DateTime();
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getColor(): string
    {
        return $this->color;
    }

    public function setColor(string $color): void
    {
        $this->color = $color;
    }

    public function getCreatedAt(): \DateTime
    {
        return $this->createdAt;
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'color' => $this->color,
            'created_at' => $this->createdAt->format('Y-m-d H:i:s')
        ];
    }

    public static function fromArray(array $data): self
    {
        $tag = new self($data['name'], $data['color'], $data['id']);
        $tag->createdAt = new \DateTime($data['created_at']);
        return $tag;
    }

    private function generateId(): string
    {
        return uniqid('tag_', true);
    }
}
