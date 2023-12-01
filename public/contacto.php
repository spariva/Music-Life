<?php 

require '../config/init.php';
require '../vendor/autoload.php'; // Carga las dependencias de PHPMailer, pero tengo duda de qué autoload usar.
//Errores, validate data, sanitize data ¿?
// if the user submited the form
// if there are form errors
//     fill errors array
// else
//     record data to database
//     302 regirect, as it required by HTTP standard
//     exit
// if we have some errors
// display errors
// fill form field values
// display the form

//Si le has dado a enviar y no hay errores:
if(isset($_POST["enviar"]) && (empty($errores))){ 
        $mailer = MailerSingleton::obtenerInstancia();
        $mailer->enviarCorreo($userMail, $motivo, $nombre, $mensajeExtra);
}


?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="https://developer.spotify.com/images/guidelines/design/icon3@2x.png" type="image/png">
    <title>Music-Life</title>
    <link rel="stylesheet" type="text/css" href="./css/contacto.css">
    <script src="./js/script.js" defer></script>
</head>

<body>
    <header id="header">
        <a class="textoCabecera" href="index.html" id="logo">Music-Life</a>
        <nav class="navbar">
            <a class="textoCabecera" href="login.html">Cuenta</a>
            <a class="textoCabecera" href="spotify.html">Spotify</a>
            <a class="textoCabecera" href="contacto.html">Contacto</a>
            <a class="textoCabecera" href="https://github.com/spariva/Music-Life" target="blank">Info</a>
            <a class="textoCabecera" id="modo-oscuro">Modo Oscuro</a>
        </nav>
    </header>
    <div class="video-container">
        <!-- Añadido atributo src al video. La etiqueta source es para tener otras opciones.
             Aparte este es el elemento enlazado con la variable en el script -->
        <video autoplay loop muted class="video" id="videoFondo" src="./img/FondoIndexClaro.mp4">
            <!-- Quiero que al hacer click en el modo oscuro cambie este video tmbn -->
            Tu navegador no soporta el elemento de video mp4.
        </video>
        <div class="content" id="formContacto">
            <h2 class="textoContacto">Formulario de Contacto</h2><br>

            <form class="textoContacto" action="" method="POST">
                <label for="motivo">Motivo de Contacto:</label>
                <select id="motivo" name="motivo" required>
                    <option value="" disabled selected>Selecciona un motivo</option>
                    <option value="sugerencia">Sugerencia</option>
                    <option value="fallo_pagina">Fallo en la página</option>
                    <option value="fallo_spotify">Fallo al conectar con Spotify</option>
                    <option value="consulta">Consulta</option>
                    <option value="otro">Otro</option>
                </select>
                <br><br>

                <div id="otroMotivo" style="display: none;">
                    <label for="otroMotivoTexto">Por favor, especifica:</label>
                    <input type="text" id="otroMotivoTexto" name="otroMotivoTexto">
                </div>
                <br><br>

                <label for="nombre">Nombre:</label>
                <input type="text" id="nombre" name="nombre" value= "<?= $nombre ?>" placeholder="Nombre" required><br>
                <?php if (isset($errores['nombre'])) { ?>
                    <span class="error">
                        <?= $errores['nombre'] ?>
                    </span>
                <?php } ?>
                <br><br>

                <label for="userMail">Correo Electrónico:</label>
                <input type="email" id="email" name="userMail" value= "<?= $userMail ?>" required><br>
                <?php if (isset($errores['nombre'])) { ?>
                    <span class="error">
                        <?= $errores['nombre'] ?>
                    </span>
                <?php } ?>
                <br><br>


                <label for="mensaje">Mensaje:</label><br><br>
                <textarea id="mensaje" name="mensajeExtra" rows="4" cols="50" required></textarea><br><br>

                <button type="submit">Enviar</button>
            </form>

            <script>
                const motivoSelect = document.getElementById('motivo');
                const otroMotivoDiv = document.getElementById('otroMotivo');

                motivoSelect.addEventListener('change', function () {
                    if (motivoSelect.value === 'otro') {
                        otroMotivoDiv.style.display = 'block';
                    } else {
                        otroMotivoDiv.style.display = 'none';
                    }
                });
            </script>

        </div>
    </div>
</body>

</html>