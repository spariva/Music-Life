<?php
require_once '../config/init.php';
// Destruir la variable 'user' de la sesión.
if (isset($_SESSION['user'])) {
    unset($_SESSION['user']);
}

// Destruir todas las variables de sesión.
session_destroy();
header("Location: ./index.php");
die();

