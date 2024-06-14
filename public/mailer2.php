<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
// Load Composer's autoloader
require './../vendor/autoload.php';

// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function


// Instantiation and passing `true` enables exceptions
$mail = new PHPMailer(true);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtiene el correo electrónico del formulario
    $email = $_POST["email"];
    $body = $_POST["body"];
    $subject = $_POST["subject"];
    $redireccion = $_POST["redireccion"];

    try {
        $mail->SMTPDebug = false; // or $mail->SMTPDebug = 0;
        $mail->isSMTP();     // Send using SMTP
        $mail->Host = 'smtp-relay.brevo.com'; // Set the SMTP server to send through
        $mail->SMTPAuth = true;   // Enable SMTP authentication
        $mail->Username = 'sergiosahi25@gmail.com';     // SMTP username
        $mail->Password = 'CDLYQwFST8gPJa32';  // SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;  // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
        $mail->Port = 587;   // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

        // From email address and name
        $mail->setFrom('music-life@support.es', 'Soporte Music Life');

        // To email addresss
        $mail->addAddress($email); // Agrega el destinatario obtenido del formulario
        $mail->addReplyTo('support@music-life.es', 'Reply'); // Recipent reply address
        //$mail->addCC('sergiosahi25@gmail.com');
        //$mail->addBCC('sergiosahi25@gmail.com');

        // Content
        $mail->isHTML(true);  // Set email format to HTML
        $mail->Subject = $subject;
        $mail->Body = $body;
        $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

        $mail->send();
        header("Location: http://music-life.es?mensaje=Correo enviado, por favor revisa tu bandeja de entrada :)");
        exit();
        //echo '<div style="text-align: center; font-size: 20px; font-weight: bold;"><p>Correo enviado, por favor revisa tu bandeja de entrada :) </p><p><a href="http://music-life.es">Volver a la web</a></p></div>';

    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}