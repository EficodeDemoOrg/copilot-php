<?php

return [
    'app' => [
        'name' => 'Simple Task Manager',
        'version' => '1.0.0',
        'debug' => true,
    ],
    
    'storage' => [
        'driver' => 'json',
        'path' => __DIR__ . '/../data/tasks.json',
    ],
    
    'logging' => [
        'enabled' => true,
        'path' => __DIR__ . '/../logs/app.log',
        'level' => 'info',
    ],
    
    'security' => [
        'csrf_protection' => true,
        'xss_protection' => true,
    ],
];
