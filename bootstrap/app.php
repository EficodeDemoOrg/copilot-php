<?php

// Application bootstrap file
require_once __DIR__ . '/../vendor/autoload.php';

// Load configuration
$config = require_once __DIR__ . '/../config/config.php';

// Start session
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Set error reporting based on debug mode
if ($config['app']['debug']) {
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
} else {
    error_reporting(0);
    ini_set('display_errors', 0);
}

// Set default timezone
date_default_timezone_set('UTC');

// Set up error handling
set_error_handler(function($severity, $message, $file, $line) {
    if (!(error_reporting() & $severity)) {
        return;
    }
    
    $error = [
        'severity' => $severity,
        'message' => $message,
        'file' => $file,
        'line' => $line,
        'timestamp' => date('Y-m-d H:i:s')
    ];
    
    error_log(json_encode($error));
    
    // In debug mode, show the error
    global $config;
    if ($config['app']['debug']) {
        echo "<div style='background: #fee; border: 1px solid #fcc; padding: 10px; margin: 10px;'>";
        echo "<strong>Error:</strong> {$message} in {$file} on line {$line}";
        echo "</div>";
    }
});

// Set up exception handling
set_exception_handler(function($exception) {
    $error = [
        'type' => 'exception',
        'message' => $exception->getMessage(),
        'file' => $exception->getFile(),
        'line' => $exception->getLine(),
        'trace' => $exception->getTraceAsString(),
        'timestamp' => date('Y-m-d H:i:s')
    ];
    
    error_log(json_encode($error));
    
    // In debug mode, show the exception
    global $config;
    if ($config['app']['debug']) {
        echo "<div style='background: #fee; border: 1px solid #fcc; padding: 10px; margin: 10px;'>";
        echo "<h3>Uncaught Exception</h3>";
        echo "<p><strong>Message:</strong> " . htmlspecialchars($exception->getMessage()) . "</p>";
        echo "<p><strong>File:</strong> " . htmlspecialchars($exception->getFile()) . "</p>";
        echo "<p><strong>Line:</strong> " . $exception->getLine() . "</p>";
        echo "<p><strong>Trace:</strong></p>";
        echo "<pre>" . htmlspecialchars($exception->getTraceAsString()) . "</pre>";
        echo "</div>";
    } else {
        include __DIR__ . '/../views/error.php';
    }
});

// Create logs directory if it doesn't exist
$logsDir = __DIR__ . '/../logs';
if (!is_dir($logsDir)) {
    mkdir($logsDir, 0755, true);
}

// Create data directory if it doesn't exist
$dataDir = __DIR__ . '/../data';
if (!is_dir($dataDir)) {
    mkdir($dataDir, 0755, true);
}
