<?php

// Test bootstrap file
require_once __DIR__ . '/../vendor/autoload.php';

// Load configuration
$config = require_once __DIR__ . '/../config/config.php';

// Set up test environment
$config['app']['env'] = 'testing';
$config['app']['debug'] = true;

// Set error reporting for tests
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Set default timezone
date_default_timezone_set('UTC');

// Don't start sessions in test environment
// Don't set up error handlers that might interfere with PHPUnit

// Create data directory if it doesn't exist (for testing)
$dataDir = __DIR__ . '/../data';
if (!is_dir($dataDir)) {
    mkdir($dataDir, 0755, true);
}

// Ensure test data files exist
$testFiles = [
    $dataDir . '/tasks.json' => '[]',
    $dataDir . '/comments.json' => '[]',
    $dataDir . '/tags.json' => '[]'
];

foreach ($testFiles as $file => $defaultContent) {
    if (!file_exists($file)) {
        file_put_contents($file, $defaultContent);
    }
}