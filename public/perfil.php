<?php
require_once 'templates/header.php';
?>
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
                <h2>Playlists compartidas</h2>
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
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="./css/navbar.css">
    <link rel="stylesheet" href="./css/usuario.css">
    <script src="./js/usuario.js" defer></script>
    <script src="./js/star-rating.js" defer></script>
    <script src="./js/script.js" defer></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.10.2/umd/popper.min.js" defer></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" defer></script>
</body>


</html>