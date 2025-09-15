<?php

namespace App\Utils;

use App\Models\Task;

class Validator
{
    public function validateTask(string $title, string $status): array
    {
        $errors = [];
        
        // Validate title
        if (empty(trim($title))) {
            $errors['title'] = 'Task title is required';
        } elseif (strlen(trim($title)) < 3) {
            $errors['title'] = 'Task title must be at least 3 characters long';
        } elseif (strlen(trim($title)) > 255) {
            $errors['title'] = 'Task title must not exceed 255 characters';
        }
        
        // Validate status
        if (!in_array($status, Task::getAllowedStatuses())) {
            $errors['status'] = 'Invalid task status';
        }
        
        return $errors;
    }

    public function validateEmail(string $email): bool
    {
        return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
    }

    public function validateUrl(string $url): bool
    {
        return filter_var($url, FILTER_VALIDATE_URL) !== false;
    }

    public function validateRequired(array $fields, array $data): array
    {
        $errors = [];
        
        foreach ($fields as $field) {
            if (!isset($data[$field]) || empty(trim($data[$field]))) {
                $errors[$field] = ucfirst($field) . ' is required';
            }
        }
        
        return $errors;
    }

    public function validateLength(string $value, int $min, ?int $max = null): bool
    {
        $length = strlen(trim($value));
        
        if ($length < $min) {
            return false;
        }
        
        if ($max !== null && $length > $max) {
            return false;
        }
        
        return true;
    }

    public function sanitizeString(string $value): string
    {
        return htmlspecialchars(trim($value), ENT_QUOTES, 'UTF-8');
    }

    public function validateRequiredField(string $value, string $fieldName): void
    {
        if (empty(trim($value))) {
            throw new \InvalidArgumentException("{$fieldName} is required");
        }
    }
}
