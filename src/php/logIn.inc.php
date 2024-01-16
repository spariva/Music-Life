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
    $userName = $_POST["userName"] ?? "";
    $userPassword = $_POST["userPassword"] ?? "";

    $registrator = new LoginManager($userName, $userPassword);
    $registrator->sanitizeLoginManager();

    if ($registrator->validateLoginManager($db)) {
        $_SESSION['user'] = $userName;
        header("Location: ../../public/usuario.php");
        die();
    } else {
        //se envían los errores del $registrator al login 
        $_SESSION['errorsLogin'] = $registrator->errors;
        //se envían los datos del formulario al login
        $_SESSION['userNameLogin'] = $userName;
        $_SESSION['userMailLogin'] = $userMail;
        header("Location: ../../public/login.php");
        die();
    }
} else {
    //Si intentan meterse en esta página sin pasar por el login, se les redirige al login y les dice que son unos hackers malos =D
    header("Location: ../../public/login.php?Hacker=bad");
    die();
}