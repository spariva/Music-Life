<?php
require_once dirname(__DIR__) . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php';


Dotenv\Dotenv::createImmutable(dirname(__DIR__))->load();
// if ($_ENV['TEST'] === false) {
//     throw new Exception("Environment variables not loaded");
// }

session_start();

define('DOC_ROOT', dirname(__DIR__));

require DOC_ROOT . DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR . 'config.php';

spl_autoload_register(function ($class) {
    $file = str_replace("\\", DIRECTORY_SEPARATOR, $class);
    $path = DOC_ROOT . DIRECTORY_SEPARATOR . "src" . DIRECTORY_SEPARATOR . "php" . DIRECTORY_SEPARATOR . $file . ".php";
    if (file_exists($path)) {
        require $path;
    } else {
        throw new Exception("Cannot load class: $class. File not found at $path");
    }
});