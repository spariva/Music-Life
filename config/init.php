<?php

define('DOC_ROOT', dirname(dirname(__FILE__)));

spl_autoload_register(function($class) {
    $file = str_replace("\\", DIRECTORY_SEPARATOR, $class);
    $path = DOC_ROOT . DIRECTORY_SEPARATOR . "src" . DIRECTORY_SEPARATOR . "php" . DIRECTORY_SEPARATOR . $file . ".php";
    if (file_exists($path)) {
        require $path;
    } else {
        throw new Exception("Cannot load class: $class. File not found at $path"");
    }
});

session_start();

?>

// Meter donde carguemos nuevos objetos si queremos se gestione la excepción en caso de no encontrat la clase.
// try {
//     $obj = new SomeClass();
// } catch (Exception $e) {
//     echo $e->getMessage();
// }
