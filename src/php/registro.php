<?php
include('../config/init.php');
class Registro{

}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario = $_POST["nombre_usuario"];
    $email = $_POST["email"];
    $contrasena = $_POST["contrasena"];


    if (empty($usuario)) {
        echo "El nombre de usuario es requerido.";
    } 

    if (empty($email)) {
        echo "El correo electrónico es requerido.";
    }
    //la contrasena debería ser encriptada?
    if (empty($contrasena)) {
        echo "La contraseña es requerida.";
    }

    // Hacemos uso del singleton para obtener una instancia de la base de datos
    $db = Db::getInstance();

    $sql = "INSERT INTO usuarios (nombre, email, contrasena) VALUES (?, ?, ?)";
    $stmt = $db->prepare($sql);
    $stmt->execute([$usuario, $email, $contrasena]);

    $db->cerrarConexion();

    header("Location: ../public/html/usuario.html");
    exit();
}