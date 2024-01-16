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
        $_SESSION['mail'] = $userMail;
        header("Location: ../../public/usuario.php");
        die();
    } else {
        //se envían los errores del $registrator al login 
        $_SESSION['errorsSignUp'] = $registrator->errors;
        //se envían los datos del formulario al login
        $_SESSION['userNameSignUp'] = $userName;
        $_SESSION['userMailSignUp'] = $userMail;
        //lo hago con session porque el js y el php se llevan mal
        $_SESSION['bodyClass'] = 'crearCuenta';
        header("Location: ../../public/login.php?errorSignUp=true");
        die();
    }
} else {
    //Si intentan meterse en esta página sin pasar por el login, se les redirige al login y les dice que son unos hackers malos =D
    header("Location: ../../public/login.php?Hacker=bad");
    die();
}