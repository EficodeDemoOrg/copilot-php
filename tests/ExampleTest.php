<?php

namespace Tests;

use PHPUnit\Framework\TestCase;

/**
 * Basic example test demonstrating PHPUnit setup
 * 
 * This test verifies that the testing framework is properly configured
 * and provides a foundation for future test development.
 */
class ExampleTest extends TestCase
{
    /**
     * Test that basic PHPUnit functionality works
     */
    public function testBasicAssertion(): void
    {
        $this->assertTrue(true);
        $this->assertEquals(1, 1);
        $this->assertIsString('Hello World');
    }

    /**
     * Test that PHP version meets requirements
     */
    public function testPhpVersionRequirement(): void
    {
        $this->assertGreaterThanOrEqual('7.4.0', PHP_VERSION);
    }

    /**
     * Test that required PHP extensions are available
     */
    public function testRequiredExtensions(): void
    {
        $this->assertTrue(extension_loaded('json'), 'JSON extension is required');
        $this->assertTrue(extension_loaded('session'), 'Session extension is required');
    }
}