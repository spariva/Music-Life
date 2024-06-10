<?php
require_once './../config/init.php';


$email = $_POST['mail'];
echo $email;
$new_psswd = $_POST['new_password'];
echo $new_psswd;

try {
    $db = DbConnection::getInstance();
    $conn = $db->getConnection();
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
        header("Location: login.php?mensaje=Contraseña Cambiada con exito :)");
        exit();  // Detiene la ejecución del script después de enviar el encabezado de redirección
    } else {
        echo "No se encontró el usuario o la contraseña no se cambió.";
        header("Location: login.php?mensaje=Hubo un problema cambiando tu contraseña");
        exit();
    }

} catch (PDOException $pe) {
    die("No se pudo conectar a la base de datos $dbname: " . $pe->getMessage());
} finally {
    $db->closeConnection();
}
