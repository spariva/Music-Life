<?php
// require_once '../config/init.php';
require_once 'templates/header.php';

$username = $_SESSION['user'];

if (!isset($_SESSION['user'])) {
    $msg = "Aún no has iniciado sesión";
    header("Location: ./login.php?msg=$msg");
    exit();
}

?>

 <div class="contenedor-principal-menuUsuario">
        <div class="usuario" id="menuUsuario__izquierda">
            <h2>
                <?= $_SESSION['user']; ?>
            </h2>
            <img src="./img/imagenPerfil.png" alt="usuario-imagen">
            <!-- <div id="correo">correoelectronico@email.com</div> -->
            <div class="amigos" style="max-height: 300px; overflow-y: auto;">
                <h3 style="text-align: center;">Mis Amigos</h3>
                <ul>
                    <?php
                    $pdo = DbConnection::getInstance();
                    $friends = $pdo->showUserFriends($_SESSION['user']);
                    foreach ($friends as $friend) {
                        echo "<li><a href='perfil.php?name=" . $friend['FRIEND_NAME'] . "'>" . $friend['FRIEND_NAME'] . "</a></li>";
                    }
                    ?>
                </ul>
            </div>

            <div class="buscarAmigos">
                <div id="tituloBuscarAmigos">
                    <h3>Buscar amigos</h3>
                    <img id="infoLogo" src="./img/info.png" alt="Información">
                </div>
                <div id="infoDesplegable">
                    <p>Introduce el nombre de usuario de la persona que quieras para enviarle una solicitud de amistad</p>
                    <p>Si la solicitud es aceptada, pasaréis a ser amigues :)</p>
                </div>

                <script>
                    document.getElementById('infoLogo').addEventListener('click', function() {
                        var infoDesplegable = document.getElementById('infoDesplegable');
                        if (infoDesplegable.style.display === 'none') {
                            infoDesplegable.style.display = 'block';
                        } else {
                            infoDesplegable.style.display = 'none';
                        }
                    });
                </script>

                <form id="formBuscar" method="post" action="./requestFriend.php">
                    <input type="hidden" name="username" value="<?php echo $username; ?>" required>
                    <input type="text" id="buscadorUsuarios" name="search" placeholder="Buscar usuario">
                    <input type="submit" id="btnSubmit" name="submit" value="Solicitar">
                </form><br>
            </div>

            <div class="solicitudes" style="max-height: 300px; overflow-y: auto;">
                <h3 style="text-align: center;">Mis Solicitudes</h3>
                <ul>
                    <?php
                    $pdo = DbConnection::getInstance();
                    $requests = $pdo->showUserFriendRequest($_SESSION['user']);
                    if ($requests) {
                        foreach ($requests as $request) {
                            echo "<li><a href='perfil.php?name=" . $request['REQUEST_USER'] . "'>" . $request['REQUEST_USER'] . "</a></li>"; ?>
                            <form method="post" action="./acceptFriend.php">
                                <input type="hidden" name="username" value="<?php echo $username; ?>" required>
                                <input type="hidden" name="friend" value="<?php echo $request['REQUEST_USER']; ?>" required>
                                <input type="submit" name="aceptar" value="Aceptar">
                                <input type="submit" name="rechazar" value="Rechazar">
                            </form>

                    <?php }
                    } else {
                        echo "No tienes solicitudes de amistad";
                    } ?>
                </ul>

            </div>
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
                      ?>
                                    <div class="valoracion">
                                        <form action="./editarValoracion.php" method="post">
                                            <div class="<?= $active ?> ">
                                                <iframe src="<?= $rating['LINK'] ?>?utm_source=generator" frameborder="0" allowfullscreen=""
                                                width="100%" height="152" frameBorder="0" allowfullscreen=""
                                                allow="autoplay; clipboard-write; encrypted-media; fullscreen; picture-in-picture"
                                                loading="lazy"></iframe>
                                                <div class="valoracionExistente verValoracion">
                                                    <p><?= $rating['SCORE'] ?> /5</p>
                                                    <p><?= $rating['TEXT'] ?></p>    
                                                </div>
                                                <div class="ratingBlock ocultar">
                                                    <div class="cerrar">X</div>
                                                    <div class="editarValoracionCont">
                                                        <div class="star-rating">
                                                            <img class="star" data-rating="1" src="./img/star/EstrellaVacia.png" alt="Estrella 1">
                                                            <img class="star" data-rating="2" src="./img/star/EstrellaVacia.png" alt="Estrella 2">
                                                            <img class="star" data-rating="3" src="./img/star/EstrellaVacia.png" alt="Estrella 3">
                                                            <img class="star" data-rating="4" src="./img/star/EstrellaVacia.png" alt="Estrella 4">
                                                            <img class="star" data-rating="5" src="./img/star/EstrellaVacia.png" alt="Estrella 5">
                                                        </div>
                                                        <input type="hidden" name="url" value="<?= $rating['LINK'] ?>">
                                                        <p><textarea name="nuevaValoracion" class="comment" placeholder="Escribe tu comentario aquí (opcional)"></textarea></p>
                                                        <input type="hidden" name="nuevoRating" class="rating-value">
                                                        <p><button type="submit" class="submit-button">Editar</button></p>
                                                    </div>
                                                </div>
                                                
                                            </div>
                                        </form>
                                        <div class="btnsValoracion">
                                            <button class="btnEditarValoracion"><i class="bi bi-pencil-square"></i></button>
                                            <button class="btnEliminarValoracion"><i class="bi bi-trash3-fill"></i></button>
                                        </div>
                                    </div>
<!-- //                         echo '<div class="valoracion ' . $active . '">';
//                         echo '<iframe style="border-radius:12px"
// 											src="' . $rating['LINK'] . '?utm_source=generator"
// 											width="100%" height="152" frameBorder="0" allowfullscreen=""
// 											allow="autoplay; clipboard-write; encrypted-media; fullscreen; picture-in-picture"
// 											loading="lazy"></iframe>';
//                         echo '<div id="verValoracion" class="valoracionExistente">';
//                         echo '<p>' . $rating['SCORE'] . '/5</p>';
//                         echo '<p>' . $rating['TEXT'] . '</p>';
//                         echo '</div>';
//                         echo '</div>';
//                         $active = ''; -->
                  
                               
              <?php
                }} else {
                    echo 'Todavia no tienes valoraciones, empieza ya!';
                }
                ?>
            </div>

            <div class="musica">
                <h2>Valoraciones a mis Playlists</h2>
                <?php
                //$username = $_SESSION['user'];
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

            <div class="playlists">
                <h2>Todas mis Playlists</h2>
                <?php
                $username = $_SESSION['user'];
                $pdo3 = DbConnection::getInstance();
                $links = $pdo3->showUserPlaylistsRandom($username, 0);
                //$active = 'active';

                if ($links) {
                    echo '<div class="verPlaylists">';
                    foreach ($links as $link) {
                        //echo '<div class="bloquePV">';
                        echo '<iframe  class="bloquePV" style="border-radius:12px"
											src="' . $link . '?utm_source=generator"
											 height="152" frameBorder="0" allowfullscreen=""
											allow="autoplay; clipboard-write; encrypted-media; fullscreen; picture-in-picture"
											loading="lazy"></iframe>';
                        //$active = '';
                        //echo '</div>';
                    }
                    echo '</div>';

                } else {
                    echo 'Todavia no has subido ninguna playlist!';
                }
                ?>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.10.2/umd/popper.min.js" defer></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" defer></script>
    <script src="./js/editarValoraciones.js" defer></script>
    <script src="./js/procesarInputs.js" defer></script>
</body>

</html>