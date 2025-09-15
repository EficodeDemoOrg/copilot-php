<?php

namespace App\Utils;

class Security
{
    /**
     * Sanitize user input to prevent XSS attacks
     */
    public static function sanitizeInput(string $input): string
    {
        return htmlspecialchars(trim($input), ENT_QUOTES, 'UTF-8');
    }

    /**
     * Escape output for safe HTML display
     */
    public static function escapeHtml(string $text): string
    {
        return htmlspecialchars($text, ENT_QUOTES, 'UTF-8');
    }

    /**
     * Generate a CSRF token
     */
    public static function generateCsrfToken(): string
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        
        $token = bin2hex(random_bytes(32));
        $_SESSION['csrf_token'] = $token;
        
        return $token;
    }

    /**
     * Verify CSRF token
     */
    public static function verifyCsrfToken(string $token): bool
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        
        return isset($_SESSION['csrf_token']) && 
               hash_equals($_SESSION['csrf_token'], $token);
    }

    /**
     * Validate that a string contains only safe characters
     */
    public static function validateSafeString(string $input): bool
    {
        // Allow letters, numbers, spaces, and basic punctuation
        return preg_match('/^[a-zA-Z0-9\s\.,!?\-_()]+$/', $input);
    }

    /**
     * Remove potentially dangerous HTML tags and attributes
     */
    public static function stripDangerousHtml(string $html): string
    {
        $allowedTags = '<p><br><strong><em><u><ul><ol><li>';
        return strip_tags($html, $allowedTags);
    }

    /**
     * Generate a secure random string
     */
    public static function generateRandomString(int $length = 32): string
    {
        return bin2hex(random_bytes($length / 2));
    }

    /**
     * Validate file upload security
     */
    public static function validateFileUpload(array $file, array $allowedTypes = []): array
    {
        $errors = [];
        
        if (!isset($file['error']) || $file['error'] !== UPLOAD_ERR_OK) {
            $errors[] = 'File upload failed';
            return $errors;
        }
        
        if (!empty($allowedTypes)) {
            $fileType = mime_content_type($file['tmp_name']);
            if (!in_array($fileType, $allowedTypes)) {
                $errors[] = 'File type not allowed';
            }
        }
        
        // Check file size (5MB max)
        if ($file['size'] > 5 * 1024 * 1024) {
            $errors[] = 'File size too large (max 5MB)';
        }
        
        return $errors;
    }

    /**
     * Rate limiting check (simple implementation)
     */
    public static function checkRateLimit(string $identifier, int $maxRequests = 60, int $timeWindow = 3600): bool
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        
        $key = "rate_limit_{$identifier}";
        $now = time();
        
        if (!isset($_SESSION[$key])) {
            $_SESSION[$key] = ['count' => 1, 'start' => $now];
            return true;
        }
        
        $data = $_SESSION[$key];
        
        // Reset if time window has passed
        if ($now - $data['start'] > $timeWindow) {
            $_SESSION[$key] = ['count' => 1, 'start' => $now];
            return true;
        }
        
        // Check if limit exceeded
        if ($data['count'] >= $maxRequests) {
            return false;
        }
        
        // Increment counter
        $_SESSION[$key]['count']++;
        return true;
    }
}
