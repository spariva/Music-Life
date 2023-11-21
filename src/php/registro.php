<?php
include('../config/init.php');

class LoginForm{

    //user exist ();
    //user is valid();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $userName = $_POST["userName"];
    $userMail = $_POST["userMail"];
    $userPassword = $_POST["userPassword"];


    if (empty($userName)) {
        echo "El nombre de userName es requerido.";
    } 

    if (empty($userMail)) {
        echo "El correo electrónico es requerido.";
    }
    //la userPassword debería ser encriptada?
    if (empty($userPassword)) {
        echo "La contraseña es requerida.";
    }

    // Hacemos uso del singleton para obtener una instancia de la base de datos
    $db = Db::getInstance();

    $sql = "INSERT INTO usuarios (nombre, email, conrasena) VALUES (:userName, :userMail, :userPassword)";
    $stmt = $db->prepare($sql);
    
    $stmt->bindValue(':nombre', $userName, PDO::PARAM_STR);
    $stmt->bindValue(':email', $userMail, PDO::PARAM_STR);
    $stmt->bindValue(':nombre', $userPassword, PDO::PARAM_STR);

    $stmt->execute();

    $db->closeConnection();

    header("Location: ../public/html/ususario.html");
    exit();
}