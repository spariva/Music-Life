<?php

require_once '../../config/init.php';
//Comentada esta linea porque utilizando el archivo composer.json y al introducir
//    el comando composer install instalara las librerias indicadas en el .json
//composer: require phpmailer/phpmailer;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class Mailer
{
    private static $mailer;
    private $mail;

    private function __construct()
    {
        $this->mail = new PHPMailer(true);

        // Configura las opciones de SMTP
        $this->mail->isSMTP();
        $this->mail->Host = 'smtp.*******.***'; //Nombre del SMTP
        $this->mail->SMTPAuth = true;
        $this->mail->Username = '******'; // Nombre de usuario del correo
        $this->mail->Password = '********'; // contraseña
        $this->mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $this->mail->Port = 587;
    }

    public static function obtenerInstancia()
    {
        if (self::$mailer === null) {
            self::$mailer = new self();
        }
        return self::$mailer;
    }

    public function enviarCorreo($userMail, $motivo, $nombre, $mensajeExtra)
    {
        try {
            $this->mail->setFrom($userMail);
            $this->mail->addAddress('support@music-life.es');
            $this->mail->Subject = 'Formulario Contacto';
            $this->mail->isHTML(true);
            $this->mail->CharSet = 'UTF-8';
            $this->mail->Body = "<!DOCTYPE html>
            <html lang='es'>
            <head>
                <meta charset='UTF-8'>
                <meta name='viewport' content='width=device-width, initial-scale=1.0'>
                <title>Formulario Contacto</title>
            </head>
            <body style='font-family: Arial, sans-serif;'>
                <div>
                    <h2 style='color: #333;'>Contacto:</h2>
                    <strong>Motivo de contacto:</strong> $motivo <br>
                    <strong>Nombre:</strong> $nombre<br>
                    <strong>Email:</strong> $userMail<br>
                    <strong>Mensaje extra:</strong> $mensajeExtra<br>
                </div>
            
            </body>
            </html>";
            return $this->mail->send();
        } catch (Exception $exception) {
            throw new PHPMailerException("Error al mandar el mail de formulario de contacto.");
            return false;
        }
    }
}
