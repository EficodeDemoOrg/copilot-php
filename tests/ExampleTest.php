<?php

namespace Tests;

use PHPUnit\Framework\TestCase;
use App\Controllers\TaskController;
use App\Controllers\CommentController;
use App\Controllers\TagController;
use App\Services\TaskService;
use App\Services\CommentService;
use App\Services\TagService;
use App\Models\Task;
use App\Models\Comment;
use App\Models\Tag;

class ApplicationStartupTest extends TestCase
{
    public function testApplicationCanStartup()
    {
        // Test that the application bootstrap works
        $this->assertTrue(class_exists('App\Controllers\TaskController'));
        $this->assertTrue(class_exists('App\Services\TaskService'));
        $this->assertTrue(class_exists('App\Models\Task'));
    }

    public function testControllersCanBeInstantiated()
    {
        // Test that core controllers can be created without errors
        $taskController = new TaskController();
        $commentController = new CommentController();
        $tagController = new TagController();
        
        $this->assertInstanceOf(TaskController::class, $taskController);
        $this->assertInstanceOf(CommentController::class, $commentController);
        $this->assertInstanceOf(TagController::class, $tagController);
    }

    public function testServicesCanBeInstantiated()
    {
        // Test that core services can be created without errors
        $taskService = new TaskService();
        $commentService = new CommentService();
        $tagService = new TagService();
        
        $this->assertInstanceOf(TaskService::class, $taskService);
        $this->assertInstanceOf(CommentService::class, $commentService);
        $this->assertInstanceOf(TagService::class, $tagService);
    }
}