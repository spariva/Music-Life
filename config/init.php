<?php

define('DOC_ROOT', dirname(__DIR__));

spl_autoload_register(function($class) {
    $file = str_replace("\\", DIRECTORY_SEPARATOR, $class);
    $path = DOC_ROOT . DIRECTORY_SEPARATOR . "src" . DIRECTORY_SEPARATOR . "php" . DIRECTORY_SEPARATOR . $file . ".php";
    if (file_exists($path)) {
        require $path;
    } else {
        throw new Exception("Cannot load class: $class. File not found at $path");
    }
});

session_start();

// <?php

// define('DOC_ROOT', dirname(__DIR__) . DIRECTORY_SEPARATOR . 'public');

// spl_autoload_register(function($class) {
//     $file = str_replace("\\", DIRECTORY_SEPARATOR, $class);
//     $path = dirname(DOC_ROOT) . DIRECTORY_SEPARATOR . "src" . DIRECTORY_SEPARATOR . $file . ".php";
//     if (file_exists($path)) {
//         require $path;
//     } else {
//         throw new Exception("Cannot load class: $class. File not found at $path");
//     }
// });

// session_start();
