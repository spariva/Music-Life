<?php
session_start(); 
include_once 'DbConnection.php';

$token = $_GET['token'];

try {
    $db = DbConnection::getInstance();
    $conn = $db->getConnection();

    $sql = 'SELECT USERID FROM TOKENS WHERE TIPO = "RECOVERY" AND EXPIRES > NOW() AND TOKEN = :TOKEN';
    $stmt = $conn->prepare($sql);

    $stmt->bindParam(':TOKEN', $token, PDO::PARAM_STR);

    $stmt->execute();

    // comprobar si funciono (mediante ver el mensaje que nos sale siempre en tyerminal etc)
    $rowCount = $stmt->rowCount();

    if ($rowCount > 0) {
        echo "token recibido con éxito.";

        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $mail = $result['USERID'];
        //header("Location: login.php?contrasenaCambiada=true");
        //exit();  // Detiene la ejecución del script después de enviar el encabezado de redirección
    } else {
        $mensaje = "El link ha expirado";
        header("Location: login.php?mensaje=$mensaje&error=true");
        exit();
    }

} catch (PDOException $pe) {
    die("No se pudo conectar a la base de datos $dbname: " . $pe->getMessage());
} finally {
    $conn = null; // Cerramoos
}?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cambiar Contraseña</title>
</head>
<body>
    <form action="cambiarPsswd2.php" method="post">
        <h3>Nueva contraseña</h3>
        <br><br>
        <p><input type="text" id="new_password" name="new_password" required></p>
        <input type="hidden" name="mail" value="<?php echo $mail; ?>">
        <button type="submit">Cambiar ahora</button>
    </form>
</body>
</html>
