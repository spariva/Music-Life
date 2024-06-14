<?php
require_once dirname(__DIR__) . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php';


Dotenv\Dotenv::createImmutable(dirname(__DIR__))->load();
if ($_ENV['TEST'] === false) {
    throw new Exception("Environment variables not loaded");
} else if ($_ENV['APP_ENV'] === 'local') {
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
} else {
    error_reporting(0);
    ini_set('display_errors', 0);
    ini_set('log_errors', 1);
}

session_start();

define('DOC_ROOT', dirname(__DIR__));

spl_autoload_register(function ($class) {
    $file = str_replace("\\", DIRECTORY_SEPARATOR, $class);
    $path = DOC_ROOT . DIRECTORY_SEPARATOR . "src" . DIRECTORY_SEPARATOR . "php" . DIRECTORY_SEPARATOR . $file . ".php";
    if (file_exists($path)) {
        require $path;
    } else {
        throw new Exception("Cannot load class: $class. File not found at $path");
    }
});