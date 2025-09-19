<?php

namespace Tests\Unit\Models;

use App\Models\Task;
use PHPUnit\Framework\TestCase;

/**
 * Unit tests for the Task model
 * 
 * These tests verify the basic functionality of the Task class
 * including property management, status handling, and data validation.
 */
class TaskTest extends TestCase
{
    /**
     * Test task creation with default values
     */
    public function testTaskCreationWithDefaults(): void
    {
        $task = new Task();
        
        $this->assertIsString($task->getId());
        $this->assertNotEmpty($task->getId());
        $this->assertEquals('', $task->getTitle());
        $this->assertEquals(Task::STATUS_TODO, $task->getStatus());
        $this->assertInstanceOf(\DateTime::class, $task->getCreatedAt());
        $this->assertInstanceOf(\DateTime::class, $task->getUpdatedAt());
    }

    /**
     * Test task creation with custom values
     */
    public function testTaskCreationWithCustomValues(): void
    {
        $title = 'Test Task';
        $status = Task::STATUS_IN_PROGRESS;
        $id = 'custom-id-123';
        
        $task = new Task($title, $status, $id);
        
        $this->assertEquals($id, $task->getId());
        $this->assertEquals($title, $task->getTitle());
        $this->assertEquals($status, $task->getStatus());
    }

    /**
     * Test setting task title updates the updatedAt timestamp
     */
    public function testSetTitleUpdatesTimestamp(): void
    {
        $task = new Task();
        $originalUpdatedAt = $task->getUpdatedAt();
        
        // Sleep to ensure timestamp difference
        sleep(1);
        
        $newTitle = 'Updated Task Title';
        $task->setTitle($newTitle);
        
        $this->assertEquals($newTitle, $task->getTitle());
        $this->assertGreaterThan($originalUpdatedAt, $task->getUpdatedAt());
    }

    /**
     * Test task status constants
     */
    public function testTaskStatusConstants(): void
    {
        $this->assertEquals('To Do', Task::STATUS_TODO);
        $this->assertEquals('In Progress', Task::STATUS_IN_PROGRESS);
        $this->assertEquals('Done', Task::STATUS_DONE);
    }
}