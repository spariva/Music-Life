<?php
require_once '../../config/init.php';
// Destruir la variable 'user' de la sesión.
if (isset($_SESSION['user'])) {
    unset($_SESSION['user']);
}

// Destruir todas las variables de sesión.
session_destroy();
// header("Location: ". DOC_ROOT ."public/index.php"); esta no funciona =(
header("Location: ../../public/index.php");
die();

