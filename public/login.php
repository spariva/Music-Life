<?php
require_once 'templates/header.php';

?>


<div id="ubicador">
    <div class="contenedor">
        <span class="contenedor__efectos"></span>
        <form id="inicioSesion" action="./logIn.inc.php" method="POST">
            <h2 class="formulario__titulo">Iniciar sesión</h2>
            <div class="inputBox">
                <input type="text" placeholder="Usuario" value="<?= htmlspecialchars($userNameLogin) ?>" name="userName"
                    required>
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
                <input type="text" placeholder="Nombre de usuario" name="userName"
                    value="<?= htmlspecialchars($userNameSignUp) ?>" method="POST" required>
            </div>
            <div class="inputBox">
                <input type="text" placeholder="Dirección de correo electrónico" name="userMail"
                    value="<?= htmlspecialchars($userMailSignUp) ?>" required>
            </div>
            <div class="inputBox">
                <input type="password" placeholder="Crear contraseña" name="userPassword" name="userPassword" value=""
                    required>
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
                <p>Email</p>
                <p><input type="email" id="email" name="email" required></p>

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
<?php if (count($errorsLogin) > 0): ?>
    <div class="alert alert-danger w-25 text-center mx-auto d-block mt-2">
        <?php foreach ($errorsLogin as $error): ?>
            <li>
                <?php echo $error; ?>
            </li>
        <?php endforeach; ?>
    </div>
<?php endif; ?>

<!--SignUp errors display-->
<?php if (count($errorsSignUp) > 0) { ?>
    <div class="alert alert-danger w-25 text-center mx-auto d-block mt-2">
        <?php foreach ($errorsSignUp as $error): ?>
            <li>
                <?php echo $error; ?>
            </li>
        <?php endforeach; ?>
    </div>
<?php } ?>
</div>
<script src="./js/login.js" defer></script>
</body>

</html>