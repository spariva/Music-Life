<?php
// require_once '../config/init.php';
require_once 'templates/header.php';

//Si le has dado a enviar y no hay errores:
if (isset($_POST["enviar"]) && (empty($errores))) {
    $mailer = Mailer::obtenerInstancia();
    $mailer->enviarCorreo($userMail, $motivo, $nombre, $mensajeExtra);
}


?>

<!-- <!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="https://developer.spotify.com/images/guidelines/design/icon3@2x.png" type="image/png">
    <title>Music-Life</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="./css/navbar.css">
    <link rel="stylesheet" type="text/css" href="./css/contacto.css">
    <script src="./js/script.js" defer></script>
</head>

<body>
<video id="videoFondo" autoplay="true" muted="true" loop="true" disablePictureInPicture></video>
    <header id="header">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="d-flex align-items-center">
                <a class="textoCabecera" href="./index.php" id="logo">Music-Life</a> -->

                <!-- desplegable para pantallas pequeñas -->
                <!-- <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
            </div>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item"><a class="nav-link" href="./login.php">Cuenta</a></li>
                    <li class="nav-item"><a class="nav-link" href="./usuario.php">Usuario</a></li>
                    <li class="nav-item"><a class="nav-link" href="./spotify.html">Spotify</a></li>
                    <li class="nav-item"><a class="nav-link" href="./contacto.php">Contacto</a></li>
                    <li class="nav-item"><a class="nav-link" href="https://github.com/spariva/Music-Life" target="_blank">Info</a></li>
                    <li class="nav-item"><a class="nav-link" id="modo-oscuro">Modo Oscuro</a></li>
                </ul>
            </div>
        </nav>
    </header> -->
    <div id="contenido">
        <div class="content" id="formContacto">
            <h2 class="textoContacto">Formulario de Contacto</h2><br>

            <form class="textoContacto" action="" method="POST">
                <label for="motivo">Motivo de Contacto:</label>
                <select class="casilla" id="motivo" name="motivo" required>
                    <option value="" disabled selected>Selecciona un motivo</option>
                    <option value="sugerencia">Sugerencia</option>
                    <option value="fallo_pagina">Fallo en la página</option>
                    <option value="fallo_spotify">Fallo al conectar con Spotify</option>
                    <option value="consulta">Consulta</option>
                    <option value="otro">Otro</option>
                </select>
                <br>

                <div id="otroMotivo" style="display: none;">
                    <label for="otroMotivoTexto">Por favor, especifica:</label><br>
                    <input class="casilla" type="text" id="otroMotivoTexto" name="otroMotivoTexto"><br><br>
                </div>

                <label for="nombre">Nombre:</label>
                <input class="casilla" type="text" id="nombre" name="nombre" value="<?= $nombre ?>" placeholder="Nombre" required><br>
                <?php if (isset($errores['nombre'])) { ?>
                    <span class="error">
                        <?= $errores['nombre'] ?>
                    </span>
                <?php } ?>


                <label for="userMail">Correo Electrónico:</label>
                <input class="casilla" type="email" id="email" name="userMail" value="<?= $userMail ?>" required><br>
                <?php if (isset($errores['nombre'])) { ?>
                    <span class="error">
                        <?= $errores['nombre'] ?>
                    </span>
                <?php } ?>
                
                <!-- <label for="mensaje">Mensaje:</label>
                <textarea id="mensaje" name="mensajeExtra" rows="4" cols="50" required></textarea><br><br> -->
                <label for="mensaje-contacto">Mensaje:</label>
                <textarea id="mensaje-contacto" name="mensajeExtra" rows="4" cols="50" required></textarea><br><br>

                <button type="submit">Enviar</button>
            </form>

            <script>
                const motivoSelect = document.getElementById('motivo');
                const otroMotivoDiv = document.getElementById('otroMotivo');

                motivoSelect.addEventListener('change', function() {
                    if (motivoSelect.value === 'otro') {
                        otroMotivoDiv.style.display = 'block';
                    } else {
                        otroMotivoDiv.style.display = 'none';
                    }
                });
            </script>

        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.10.2/umd/popper.min.js" defer></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" defer></script>
	<script src="./js/script.js"></script>
</body>

</html>