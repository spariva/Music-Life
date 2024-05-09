<?php 
// Path: config/config.php
// File that check the environment production or development, and set the error reporting level accordingly.

// Si estamos en desarrollo, mostramos todos los errores. Si estamos en producción, los ocultamos pero los logueamos en el archivo de logs.
if (getenv('APP_ENV') === 'local') {
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
} else {
    error_reporting(0);
    ini_set('display_errors', 0);
    ini_set('log_errors', 1);
}