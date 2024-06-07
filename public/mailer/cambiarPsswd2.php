<?php
session_start(); 

// Datos de conexión a la base de datos
$host = 'localhost';  // Cambia esto por tu host
$dbname = 'musicLifeDatabase';  // Cambia esto por tu nombre de base de datos
$username = 'musicLifeProd';  // Cambia esto por tu nombre de usuario
$password = 'musicLifeProd1234';  // Cambia esto por tu contraseña

$email = $_POST['mail'];
echo $email;
$new_psswd = $_POST['new_password'];
echo $new_psswd;

try {
    // Crear conexión
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    // Establecer el modo de error de PDO para excepciones
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "UPDATE user SET PASSWORD = :new_psswd WHERE EMAIL = :email";
    $stmt = $conn->prepare($sql);

    // Hashear la nueva contraseña
    $hashPsswd = password_hash($new_psswd, PASSWORD_DEFAULT);

    $stmt->bindParam(':new_psswd', $hashPsswd, PDO::PARAM_STR);
    $stmt->bindParam(':email', $email, PDO::PARAM_STR);

    $stmt->execute();

    // Comprobar si se actualizó alguna fila
    $rowCount = $stmt->rowCount();

    if ($rowCount > 0) {
        echo "Contraseña cambiada con éxito.";
        header("Location: login.php?contrasenaCambiada=true");
        exit();  // Detiene la ejecución del script después de enviar el encabezado de redirección
    } else {
        echo "No se encontró el usuario o la contraseña no se cambió.";
        header("Location: login.php?contrasenaCambiada=false");
        exit();
    }

} catch (PDOException $pe) {
    die("No se pudo conectar a la base de datos $dbname: " . $pe->getMessage());
} finally {
    // Cerrar la conexión
    $conn = null;
}
