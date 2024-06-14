<?php
require_once 'templates/header.php';

$username = $_SESSION['user'];
$perfil = $_GET['name'];


if (!isset($_SESSION['user'])) {
    $msg = "No hay usuario logueado";
    header("Location: ./login.php?mensaje=$msg");
    exit();
}
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
                    echo '<div class="playlistPerfil">';

                    echo '<iframe  class="bloquePV2" style="border-radius:12px"
											src="' . $link . '?utm_source=generator"
											width="100%" height="152" frameBorder="0" allowfullscreen=""
											allow="autoplay; clipboard-write; encrypted-media; fullscreen; picture-in-picture"
											loading="lazy"></iframe>';




                    if (isset($_SESSION['user'])) {
                        $username = $_SESSION['user'];
                    }
                    if (isset($_SESSION['user']) && !empty($_SESSION['user'])) {
                        $pdo2 = DbConnection::getInstance();
                        $rating = $pdo2->showUserRatings($username, $link);

                        if ($rating) {
                            echo '<div class="valoracionExistente">';
                            echo '<p>' . $rating['SCORE'] . '/5 ⭐</p>';
                            echo '</div>';
                        } else {
                            ?>

                            <!-- <div class="btnsValoracion">
                                <button class="btnEditarValoracion" aria-label="Editar playlist"><i class="bi bi-pencil-square"> Edit</i></button>
                                <button class="btnFavValoracion bi bi-arrow-through-heart" aria-label="Añadir a playlist favoritas"><i style="color:white"> Fav</i></button>
                        </div> -->

                            <div class="valoracionesBuscador">
                                <div class="contenedorSoporteParaValoraciones w-100">
                                    <div class="cuadrado botonDesplegable">Sin Valoración aún</div>
                                    <div class="ratingDropdown dropdown" style="display: none;">
                                        <form action="./subirValoracion.php" method="post">
                                            <div class="ratingBlock">
                                                <input type="hidden" name="username" value="<?php echo $username; ?>" required>
                                                <input type="hidden" name="url" value="<?php echo $link; ?>" required>
                                                <div class="star-rating">
                                                    <img class="star" data-rating="1" src="./img/star/EstrellaVacia.png"
                                                        alt="Estrella 1">
                                                    <img class="star" data-rating="2" src="./img/star/EstrellaVacia.png"
                                                        alt="Estrella 2">
                                                    <img class="star" data-rating="3" src="./img/star/EstrellaVacia.png"
                                                        alt="Estrella 3">
                                                    <img class="star" data-rating="4" src="./img/star/EstrellaVacia.png"
                                                        alt="Estrella 4">
                                                    <img class="star" data-rating="5" src="./img/star/EstrellaVacia.png"
                                                        alt="Estrella 5">
                                                </div>
                                                <p><textarea name="comment" class="comment"
                                                        placeholder="Escribe tu comentario aquí (opcional)"></textarea></p>
                                                <input type="hidden" name="rating" class="rating-value" required>
                                                <p><button type="submit" class="submit-button">Enviar</button></p>
                                                <p class="listaComentarios"></p>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <?php
                        }
                    } else {
                        echo '<div class="valoracionExistente">';
                        echo '<p>Debes estar logueado para valorar</p>';
                        echo '</div>';
                    }
                    echo '</div>';
                }

            } else {
                echo 'Todavia no ha subido ninguna playlist!';
            }
            echo '</div>';
            ?>

        </div>
    </div>
</div>
<link rel="stylesheet" href="./css/usuario.css">
<link rel="stylesheet" type="text/css" href="./css/star-rating.css">
<script src="./js/star-rating.js" defer></script>
<script src="./js/script.js" defer></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.10.2/umd/popper.min.js" defer></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" defer></script>
</body>


</html>