<?php
// Conexión a la base de datos (asegúrate de reemplazar los valores según tu configuración)
$servername = "tu_servidor";
$username = "tu_usuario";
$password = "tu_contraseña";
$dbname = "tu_base_de_datos";

$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Obtener el ID del usuario (puedes obtenerlo de tu sistema de autenticación)
$usuario_id = 1; // Reemplaza con el ID del usuario actual

// Consulta SQL para obtener las valoraciones de las playlists del usuario
$sql = "SELECT v.PUNTUACION, v.COMENTARIO, v.FECHA, p.NOMBRE AS NOMBRE_PLAYLIST
        FROM VALORACION v
        JOIN PLAYLIST p ON v.PLAYLIST_ID = p.ID_PL
        WHERE p.CREADOR_ID = $usuario_id";

$result = $conn->query($sql);

// Inicializar un array para almacenar las valoraciones
$valoraciones = array();

// Verificar si hay resultados
if ($result->num_rows > 0) {
    // Almacenar los resultados en el array
    while ($row = $result->fetch_assoc()) {
        $valoracion = array(
            'playlist' => $row["NOMBRE_PLAYLIST"],
            'puntuacion' => $row["PUNTUACION"],
            'comentario' => $row["COMENTARIO"],
            'fecha' => $row["FECHA"]
        );
        $valoraciones[] = $valoracion;
    }
} else {
    echo "<p>Este usuario no tiene valoraciones de playlists.</p>";
}

// Cerrar la conexión
$conn->close();
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="https://developer.spotify.com/images/guidelines/design/icon3@2x.png" type="image/png">
    <title>NOMBRE_USUARIO - Music Life</title>
    <link rel="stylesheet" href="./css/usuario.css">
    <link rel="stylesheet" href="./css/style.css">
    <script src="./js/usuario.js" defer></script>
    <script src="./js/script.js" defer></script>
</head>

<body>
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
    <div class="contenedor-principal-menuUsuario">

        <div class="usuario" id="menuUsuario__izquierda">
            <h2>Usuario</h2><br><br><br><br><br>
            <img src="./img/imagenPerfil.png" alt="usuario-imagen">
            <div id="correo">correoelectronico@email.com</div>
            <div class="iframes__favoritos">
                <iframe class="menuUsuario__izquierda__iframe" src="https://open.spotify.com/embed/playlist/0XJs446xvZpKhz3pglrOlX?utm_source=generator" frameborder="0" allowtransparency="true" allow="encrypted-media"></iframe>
                <iframe class="menuUsuario__izquierda__iframe" src="https://open.spotify.com/embed/playlist/20IwQZIfrykXjnyd4SLHtX?utm_source=generator" frameborder="0" allowtransparency="true" allow="encrypted-media"></iframe>
            </div>
        </div>

        <div class="listas">
            <div class="valoraciones">
                <h2>VALORACIONES</h2>
                <div class="valoracion" id="val1">
                    <p><?php echo $valoraciones[0] ?></p>
                </div>
                <div class="valoracion" id="val2">
                    <p><?php echo $valoraciones[1] ?></p>
                    <div class="valoracion" id="val3">
                        <p><?php echo $valoraciones[2] ?></p>
                    </div>

                    <div class="musica">
                        <iframe style="border-radius:12px" src="https://open.spotify.com/embed/playlist/37i9dQZF1DZ06evO4lAAFJ?utm_source=generator" width="100%" height="352" frameBorder="0" allowfullscreen="" allow="autoplay; clipboard-write; encrypted-media; fullscreen; picture-in-picture" loading="lazy"></iframe>
                        <iframe style="border-radius:12px" src="https://open.spotify.com/embed/playlist/37i9dQZF1DZ06evO1QmCJj?utm_source=generator" width="100%" height="352" frameBorder="0" allowfullscreen="" allow="autoplay; clipboard-write; encrypted-media; fullscreen; picture-in-picture" loading="lazy"></iframe>
                    </div>

                </div>
            </div>

            <div class="video-container">
                <!-- Cambios realizados explicados en la página de index-->
                <video autoplay loop muted class="video" id="videoFondo" src="./img/FondoSpotifyClaro.mp4">
                    <!-- Quiero que al hacer click en el modo oscuro cambie este video tmbn -->
                    Tu navegador no soporta el elemento de video mp4.
                </video>
            </div>
</body>

</html>