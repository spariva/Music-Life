<?php
require_once '../config/init.php';

$username = $_SESSION['user'];
$perfil = $_GET['name'];


if (!isset($_SESSION['user'])) {
    $msg = "No hay usuario logueado";
    header("Location: ./login.php?msg=$msg");
    exit();
}
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
<video id="videoFondo" autoplay="true" muted="true" loop="true" disablePictureInPicture loading="eager" playsinline></video>
    <header id="header">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="d-flex align-items-center">
                <a class="textoCabecera" href="./index.php" id="logo">Music-Life</a>

                <!-- desplegable para pantallas pequeñas -->
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
            </div>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item"><a class="nav-link" href="./logout.php">Log out</a></li>
                    <li class="nav-item"><a class="nav-link" href="./usuario.php">Usuario</a></li>
                    <li class="nav-item"><a class="nav-link" href="./spotify.html">Spotify</a></li>
                    <li class="nav-item"><a class="nav-link" href="./contacto.php">Contacto</a></li>
                    <li class="nav-item"><a class="nav-link" href="https://github.com/spariva/Music-Life" target="_blank">Info</a></li>
                    <li class="nav-item"><a class="nav-link" id="modo-oscuro">Modo Oscuro</a></li>
                </ul>
            </div>
        </nav>
    </header>
    <div class="contenedor-principal-menuUsuario">

        <div class="usuario" id="menuUsuario__izquierda">
            <a href="./usuario.php">Volver a mi perfil</a>
            <br>
            <h2>Perfil de
                <?= $perfil; ?>
            </h2>
            <?php
            $pdo = DbConnection::getInstance();
            $isFriend = $pdo->checkIfFriend($username, $perfil);
            if ($isFriend) {
                echo '<div id="soisAmigos">Sois amigos :)</div>';
            } else {
                echo '<form action="./requestFriend.php" method="post">
                        <input type="hidden" name="search" value="' . $perfil . '">
                        <input type="hidden" name="username" value="' . $username . '">
                        <button id="botonSolicitarAmistad" type="submit">Solicitar Amistad</button>
                        </form>';
            }
            ?>
            <img src="./img/imagenPerfil.png" alt="usuario-imagen">
            <!-- <div id="correo">correoelectronico@email.com</div> -->

            <div class="amigos" style="max-height: 400px; overflow-y: auto;">
                <h2 style="text-align: center;">Amigos de <?= $perfil; ?></h2>
                <ul>
                    <?php
                    $pdo = DbConnection::getInstance();
                    $friends = $pdo->showUserFriends($perfil);
                    foreach ($friends as $friend) {
                        echo "<li><a href='perfil.php?name=" . $friend['FRIEND_NAME'] . "'>" . $friend['FRIEND_NAME'] . "</a></li>";
                    }
                    ?>
                </ul>
            </div>
        </div>

        <div class="listas">
            <div class="valoraciones">
                <h2>Valoraciones de <?= $perfil; ?></h2>
                <?php
                $username = $perfil;
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
                    echo 'Todavia no tiene valoraciones!';
                }
                ?>
            </div>
            <div class="musica">
                <h2>Valoraciones a sus Playlist</h2>
                <?php
                $pdo2 = DbConnection::getInstance();
                $ratings = $pdo2->showUserPlaylistRatings($perfil, 3);
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
                    echo 'Todavia nadie ha valorado sus playlist!';
                }
                ?>
            </div>
            <div class="playlists">
                <h2>Todas sus Playlists</h2>
                <?php
                $pdo3 = DbConnection::getInstance();
                $links = $pdo3->showUserPlaylistsRandom($perfil, 0);
                //$active = 'active';

                if ($links) {
                    echo '<div class="verPlaylists">';
                    foreach ($links as $link) {
                        //echo '<div class="bloquePV">';
                        echo '<iframe  class="bloquePV" style="border-radius:12px"
											src="' . $link . '?utm_source=generator"
											width="30%" height="152" frameBorder="0" allowfullscreen=""
											allow="autoplay; clipboard-write; encrypted-media; fullscreen; picture-in-picture"
											loading="lazy"></iframe>';
                        //$active = '';
                        //echo '</div>';
                    }
                    echo '</div>';

                } else {
                    echo 'Todavia no ha subido ninguna playlist!';
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