<?php
// require '../config/init.php';

// $comprobator = new LoginManager($_GET);

error_reporting(E_ALL);
ini_set('display_errors', 1);

// if(isset($_POST["enviar"]) && (empty($comprobator->errors))){ 
//     $mailer = MailerSingleton::obtenerInstancia();
//     $mailer->enviarCorreo($userMail, $motivo, $nombre, $mensajeExtra);
// }

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="https://developer.spotify.com/images/guidelines/design/icon3@2x.png" type="image/png">
    <title>Login - Music Life</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="./css/navbar.css">
    <link rel="stylesheet" href="./css/login.css">
    <script src="./js/login.js" defer></script>
    <script src="./js/script.js" defer></script>
</head>

<body>
    <video src="./img/FondoIndexClaro.mp4" id="videoFondo" autoplay="true" muted="true" loop="true"></video>
    <header id="header">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="d-flex align-items-center">
                <a class="textoCabecera" href="./index.php" id="logo">Music-Life</a>

                <!-- desplegable para pantallas pequeñas -->
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
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
    </header>

    <div id="ubicador">
    <div class="contenedor">
        <span class="contenedor__efectos"></span>
        <form id="inicioSesion" action="" method="GET">
            <h2 class="formulario__titulo">Iniciar sesión</h2>
            <div class="inputBox">
                <input type="text" placeholder="Usuario" value="" required>
            </div>
            <div class="inputBox">
                <!--No pongo el value, porque si se equivoca da sensación de inseguridad que se quede la contraseña. -->
                <input type="password" placeholder="Contraseña" required>
            </div>
            <div class="inputBox">
                <p>¿Primera vez aquí?</p><a href="#" id="crearCuenta">Crear cuenta</a>
            </div>
            <div class="inputBox">
                <input type="submit" class="botonConectarse" value="Conectarse" name="send">
            </div>
        </form>


        <form id="registro" action="" method="POST">
            <h2 class="formulario__titulo">Registro</h2>
            <div class="inputBox">
                <input type="text" placeholder="Nombre de usuario" name="name" value="" method="POST" required>
            </div>
            <div class="inputBox">
                <input type="text" placeholder="Dirección de correo electrónico" value="" required>
            </div>
            <div class="inputBox">
                <!--! TODO: Si se equivoca repitiendo la contraseña se lo dejo, aunque esto debería ser con Js!-->
                <input type="password" placeholder="Crear contraseña" name="password" value="" required>
            </div>
            <div class="inputBox">
                <input type="password" placeholder="Confirmar contraseña" required>
            </div>
            <div class="inputBox">
                <input type="submit" class="botonCrear" value="Crear Cuenta" name="send">
            </div>
            <div class="inputBox">
                <p>¿Ya tiene una cuenta?</p><a href="#" id="conectarCuenta">Conectarse</a>
            </div>
        </form>
    </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.10.2/umd/popper.min.js" defer></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" defer></script>
	<script src="./js/script.js"></script>
</body>

</html>