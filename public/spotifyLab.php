<?php
require_once 'templates/header.php';
if (isset($_SESSION['accessToken'])) {
    $options = [
        'auto_refresh' => true,
    ];
    $api = new SpotifyWebAPI\SpotifyWebAPI();
    $accessToken = $_SESSION['accessToken'];
    $api->setAccessToken($accessToken);

    try {
        setcookie('labsToken', $accessToken, time() + 3600, '/');
    } catch (Exception $e) {
        http_response_code(500);
        echo json_encode(['error' => 'Failed to retrieve access token', 'message' => $e->getMessage()]);
    }

    // Fetch user data
    $spotifyUserResponse = $api->me();
    $spotifyUser = [
        'id' => $spotifyUserResponse->id,
        'name' => $spotifyUserResponse->display_name,
        'email' => $spotifyUserResponse->email,
        'image' => $spotifyUserResponse->images[0]->url,
    ];
}

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
        <?php if (isset($spotifyUser)): ?>
            <img src="<?= $spotifyUser['image']; ?>" alt="usuario-imagen" style="width:120px; height:120px;">
            <h4 class="mb-4">
                <?= $spotifyUser['name']; ?>
            </h4>
        <?php else: ?>

            <!-- Botón link para conectar tu cuenta con Spotify: -->
            <a href="./oauthSpotifyLibrary.php" class="btn btn-outline-success btn-lg rounded-pill" role="button">Conecta
                con Spotify</a>
        <?php endif; ?>
        <!-- aqui las opciones del panel -->
        <form action="" class="lab-form" id="labForm">
            <label for="playlistName">Número de canciones: </label>
            <input type="text" id="playlistName" placeholder="Nombre de tu nueva playlist"><br>
            <label for="limite-canciones">Número de canciones: </label>
            <input type="number" name="limite-canciones" id="limite-canciones" min="10" max="100"
                placeholder="Canciones de tu nueva playlist [10-100]"><br>
            <label for="generos">Géneros musicales (5 max): </label>
            <div id="cont-generos">
                <input type="text" name="generos" id="generos" readonly><br>
                <div class="cont-btn-generos">
                    <span class="genero-item">Classical</span>
                    <span class="genero-item">Jazz</span>
                    <span class="genero-item">Pop</span>
                    <span class="genero-item">Rock</span>
                    <span class="genero-item">Techno</span>
                    <span class="genero-item">Indie</span>
                </div>
            </div>

            <label for="tempo">Ritmo (0 lento, 1 veloz): </label>
            <input type="range" name="tempo" id="tempo" min="0" max="1" step="0.05" value="0">
            <span id="valorTempo">0</span>
            <button><i class="bi bi-trash3-fill"> Resetear </i></button>
        </form>
    </div>

    <div class="lab-resultado-container">
        <!-- aqui el resultado de la busqueda -->
        <div class="lab-resultado">
            <div class="mis-playlists">
                <h3>Mis Playlist de Spotify</h3>
                <div class="spotify-playlists">
                    <?php
                    if (isset($api)) {
                        $playlists = $api->getUserPlaylists($spotifyUser['id']);
                        $counter = 0;
                        $maxIterations = 3;
                        foreach ($playlists->items as $playlist) {
                            if ($counter == $maxIterations) {
                                break;
                            }
                            echo '<div class="spotify-playlist gap-2 m-2" style="width:40%;">';
                            echo '<img src="' . $playlist->images[0]->url . '" alt="playlist-imagen" style="width:100%;">';
                            echo '<h5>' . $playlist->name . '</h5>';
                            echo '<a href="' . $playlist->external_urls->spotify . '" target="_blank" class="btn btn-outline-info btn-lg rounded-pill" role="button">Escuchar</a>';
                            echo '</div><br>';
                            $counter++;
                        }
                    }
                    ?>
                </div>
            </div>
            <!-- aqui el resultado de la busqueda -->
            <div class="lab-resultado-canciones">
                <?php if (isset($api)): ?>
                    <h3 id="btnEnviar" class="rounded-pill mt-2 mb-2">Crea tu playlist <i class="bi bi-music-note-beamed"></i></h3>
                <?php endif; ?>
                <div class="cancion">
                    <div id="playlistContainer"></div>
                </div>
                <div class="lab-intro">
                    <span id="getInfo">?</span>
                    <span id="info" class="ocultar">
                        <h2>Spotify-Lab: Recomendaciones</h2>
                        <p>Gracias a la potente API de Spotify, te ayudamos a generar recomendaciones de listas
                            personalizadas a tu gusto</p>
                    </span>

                </div>
                <div class="lab-resultado"></div>

            </div>
        </div>
        <script src="./js/lab.js" defer></script>
        <script src="./js/script.js" defer></script>

        </body>

        </html>