<?php
require_once '../config/init.php';

if (!isset($_SESSION['user'])) {
    $msg = "Aún no has iniciado sesión";
    header("Location: ./login.php?msg=$msg");
    exit();
}

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

// // Fetch user data or perform actions as required
// 
// print_r($user);
?>


<!DOCTYPE html>
<html lang="es">


    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="icon" href="https://developer.spotify.com/images/guidelines/design/icon3@2x.png" type="image/png">
        <title>User - Music Life</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="./css/navbar.css">
        <link rel="stylesheet" href="./css/usuario.css">
        <script src="./js/usuario.js" defer></script>
        <script src="./js/script.js" defer></script>
    </head>


    <body>
        <video id="videoFondo" autoplay="true" muted="true" loop="true"
            disablePictureInPicture></video>
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
        </header>
        <div class="contenedor-principal-menuUsuario">
            <div class="usuario" id="menuUsuario__izquierda">
                <?php if (isset($spotifyUser)) : ?>
                    <img src="<?= $spotifyUser['image']; ?>" alt="usuario-imagen" class="user-pic-lg w-50 h-25">
                    <h3>
                        <?= $spotifyUser['name']; ?>
                    </h3>
                    <p>
                        <?= $spotifyUser['email']; ?>
                    </p>
                <?php else: ?>
                    <img src="./img/imagenPerfil.png" alt="usuario-imagen">
                    <!-- Botón link para conectar tu cuenta con Spotify: -->
                    <a href="./oauthSpotifyLibrary.php" class="btn btn-outline-success btn-lg rounded-pill" role="button">Conecta con Spoti</a>
                <?php endif; ?>
            </div>

            <div class="listas">
                <div class="valoraciones">
                    <h2>Mis valoraciones</h2>
								<?php
								$username = $_SESSION['user'];
								$pdo = DbConnection::getInstance();
								$ratings = $pdo->showUserRatingsRandom($username, 3);
								$active = 'active';

								if ($ratings) {
									foreach ($ratings as $rating) {
										echo '<div class="valoracion ' . $active . '">';
										echo '<iframe style="border-radius:12px"
											src="' . $rating['LINK'] . '?utm_source=generator"
											width="100%" height="152" frameBorder="0" allowfullscreen=""
											allow="autoplay; clipboard-write; encrypted-media; fullscreen; picture-in-picture"
											loading="lazy"></iframe>';
										echo '<div id="verValoracion" class="valoracionExistente">';
										echo '<p>' . $rating['SCORE'] . '/5</p>';
										echo '<p>' . $rating['TEXT'] . '</p>';
										echo '</div>';
										echo '</div>';
										$active = '';
									}
								} else {
									echo 'Todavia no tienes valoraciones, empieza ya!';
								}
								?>
                </div>
                <?php if (isset($spotifyUser)) : ?>
                    <div class="spotify">
                        <h2>Mis Playlist de Spotify</h2>
                        <div class="spotify-playlists">
                            <?php
                            $playlists = $api->getUserPlaylists($spotifyUser['id']);
                            $counter = 0;
                            $maxIterations = 6;
                            foreach ($playlists->items as $playlist) {
                                if ($counter == $maxIterations) {
                                    break;
                                }
                                echo '<div class="spotify-playlist">';
                                echo '<img src="' . $playlist->images[0]->url . '" alt="playlist-imagen">';
                                echo '<h3>' . $playlist->name . '</h3>';
                                echo '<p>' . $playlist->owner->followers . '</p>';
                                echo '<a href="' . $playlist->external_urls->spotify . '" target="_blank" class="btn btn-outline-info btn-lg rounded-pill" role="button">Escuchar</a>';
                                echo '</div><br>';
                                $counter++;
                            }
                            ?>
                        </div>
                    </div>
                <?php endif; ?>
                <div class="musica">
                <h2>Valoraciones a mis Playlist</h2>
								<?php
								$username = $_SESSION['user'];
								$pdo2 = DbConnection::getInstance();
								$ratings = $pdo2->showUserPlaylistRatings($username, 3);
								$active = 'active';

								if ($ratings) {
									foreach ($ratings as $rating) {
										echo '<div class="valoracion ' . $active . '">';
										echo '<iframe style="border-radius:12px"
											src="' . $rating['LINK'] . '?utm_source=generator"
											width="100%" height="152" frameBorder="0" allowfullscreen=""
											allow="autoplay; clipboard-write; encrypted-media; fullscreen; picture-in-picture"
											loading="lazy"></iframe>';
										echo '<div id="verValoracion" class="valoracionExistente">';
										echo '<p><b>' . $rating['USER_NAME'] . '</b> - ' . $rating['SCORE'] . '/5</p>';
										echo '<p>' . $rating['TEXT'] . '</p>';
										echo '</div>';
										echo '</div>';
										$active = '';
									}
								} else {
									echo 'Todavia nadie ha valorado tus playlist!';
								}
								?>
                </div>
            </div>
        </div>

        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.10.2/umd/popper.min.js" defer></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" defer></script>
    </body>


</html>