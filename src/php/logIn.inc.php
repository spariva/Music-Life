<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
//require '../config/init.php';
include './DbConnection.php';
include './LoginManager.php';

session_start();
$mdb = DbConnection::getInstance();
$db = $mdb->getConnection();


if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    $userName = $_POST["userName"]?? "";
    $userPassword = $_POST["userPassword"]?? "";

    $registrator = new LoginManager($userName, $userPassword);
    $registrator->sanitizeLoginManager();

    if ($registrator->validateLogin($db)) {
        $_SESSION['user'] = $userName;
        header("Location: ../../public/usuario.php");
        die();
    }
    else {
        //se envían los errores del $registrator al login 
        $_SESSION['errorsLogin'] = $registrator->errors;
        header("Location: ../../public/login.php");
        die();
    }
}