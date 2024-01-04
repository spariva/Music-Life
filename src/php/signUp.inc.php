<?php
include '../config/init.php';
include 'DbConnection.php';
include 'SignUpManager.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    $userName = $_POST["userName"]?? "";
    $userMail = $_POST["userMail"]?? "";
    $userPassword = $_POST["userPassword"]?? "";

    $registrator = new SignUpManager($userName, $userMail, $userPassword);

    //array errors registrator, o directamente métodos en registrator?
    if (empty($userName)) {
        echo "El nombre de userName es requerido.";
    } 

    if (empty($userMail)) {
        echo "El correo electrónico es requerido.";
    }
    //la userPassword debería ser encriptada?

    if (empty($userPassword) || strlen($userPassword) < 8) {
        echo "La contraseña es requerida y mayor a 8 carácteres.";
    }

    if ($registrator->validateSignUp()) {
        $registrator->saveUser();
        $_SESSION['user'] = $userName;
        $_SESSION['email'] = $userMail;
        header("Location: ../../public/usuario.php"); //cambiar el doc root a que sea public
        exit();
    }

    header("Location: ../../public/usuario.php"); //cambiar el doc root a que sea public
    exit();
}