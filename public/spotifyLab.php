<?php
require_once 'templates/header.php';

// Set up the Spotify API client
if (isset($_SESSION['accessToken'])) {
    $api = new SpotifyWebAPI\SpotifyWebAPI();
    $accessToken = $_SESSION['accessToken'];
    $api->setAccessToken($accessToken);

    // Fetch user data
    $spotifyUserResponse = $api->me();
    $spotifyUser = [
        'id' => $spotifyUserResponse->id,
        'name' => $spotifyUserResponse->display_name,
        'email' => $spotifyUserResponse->email,
        'image' => $spotifyUserResponse->images[0]->url,
    ]; 
}
// } else {
//     // $mdb = DbConnection::getInstance();
//     // $accessToken = $mdb->getApiTokens();
// }

?>

<!-- <!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="icon" href="https://developer.spotify.com/images/guidelines/design/icon3@2x.png" type="image/png">
        <title>Spotify-Lab - Music Life</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="./css/navbar.css">
        <link rel="stylesheet" href="./css/usuario.css">
        <script src="./js/usuario.js" defer></script>
        <script src="./js/script.js" defer></script>
        <script src="./js/lab.js" defer></script>
</head>
<body>
        <video id="videoFondo" autoplay="true" muted="true" loop="true"
            disablePictureInPicture></video>
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
                        <li class="nav-item"><a class="nav-link" href="./spotifyLab.php">Spotify-Lab</a></li>
                        <li class="nav-item"><a class="nav-link" href="./logout.php">Log out</a></li>
                        <li class="nav-item"><a class="nav-link" href="./usuario.php">Usuario</a></li>
                        <li class="nav-item"><a class="nav-link" href="./spotify.html">Spotify</a></li>
                        <li class="nav-item"><a class="nav-link" href="./contacto.php">Contacto</a></li>
                        <li class="nav-item"><a class="nav-link" href="https://github.com/spariva/Music-Life"
                                target="_blank">Info</a></li>
                        <li class="nav-item"><a class="nav-link" id="modo-oscuro">Modo Oscuro</a></li>
                    </ul>
                </div>
            </nav>
        </header> -->

        <div class="contenedor-principal-lab">
            <div class="lab-panel" id="lab-menu-left">
                <!-- aqui las opciones del panel -->
                <form action="" class="lab-form">
                    <label for="limite-canciones">Limite de canciones: </label>
                    <input type="number" name="limite-canciones" id="limite-canciones" min="0"><br>
                    <label for="cod-artistas">Codigo de artista: </label>
                    <input type="text" name="cod-artistas" id="cod-artistas"><br>
                    <label for="generos">Generos musicales: </label>
                    <div id="cont-generos">
                        <input type="text" name="generos" id="generos" readonly><br>
                        <div class="cont-btn-generos">
                            <span class="genero-item">Classic</span>
                            <span class="genero-item">Jazz</span>
                            <span class="genero-item">Pop</span>
                            <span class="genero-item">Rock</span>
                            <span class="genero-item">Alternative</span>
                            <span class="genero-item">Indie</span>
                        </div>
                    </div>
                    <label for="canciones">Muestra de canciones (codigo): </label>
                    <input type="text" name="canciones" id="canciones"><br>
                    <label for="tempo">Ritmo de la cancion: </label>
                    <!-- hay que buscar cuales son los valores limite -->
                    <input type="range" name="tempo" id="tempo" min="0" max="200" step="1" value="0">
                    <span id="valorTempo">0</span>
                    instrumental
                </form>
            </div>

            <div class="lab-resultado">
                <!-- aqui el resultado de la busqueda -->


            </div>
        </div>
        <script src="./js/lab.js" defer></script>
</body>
</html>