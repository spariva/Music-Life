<?php
require_once 'templates/header.php';

// Set up the Spotify API client
if (isset($_SESSION['accessToken'])) {
    $options = [
        'auto_refresh' => true,
    ];
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
} else {
    echo 'No se ha podido conectar con Spotify';
}

?>

<div class="contenedor-principal-lab">
    <div class="lab-panel" id="lab-menu-left">
        <?php if (isset($spotifyUser)): ?>
            <img src="<?= $spotifyUser['image']; ?>" alt="usuario-imagen" class="user-pic-lg w-50 h-25">
            <h3>
                <?= $spotifyUser['name']; ?>
            </h3>
            <p>
                <?= $spotifyUser['email']; ?>
            </p>
        <?php else: ?>

            <!-- Botón link para conectar tu cuenta con Spotify: -->
            <a href="./oauthSpotifyLibrary.php" class="btn btn-outline-success btn-lg rounded-pill" role="button">Conecta
                con Spoti</a>
        <?php endif; ?>
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
        <div class="mis-playlists">
            <h2>Mis Playlist de Spotify</h2>
            <div class="spotify-playlists">
                <?php 
                if (isset($api)){
                    $playlists = $api->getUserPlaylists($spotifyUser['id']);
                    foreach ($playlists->items as $playlist) {
                        echo '<a href="' . $playlist->external_urls->spotify . '">' . $playlist->name . '</a> <br>';
                    }
                    $counter = 0;
                    $maxIterations = 2;
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
                }
                ?>
            </div>
        </div>
        <!-- aqui el resultado de la busqueda -->
        <div class="lab-resultado-canciones">
            <h2>Canciones</h2>
            <div class="cancion">
                <iframe src="https://open.spotify.com/embed/track/6y0igZArWVi6Iz0rj35c1Y" width="300" height="380"
                    frameborder="0" allowtransparency="true" allow="encrypted-media"></iframe>
            </div>
            <div class="cancion">
                <iframe src="https://open.spotify.com/embed/track/6y0igZArWVi6Iz0rj35c1Y" width="300" height="380"
                    frameborder="0" allowtransparency="true" allow="encrypted-media"></iframe>
            </div>
        


    </div>
</div>
<script src="./js/lab.js" defer></script>
</body>

</html>