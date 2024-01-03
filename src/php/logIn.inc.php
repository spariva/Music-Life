<?php
include '../config/init.php';
include './DbConnection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    $userName = $_POST["userName"]?? "";
    $userPassword = $_POST["userPassword"]?? "";

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

    // Hacemos uso del singleton para obtener una instancia de la base de datos
    $db = DbConnection::getInstance();

    $sql = "INSERT INTO usuarios (nombre, email, contrasena) VALUES (:userName, :userMail, :userPassword)";
    $stmt = $db->prepare($sql);
    
    $stmt->bindValue(':nombre', $userName, PDO::PARAM_STR);
    $stmt->bindValue(':email', $userMail, PDO::PARAM_STR);
    $stmt->bindValue(':nombre', $userPassword, PDO::PARAM_STR);

    $stmt->execute();

    $db->closeConnection();

    header("Location: ../../public/usuario.php"); //cambiar el doc root a que sea public
    exit();
}