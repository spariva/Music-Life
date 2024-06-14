<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require './../vendor/autoload.php';

$mail = new PHPMailer(true);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $motivo = $_POST["motivo"];
    $otroMotivoTexto = $_POST["otroMotivoTexto"];
    $nombre = $_POST["nombre"];
    $userMail = $_POST["userMail"];
    $mensajeExtra = $_POST["mensajeExtra"];

    $body = "<h3>Motivo de contacto:</h3>  <p>$motivo</p>";
    if ($motivo === 'otro') {
        $body .= "<p>Especificar:</p>";
        $body .= "<p>$otroMotivoTexto</p>";
    }
    $body .= "<h3>Nombre:</h3> <p>$nombre</p>";
    $body .= "<h3>Correo:</h3> <p> $userMail</p>";
    $body .= "<h3>Mensaje:</h3>";
    $body .= "<p>$mensajeExtra</p>";


    try {
        $mail->SMTPDebug = false;
        $mail->isSMTP();
        $mail->Host = 'smtp-relay.brevo.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'sergiosahi25@gmail.com';
        $mail->Password = 'CDLYQwFST8gPJa32';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        $mail->setFrom('music-life@support.es', 'Soporte Music Life');

        $mail->addAddress('sergiosahi25@gmail.com');
        $mail->addReplyTo('support@music-life.es', 'Reply');

        $mail->isHTML(true);
        $mail->Subject = 'Soporte M-L';
        $mail->Body = $body;
        $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

        $mail->send();
        header("Location: http://music-life.es/index.php?mensaje=Correo enviado, por favor revisa tu bandeja de entrada :)");
        exit();

    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}