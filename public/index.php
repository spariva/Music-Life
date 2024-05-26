<?php
require_once '../config/init.php';

//Gestion de la ventana flotante con el aviso sobre las cookies
$mostrarWarning = true;
if (isset($_COOKIE['aceptadas']) && $_COOKIE['aceptadas'] == true) {
	$mostrarWarning = false;
	setcookie('aceptadas', true, time() + (60 * 60 * 24 * 7), "/");
} else {
	if (isset($_GET['aceptadas']) && ($_GET['aceptadas']) == true) {
		$mostrarWarning = false;
		setcookie('aceptadas', true, time() + (60 * 60 * 24 * 7), "/");
	} else {
		setcookie('aceptadas', false);
		$mostrarWarning = true;
		echo '<style>#contenido, #header { filter: blur(5px); }</style>';
	}
}
?>
<!-- 
    //Creamos una instancia a la conexión con la database.
    $db = Db::getInstance();

    // Consulta SELECT
    $sql = "SELECT * FROM PLAYLIST";
    $result = $db->prepare($sql);

    if ($result->rowCount() > 0) {
        foreach ($result as $data) {
            echo "Columna1: " . $data['columna1'] . " - Columna2: " . $data['columna2'] . " - Columna3: " . $data['columna3'] . "<br>";
        }
    } else {
        echo "No se encontraron resultados";
    } -->
<!DOCTYPE html>
<html lang="es">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="icon" href="https://developer.spotify.com/images/guidelines/design/icon3@2x.png" type="image/png">
	<title>Music-Life</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="./css/navbar.css">
	<link rel="stylesheet" type="text/css" href="./css/nuevocss.css">
	<link rel="stylesheet" type="text/css" href="./css/star-rating.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<body>
	<!-- <script>
		function buscarPlaylist() {
			// Solicitar al usuario que ingrese un nombre para la playlist
			var nombrePlaylist = prompt("Por favor, ingrese un nombre para la playlist:");

			// Verificar si el usuario ingresó un nombre
			if (nombrePlaylist !== null && nombrePlaylist !== "") {
				// Obtener la URL del iframe
				var iframeCode = document.querySelector('.iframeBuscador').outerHTML;
				var pattern = /src="(.*?)"/;
				var matches = iframeCode.match(pattern);

				if (matches && matches.length > 1) {
					var enlacePlaylist = matches[1];

					// Enviar la información al servidor (usando AJAX con jQuery)
					$.ajax({
						type: "POST",
						url: "guardar_playlist.php",
						data: {
							id_pl: matches, // Agrega el valor correcto para id_pl (puede ser vacío por ahora)
							playlistName: nombrePlaylist,
							creator: < ?php echo $_SESSION['user']; ?> // Asumiendo que 'id_usuario' es la clave correcta para el ID del usuario
						},
						success: function(response) {
							alert(response); // Muestra la respuesta del servidor (puedes personalizar el mensaje)
						}
					});
				} else {
					alert("No se pudo encontrar la URL del iframe.");
				}
			} else {
				alert("Debe ingresar un nombre para la playlist.");

			}
		}
	</script> -->
	<video id="videoFondo" autoplay="true" muted="true" loop="true" disablePictureInPicture loading="eager"></video>

	<header id="header">
	<a class="textoCabecera" href="./index.php" id="logo2">Music-Life</a>

		<nav id='navbar' class="navbar ">

			<a class="textoCabecera" href="./index.php" id="logo">Music-Life</a>
			<!-- desplegable para pantallas pequeñas 
				<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				</button>-->

			<a id="homeIcon" class="nav-link" href="./index.php"><i class="fas fa-home"></i><span class="nav-text"> Home</span></a>
			<a class="nav-link" href="./usuario.php"><i class="fas fa-user"></i><span class="nav-text"> Usuario</span></a>
			<a class="nav-link" href="./spotify.html"><i class="fab fa-spotify"></i><span class="nav-text"> Spotify</span></a>
			<a class="nav-link" href="./contacto.php"><i class="fas fa-envelope"></i><span class="nav-text"> Contacto</span></a>
			<a class="nav-link" href="https://github.com/spariva/Music-Life" target="_blank"><i class="fas fa-info-circle"></i><span class="nav-text"> Info</span></a>
			<a class="nav-link" id="modo-oscuro"><i id="logo-modo-oscuro" class="fa-solid"></i><span class="nav-text">Modo Oscuro</span></a>
		</nav>
	</header>




	<div id="contenido">

		<div id="mensaje">
			<?php
			if (isset($_GET['mensaje'])) {
				echo $_GET['mensaje'];
			}
			?></div>
		<script>
			setTimeout(function() {
				document.getElementById('mensaje').style.display = 'none';
			}, 3000);
		</script>
		<div class="contenedor" id="recomendado">
			<div id="apartado">Recomendados</div>
			<?php

			$pdo = DbConnection::getInstance();
			// $urls = $pdo->showAllPlaylists();
			$urls = $pdo->showAllPlaylistsRandom(4);
			// Generar los iframes con las URLs seleccionadas
			foreach ($urls as $url) {
				echo '<iframe style="border-radius:12px"
						src="' . $url . '?utm_source=generator"
						width="100%" height="152" frameBorder="0" allowfullscreen=""
						allow="autoplay; clipboard-write; encrypted-media; fullscreen; picture-in-picture"
						loading="lazy"></iframe>';

				$username = $_SESSION['user'];
				if (isset($_SESSION['user']) && !empty($_SESSION['user'])) {
					$pdo2 = DbConnection::getInstance();
					$rating = $pdo2->showUserRatings($username, $url);

					if ($rating) {
						echo '<div class="valoracionExistente">';
						echo '<p>' . $rating['SCORE'] . '/5 ⭐</p>';
						echo '</div>';
					} else {
			?>

						<div class="valoracionesBuscador">
							<div class="contenedorSoporteParaValoraciones w-100">
								<div class="cuadrado botonDesplegable">Sin Valoración aún</div>
								<div class="ratingDropdown dropdown" style="display: none;">
									<form action="./subirValoracion.php" method="post">
										<div class="ratingBlock">
											<input type="hidden" name="username" value="<?php echo $username; ?>" required>
											<input type="hidden" name="url" value="<?php echo $url; ?>" required>
											<div class="star-rating">
												<img class="star" data-rating="1" src="./img/star/EstrellaVacia.png" alt="Estrella 1">
												<img class="star" data-rating="2" src="./img/star/EstrellaVacia.png" alt="Estrella 2">
												<img class="star" data-rating="3" src="./img/star/EstrellaVacia.png" alt="Estrella 3">
												<img class="star" data-rating="4" src="./img/star/EstrellaVacia.png" alt="Estrella 4">
												<img class="star" data-rating="5" src="./img/star/EstrellaVacia.png" alt="Estrella 5">
											</div>
											<p><textarea name="comment" class="comment" placeholder="Escribe tu comentario aquí (opcional)"></textarea></p>
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
			} ?>
		</div>


		<div id="restoPagina">
			<div id="buscador">
				<div id="lupaBuscador">
					<div id="barraBusqueda" class="barraBusqueda">
						<form id="buscador2" action="./anadirPlaylist.php" method="post">
							<input type="hidden" name="username" value="<?php echo $username; ?>">
							<input type="text" id="urlPlaylist" class="inputBuscador" placeholder="Introduce la ruta embedida del álbum..." name="urlPlaylist">
							<button id="botonBuscar">Añadir</button>
						</form>
						<iframe id="iframeBusqueda" style="border-radius:12px" src="
						<?php if (isset($_GET['playlist'])) {
							echo $_GET['playlist'];
						} else {
							echo 'https://open.spotify.com/embed/playlist/6lHivMtxlldZdqEvpwGRxZ?utm_source=generator';
						}    ?>" width="100%" height="152" frameborder="0" allowfullscreen="" allow="autoplay; clipboard-write; encrypted-media; fullscreen; picture-in-picture" loading="lazy"></iframe>
						<div class="valoracionesBuscador">
							<div class="contenedorSoporteParaValoraciones w-100">
								<div class="cuadrado botonDesplegable">Sin Valoración</div>
								<div class="ratingDropdown dropdown" style="display: none;">
									<form action="./subirValoracion.php" method="post">
										<div class="ratingBlock">
											<input type="hidden" name="username" value="<?php echo $_SESSION['user']; ?>">
											<input type="hidden" name="url" value="
											<?php if (isset($_GET['playlist'])) {
												echo $_GET['playlist'];
											} else {
												echo 'https://open.spotify.com/embed/playlist/6lHivMtxlldZdqEvpwGRxZ?utm_source=generator';
											}    ?>">
											<div class="star-rating">
												<img class="star" data-rating="1" src="./img/star/EstrellaVacia.png" alt="Estrella 1">
												<img class="star" data-rating="2" src="./img/star/EstrellaVacia.png" alt="Estrella 2">
												<img class="star" data-rating="3" src="./img/star/EstrellaVacia.png" alt="Estrella 3">
												<img class="star" data-rating="4" src="./img/star/EstrellaVacia.png" alt="Estrella 4">
												<img class="star" data-rating="5" src="./img/star/EstrellaVacia.png" alt="Estrella 5">
											</div>
											<p><textarea name="comment" class="comment" placeholder="Escribe tu comentario aquí (opcional)"></textarea></p>
											<input type="hidden" name="rating" class="rating-value">
											<p><button type="submit" class="submit-button">Enviar</button></p>
											<p class="listaComentarios"></p>
										</div>
									</form>
								</div>
							</div>
						</div>
					</div>
				</div>


				<div id="valoracionesBuscador">
					<div id="apartado">Mis Playlists</div>
					<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
						<div class="carousel-inner">
							<?php
							$username = $_SESSION['user'];
							$pdo3 = DbConnection::getInstance();
							$ratings = $pdo3->showUserPlaylistRatings($username, 5);
							$active = 'active';

							if ($ratings) {
								// Array para almacenar las valoraciones agrupadas por enlace
								$groupedRatings = array();

								// Agrupar las valoraciones por enlace
								foreach ($ratings as $rating) {
									$link = $rating['LINK'];
									if (!isset($groupedRatings[$link])) {
										$groupedRatings[$link] = array();
									}
									$groupedRatings[$link][] = $rating;
								}
								foreach ($groupedRatings as $link => $ratingsForLink) {
									echo '<div class="carousel-item ' . $active . '">';
									echo '<iframe style="border-radius:12px"
											src="' . $rating['LINK'] . '?utm_source=generator"
											width="100%" height="152" frameBorder="0" allowfullscreen=""
											allow="autoplay; clipboard-write; encrypted-media; fullscreen; picture-in-picture"
											loading="lazy"></iframe>';
									echo '<div id="verValoracion" class="valoracionExistente">';

									foreach ($ratings as $rating) {
										echo '<p>' . $rating['USER_NAME'] . ' - ' . $rating['SCORE'] . ': ' . $rating['TEXT'] . '</p>';
										//echo '</div>';
									}
									echo '</div>';
									echo '</div>';
									$active = '';
								}
							} else {
								echo '<p>Todavia no tienes valoraciones</p>';
							}
							?>
						</div>
						<a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
							<span class="carousel-control-prev-icon" aria-hidden="true"></span>
							<span class="sr-only">Previous</span>
						</a>
						<a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
							<span class="carousel-control-next-icon" aria-hidden="true"></span>
							<span class="sr-only">Next</span>
						</a>
					</div>
				</div>
			</div>



			<div class="contenedor" id="tendencia">
				<div id="apartado">Tus Amigos</div>
				<div id="iframeCarouselTendencia" class="carousel slide" data-ride="carousel">
					<div class="carousel-inner">
						<?php
						//$username = $_SESSION['user'];
						$pdo4 = DbConnection::getInstance();
						$listasAmigos = $pdo4->showFriendsPlaylists($username, 5);
						/*foreach ($listasAmigos as $lista) {
									foreach ($lista as $clave => $valor) {
										echo "Clave: $clave; Valor: $valor<br>";
									}
								}*/
						$active = 'active';

						if ($listasAmigos) {
							foreach ($listasAmigos as $lista) {
								echo '<div class="carousel-item ' . $active . '">';
								echo '<iframe style="border-radius:12px"
											src="' . $lista['LINK'] . '?utm_source=generator"
											width="100%" height="152" frameBorder="0" allowfullscreen=""
											allow="autoplay; clipboard-write; encrypted-media; fullscreen; picture-in-picture"
											loading="lazy"></iframe>';
								if ($lista['TEXT']) {
									echo '<div id="verValoracion" class="valoracionExistente">';
									echo '<p>' . $lista['SCORE'] . '/5 : "' . $lista['TEXT'] . '"</p>';
								} else {
									echo '<div id="verValoracion" class="valoracionExistente">';
									echo 'no has valorado aun';
								}
								echo '<p id="quienSubio">Subido por: ' . $lista['USER_NAME'] . '</p>';
								echo '</div>';
								echo '</div>';
								$active = '';
							}
						} else {
							echo '<p>Tus amigos son unos sosos y aún no han subido playlists :(</p>';
						}
						?>
					</div>

					<a class="carousel-control-prev" href="#iframeCarouselTendencia" role="button" data-slide="prev">
						<span class="carousel-control-prev-icon" aria-hidden="true"></span>
						<span class="sr-only">Anterior</span>
					</a>
					<a class="carousel-control-next" href="#iframeCarouselTendencia" role="button" data-slide="next">
						<span class="carousel-control-next-icon" aria-hidden="true"></span>
						<span class="sr-only">Siguiente</span>
					</a>
				</div>
			</div>

			<div class="contenedor" id="valoraciones">
				<div id="apartado">Valoraciones globales</div>

				<div id="carouselExampleIndicators2" class="carousel slide" data-ride="carousel">
					<div class="carousel-inner">
						<?php
						$pdo5 = DbConnection::getInstance();
						$ratings = $pdo5->showUserRatingsAllRandom(5);
						$active = 'active';

						if ($ratings) {
							foreach ($ratings as $rating) {
								echo '<div class="carousel-item ' . $active . '">';
								echo '<iframe style="border-radius:12px"
											src="' . $rating['LINK'] . '?utm_source=generator"
											width="100%" height="352" frameBorder="0" allowfullscreen=""
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
							echo '<p>Todavia no tienes valoraciones, empieza ya!</p>';
						}
						?>
					</div>
					<a class="carousel-control-prev" href="#carouselExampleIndicators2" role="button" data-slide="prev">
						<span class="carousel-control-prev-icon" aria-hidden="true"></span>
						<span class="sr-only">Previous</span>
					</a>
					<a class="carousel-control-next" href="#carouselExampleIndicators2" role="button" data-slide="next">
						<span class="carousel-control-next-icon" aria-hidden="true"></span>
						<span class="sr-only">Next</span>
					</a>
				</div>
			</div>
		</div>


		<?php if ($mostrarWarning == true) { ?>
			<div class="bloque" id="avisoc">
				<b>Aviso de Cookies:</b>
				Este sitio web utiliza cookies para mejorar la experiencia del usuario, analizar el tráfico y personalizar contenido.
				Al aceptar, consientes el uso de cookies. Puedes gestionarlas en la configuración del navegador. Utilizamos cookies esenciales,
				de rendimiento, funcionalidad y publicidad. Compartimos datos con socios de redes sociales, publicidad y análisis.
				Visita nuestras políticas de privacidad y cookies para más detalles.
				<a href="index.php?aceptadas=true">Aceptar Cookies</a>
			</div>
		<?php } ?>
		<script src="./js/BusquedaSpotify.js" defer></script>
		<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.10.2/umd/popper.min.js" defer></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" defer></script>
		<script src="./js/star-rating.js"></script>
		<script src="./js/script.js"></script>
</body>

</html>