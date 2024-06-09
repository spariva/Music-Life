<?php
// require_once '../config/init.php';
require_once 'templates/header.php';


//If there's a msg in the url, it's because the user tried to access the user page without logging in
if (isset($_GET['msg'])) {
    $msg = $_GET['msg'];
    unset($_GET['msg']);
}

$errorsLogin = $_SESSION['errorsLogin'] ?? [];
// es lo mismo que isset($_SESSION['errorsLogin']) ? $_SESSION['errorsLogin'] : [];
unset($_SESSION['errorsLogin']);

$errorsSignUp = $_SESSION['errorsSignUp'] ?? [];
unset($_SESSION['errorsSignUp']);

//Si hay errores en el SignUp para que se cargue el Registro en vez del Login
$bodyClass = $_SESSION['bodyClass'] ?? "";
unset($_SESSION['bodyClass']);
//Recupera los datos del formulario de registro
$userNameSignUp = $_SESSION['userNameSignUp'] ?? "";
$userMailSignUp = $_SESSION['userMailSignUp'] ?? "";
unset($_SESSION['userNameSignUp']);
unset($_SESSION['userMailSignUp']);

//Recupera los datos del formulario de crear cuenta
$userNameLogin = $_SESSION['userNameLogin'] ?? "";
unset($_SESSION['userNameLogin']);

// if(isset($_POST["enviar"]) && (empty($comprobator->errors))){ 
//     $mailer = Mailer::obtenerInstancia();
//     $mailer->enviarCorreo($userMail, $motivo, $nombre, $mensajeExtra);
// }

?>
    <?php if (isset($msg)) : ?>
        <div class="alert alert-danger w-25 text-center mx-auto d-block mt-5">
            <?php echo $msg;
            unset($msg);
            ?>
        </div>
    <?php endif; ?>

    <div id="ubicador">
        <div class="contenedor">
            <span class="contenedor__efectos"></span>
            <form id="inicioSesion" action="./logIn.inc.php" method="POST">
                <h2 class="formulario__titulo">Iniciar sesión</h2>
                <div class="inputBox">
                    <input type="text" placeholder="Usuario" value="<?= htmlspecialchars($userNameLogin) ?>" name="userName" required>
                </div>
                <div class="inputBox">
                    <input type="password" placeholder="Contraseña" name="userPassword" required>
                </div>
                <div class="inputBox">
                    <p>¿Primera vez aquí?</p><a href="#" id="crearCuenta">Crear cuenta</a>
                </div>
                <div>
                    <p style="text-align: center"><a href="#" id="forgotPasswordLink">¿Olvidaste la contraseña?</a></p>

                </div>

                <!--Login errors display-->
                
                <div class="inputBox">
                    <input type="submit" class="botonConectarse" value="Conectarse" name="submit">
                </div>
            </form>


            <form id="registro" action="./signUp.inc.php" method="POST">
                <h2 class="formulario__titulo">Registro</h2>
                <div class="inputBox">
                    <input type="text" placeholder="Nombre de usuario" name="userName" value="<?= htmlspecialchars($userNameSignUp) ?>" method="POST" required>
                </div>
                <div class="inputBox">
                    <input type="text" placeholder="Dirección de correo electrónico" name="userMail" value="<?= htmlspecialchars($userMailSignUp) ?>" required>
                </div>
                <div class="inputBox">
                    <input type="password" placeholder="Crear contraseña" name="userPassword" name="userPassword" value="" required>
                </div>
                <div class="inputBox">
                    <input type="password" placeholder="Confirmar contraseña" name="confirmPassword" required>
                </div>

                <div class="inputBox">
                    <input type="submit" class="botonCrear" value="Crear Cuenta" name="submit">
                </div>
                <div class="inputBox">
                    <p>¿Ya tiene una cuenta?</p><a href="#" id="conectarCuenta">Conectarse</a>
                </div>

            </form>


            <form id="recuperarPSWD" action="./recuperarPsswd.php" method="post">
                <h3 class="formulario__titulo">Recupera tu contraseña</h3>
                <div class="inputBox">
                    <p>Email</p><p><input type="email" id="email" name="email" required></p>

                </div>
                <div class="botonesPsswd">
                    <div class=" botonesRecuperar">
                        <button type="submit" id="enviarRecuperar">Solicitar cambio</button>
                        <!-- <button type="button" onclick="window.location.href='http://music-life.es/login.php'" id="closeModal">Cerrar</button> -->
                    </div>
                </div>
            </form>

        </div>
    </div>
    <?php if (count($errorsLogin) > 0) : ?>
        <div class="alert alert-danger">
            <?php foreach ($errorsLogin as $error) : ?>
                <li>
                    <?php echo $error; ?>
                </li>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

    <!--SignUp errors display-->
    <?php if (count($errorsSignUp) > 0) { ?>
        <div class="alert alert-danger">
            <?php foreach ($errorsSignUp as $error) : ?>
                <li>
                    <?php echo $error; ?>
                </li>
            <?php endforeach; ?>
        </div>
    <?php } ?>
    </div>
    <script src="./js/login.js"></script>
</body>

</html>