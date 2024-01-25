<?php
session_start();
include_once 'DbConnection.php';

$CORREO = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);

$fechaActual = time();
$expires = strtotime('+1 day', $fechaActual);
$fechaExpiracion = date('Y-m-d', $expires);

$token = bin2hex(random_bytes(30));
$creacionToken = false;

try {
    $db = DbConnection::getInstance();
    $conn = $db->getConnection();

    $sql = 'SELECT * FROM USER WHERE EMAIL = :USERID';
    $stmt = $conn->prepare($sql);

    $stmt->bindParam(':USERID', $CORREO, PDO::PARAM_STR); //ESTO FALTA OBTENER DEL FORMULARIO EL CORREO
                            
    $stmt->execute();

    if ($stmt->rowCount() > 0) { //Comprobamos si ese usuario existe, si no pues no seguimos

        try {
            $sql = 'DELETE FROM TOKENS WHERE TIPO = "RECOVERY" AND USERID = :USERID';
            $stmt = $conn->prepare($sql);
        
            $stmt->bindParam(':USERID', $CORREO, PDO::PARAM_STR); //ESTO FALTA OBTENER DEL FORMULARIO EL CORREO
                                    
            $stmt->execute();
        
            $sql = "INSERT INTO TOKENS (TOKEN, USERID, EXPIRES,TIPO) VALUES(:TOKEN, :USERID, :EXPIRES, 'RECOVERY')";
            $stmt = $conn->prepare($sql);
        
            // Asignar valores a los parámetros
            $stmt->bindParam(':TOKEN', $token, PDO::PARAM_STR);
            $stmt->bindParam(':USERID', $CORREO, PDO::PARAM_STR);
            $stmt->bindParam(':EXPIRES', $fechaExpiracion, PDO::PARAM_STR);
        
            $stmt->execute();

            $creacionToken = true;
        
        } catch (PDOException $pe) {
            die("No se pudo generar el token de usuario: " . $pe->getMessage());
        } 
    
    } else {
        echo "No se encontraron resultados.";
    }

}catch (PDOException $pe) {
    die("No se pudo comprobar si el usuario existe: " . $pe->getMessage());
} finally {
    $db->closeConnection();
}

if ($creacionToken == true) {
    // Si todo ha ido bien, mandamos los datos al mailer
    $link = "Buenas, ya que ha psolicitado un cambio de contrasenna tendra disponible durante 1 dia este link para poder hacerlo \n <br> \n <br>";
    $link .= "http://recovery.es/public/code/cambiarPsswd.php?token=$token";
    $redirection = "index.php";

    // Crear un formulario dinámicamente con campos ocultos
    echo '<form id="formRedirect" action="mailer2.php" method="post">';
    echo '<input type="hidden" name="subject" value="Recuperar Contrasenna de Recovery.es">';
    echo '<input type="hidden" name="body" value="' . $link . '">';
    echo '<input type="hidden" name="redireccion" value="' . $redirection . '">';
    echo '<input type="hidden" name="email" value="' . $CORREO . '">';
    echo '</form>';
    
    // Agregar JavaScript para enviar el formulario automáticamente
    echo '<script>document.getElementById("formRedirect").submit();</script>';
    exit;
}