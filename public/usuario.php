<?php
require_once '../config/init.php';

$username = $_SESSION['user'];

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
    <video id="videoFondo" autoplay="true" muted="true" loop="true" disablePictureInPicture></video>
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
                    <p>Si la solicitud es aceptada, pasareis a ser amigxs :)</p>
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
</body>


</html>