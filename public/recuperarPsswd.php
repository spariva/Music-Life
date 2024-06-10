<?php
require_once './../config/init.php';

$CORREO = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);

$fechaActual = time();
$expires = strtotime('+1 day', $fechaActual);
$fechaExpiracion = date('Y-m-d', $expires);

$token = bin2hex(random_bytes(30));
$creacionToken = false;

try {
    $db = DbConnection::getInstance();
    $conn = $db->getConnection();

    $sql = 'SELECT * FROM user WHERE EMAIL = :USERID';
    $stmt = $conn->prepare($sql);

    $stmt->bindParam(':USERID', $CORREO, PDO::PARAM_STR); //ESTO FALTA OBTENER DEL FORMULARIO EL CORREO
                            
    $stmt->execute();

    if ($stmt->rowCount() > 0) { //Comprobamos si ese usuario existe, si no pues no seguimos

        try {
            $sql = 'DELETE FROM tokens WHERE TIPO = "RECOVERY" AND USERID = :USERID';
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':USERID', $CORREO, PDO::PARAM_STR); //ESTO FALTA OBTENER DEL FORMULARIO EL CORREO
            $stmt->execute();
        
            $sql = "INSERT INTO tokens (TOKEN, USERID, EXPIRES,TIPO) VALUES(:TOKEN, :USERID, :EXPIRES, 'RECOVERY')";
            $stmt = $conn->prepare($sql);
        
            $stmt->bindParam(':TOKEN', $token, PDO::PARAM_STR);
            $stmt->bindParam(':USERID', $CORREO, PDO::PARAM_STR);
            $stmt->bindParam(':EXPIRES', $fechaExpiracion, PDO::PARAM_STR);
        
            $stmt->execute();

            $creacionToken = true;
        
        } catch (PDOException $pe) {
            header ("Location: ./login.php?mensaje=No se pudo generar el token de usuario :(");
            exit();
        } 
    
    } else {
        header ("Location: ./login.php?mensaje=Mail no encontrado :(");
        exit();
    }

}catch (PDOException $pe) {
    header ("Location: ./login.php?mensaje=No encontramos al usuario :(");
    exit();
} finally {
    $db->closeConnection();
}

if ($creacionToken == true) {
    //echo "Se ha creado el token";
    // Si todo ha ido bien, mandamos los datos al mailer
    $link = "<div style='text-align: center; background-color: #57A8FF;color:white; padding: 40px; font-size: 17px;'>";

    $link .= "<h1>Soporte Music Life </h1> \n <br> Has solicitado un cambio de contrasena para music-life.es.<br><br> Tienes disponible durante 24 horas este link para poder hacerlo \n <br> \n <br>";
    $link .= "<a href='http://music-life.es/cambiarPsswd.php?token=$token' style='background-color: #95C8FF; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px; display: inline-block;'>Cambiar contrasena</a></div>";
    //CAMBIAR ESTO AL SUBITR A INTENET
    //$link .= "<a href='http://localhost:3000/src/php/cambiarPsswd.php?token=$token' style='background-color: #95C8FF; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px; display: inline-block;'>Cambiar contrasena</a></div>";
    //http://localhost:3000/src/php/recuperarPsswd.php
    $redirection = "index.php";

$redirection = "index.php";

    // Crear un formulario dinámicamente con campos ocultos
    echo '<form id="formRedirect" action="mailer2.php" method="post">';
    echo '<input type="hidden" name="subject" value="Cambiar Contrasena de music-life.es">';
    echo '<input type="hidden" name="body" value="' . $link . '">';
    echo '<input type="hidden" name="redireccion" value="' . $redirection . '">';
    echo '<input type="hidden" name="email" value="' . $CORREO . '">';
    echo '</form>';
    
    // Agregar JavaScript para enviar el formulario automáticamente
    echo '<script>document.getElementById("formRedirect").submit();</script>';
    exit;
}