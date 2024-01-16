<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
//include '../config/init.php';
include './DbConnection.php';
include './SignUpManager.php';

session_start();
$mdb = DbConnection::getInstance();
$db = $mdb->getConnection();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {

    $userName = $_POST["userName"] ?? "";
    $userMail = $_POST["userMail"] ?? "";
    $userPassword = $_POST["userPassword"] ?? "";

    $registrator = new SignUpManager($userName, $userMail, $userPassword);
    $registrator->sanitizeSignUpManager();

    if ($registrator->validateSignUpManager($db)) {
        $registrator->saveUser($db);
        $_SESSION['user'] = $userName;
        $_SESSION['email'] = $userMail;
        header("Location: ../../public/usuario.php");
        die();
    } else {
        //se envían los errores del $registrator al login 
        $_SESSION['errorsSignUp'] = $registrator->errors;
//$dir = "http://" . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . "/main.php?success=$loginEmail";
// header("Location:$dir", true, 302);    
        header("Location: ../../public/login.php");
        die();
    }
} else {
    header("Location: ../../public/login.php?Hacker=bad");
    die();
}