<?php
// require_once '../config/init.php';
require_once 'templates/header.php';

//Si le has dado a enviar y no hay errores:
if (isset($_POST["enviar"]) && (empty($errores))) {
    $mailer = Mailer::obtenerInstancia();
    $mailer->enviarCorreo($userMail, $motivo, $nombre, $mensajeExtra);
}


?>


<div id="contenido">
    <div class="content" id="formContacto">
        <h2 class="textoContacto">Formulario de Contacto</h2><br>

        <form class="textoContacto" action="mailer3.php" method="POST">
            <label for="motivo">Motivo de Contacto:</label>
            <select class="casilla " id="motivo" name="motivo" required>
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
            <input class="casilla formOscuro" type="text" id="nombre" name="nombre" value="<?= $nombre ?>"
                placeholder="escribe tu nombre" required><br>
            <?php if (isset($errores['nombre'])) { ?>
                <span class="error">
                    <?= $errores['nombre'] ?>
                </span>
            <?php } ?>


            <label for="userMail">Correo Electrónico:</label>
            <input class="casilla formOscuro" type="email" id="email" name="userMail" value="<?= $userMail ?>"
                placeholder="tuCorreo@correo.com" required><br>
            <?php if (isset($errores['nombre'])) { ?>
                <span class="error">
                    <?= $errores['nombre'] ?>
                </span>
            <?php } ?>

            <!-- <label for="mensaje">Mensaje:</label>
                <textarea id="mensaje" name="mensajeExtra" rows="4" cols="50" required></textarea><br><br> -->
            <label for="mensaje-contacto">Mensaje:</label>
            <textarea class="formOscuro" id="mensaje-contacto" name="mensajeExtra" rows="4" cols="50"
                required></textarea><br><br>

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
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.10.2/umd/popper.min.js" defer></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" defer></script>
<script src="./js/script.js"></script>
<script src="./js/procesarInputs.js" defer></script>
</body>

</html>