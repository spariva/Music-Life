<?php
require_once '../config/init.php';


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
        header("Location: ./usuario.php");
        die();
    } else {
        //se envían los errores del $registrator al login 
        $_SESSION['errorsSignUp'] = $registrator->errors;
        //se envían los datos del formulario al login
        $_SESSION['userNameSignUp'] = $userName;
        $_SESSION['userMailSignUp'] = $userMail;
        //lo hago con session porque el js y el php se llevan mal *sad face* Podemos cambiar la cookie del modo oscuro sino, pero tendría que no borrar los errores del formulario.
        $_SESSION['bodyClass'] = 'crearCuenta';
        header("Location: ./login.php?errorSignUp=true");
        die();
    }
} else {
    //Si intentan meterse en esta página sin pasar por el login, se les redirige al login y les dice que son unos hackers malos =D
    header("Location: ./login.php?Hacker=bad");
    die();
}