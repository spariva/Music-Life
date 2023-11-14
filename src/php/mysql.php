<?php

$servernombre = "localhost";
$usernombre = "tu_usuario";
$password = "tu_contraseña";
$dbnombre = "inital_load.sql";

$db = new PDO($servernombre, $usernombre, $password, $dbnombre);

if ($db->connect_error) {
    die("Error en la conexión a la base de datos: " . $db->connect_error);
}


$nombre = $db->htmlspecialchars($_POST['nombre']);
$email = $db->htmlspecialchars($_POST['email']);
$contrasena = $db->htmlspecialchars($_POST['contrasena']);


$sql = "INSERT INTO USUARIO (NOMBRE, CONTRASENA, EMAIL) VALUES (?, ?, ?)";

$stmt = $db->prepare($sql);
$stmt->bind_param(":Insert", $nombre, $contrasena, $email);

if ($stmt->execute()) {
    echo "Datos insertados con éxito.";
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$db->close();

