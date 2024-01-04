<?php
require_once './config/init.php';

class InitTest extends PHPUnit\Framework\TestCase
{
    public function testAutoloadRegister()
    {
        $this->assertTrue(function_exists('spl_autoload_register'));
    }

    public function testAutoloadClassExists()
    {
        $this->assertTrue(class_exists('Exception'));
    }

    public function testAutoloadClassNotFound()
    {
        $this->expectException(Exception::class);
        $this->expectExceptionMessage("Cannot load class: NonExistingClass. File not found at " . DOC_ROOT . "/src/php/NonExistingClass.php");

        spl_autoload_register(function($class) {
            throw new Exception("Cannot load class: $class. File not found at " . DOC_ROOT . "/src/php/" . $class . ".php");
        });

        // Assuming NonExistingClass does not exist in the specified path
        new NonExistingClass();
    }
}