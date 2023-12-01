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

<header id="header">
    <a class="textoCabecera" href="./index.php" id="logo">Music-Life</a>
    <nav class="navbar">
        <a class="textoCabecera" href="./login.php">Cuenta</a>
        <a class="textoCabecera" href="./usuario.php">Usuario</a>
        <a class="textoCabecera" href="./spotify.html">Spotify</a>
        <a class="textoCabecera" href="./contacto.php">Contacto</a>
        <a class="textoCabecera" href="https://github.com/spariva/Music-Life" target="blank">Info</a>
        <a class="textoCabecera" id="modo-oscuro">Modo Oscuro</a>
    </nav>
</header>

<body>
    <header id="header">
        <a class="textoCabecera" href="./index.html" id="logo">Music-Life</a>
        <nav class="navbar">
            <a class="textoCabecera" href="./login.html">Cuenta</a>
            <a class="textoCabecera" href="./usuario.php">Usuario</a>
            <a class="textoCabecera" href="./spotify.html">Spotify</a>
            <a class="textoCabecera" href="./contacto.html">Contacto</a>
            <a class="textoCabecera" href="https://github.com/spariva/Music-Life" target="blank">Info</a>
            <a class="textoCabecera" id="modo-oscuro">Modo Oscuro</a>
        </nav>
    </header>
    <div class="contenedor">
        <span class="contenedor__efectos"></span>
        <span class="contenedor__efectos"></span>
        <span class="contenedor__efectos"></span>
        <form id="inicioSesion" action="" method="GET">
            <h2 class="formulario__titulo">Iniciar sesión</h2>
            <div class="inputBox">
                <input type="text" placeholder="Usuario" value="<?= $userName ?>" required>
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
                <input type="text" placeholder="Nombre de usuario" name="name" value="<?= $userName ?>" method="POST" required>
            </div>
            <div class="inputBox">
                <input type="text" placeholder="Dirección de correo electrónico" value="<?= $userMail ?>" required>
            </div>
            <div class="inputBox">
                <!--! TODO: Si se equivoca repitiendo la contraseña se lo dejo, aunque esto debería ser con Js!-->
                <input type="password" placeholder="Crear contraseña" name="password" value="<?= isset($registrator->errors['repPwd']) ? $userPassword : '' ?>" required>
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

    <div class="video-container">
        <video autoplay loop muted class="video" id="videoFondo" src="./img/FondoIndexClaro.mp4">
            <!-- Quiero que al hacer click en el modo oscuro cambie este video tmbn -->
            Tu navegador no soporta el elemento de video mp4.
        </video>
        <div class="content">
            <!-- Contenido de tu página aquí -->
        </div>
    </div>
</body>

</html>