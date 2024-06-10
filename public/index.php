<?php
require_once 'templates/header.php';

$clientId = $_ENV['SPOTIFY_CLIENT_ID'];
$clientSecret = $_ENV['SPOTIFY_CLIENT_SECRET'];

$session = new SpotifyWebAPI\Session(
	$clientId,
	$clientSecret,
);

try {
	$session->requestCredentialsToken();
	$accessToken = $session->getAccessToken();
	setcookie('indexToken', $accessToken, time() + 3600, '/');
} catch (Exception $e) {
	http_response_code(500);
	echo json_encode(['error' => 'Failed to retrieve access token', 'message' => $e->getMessage()]);
}

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
	<!--<script>
		var mensaje = document.getElementById('mensaje');
		if (mensaje) {
			mensaje.style.display = 'block';
			setTimeout(function() {
				mensaje.style.display = 'none';
			}, 4000);
		}
	</script>-->
	<script>
		var mensaje = document.getElementById('mensaje');
		if (mensaje) {
			mensaje.style.display = 'block';
			setTimeout(function () {
				mensaje.style.display = 'none';
			}, 4000);
		}
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
			if (isset($_SESSION['user'])) {
				$username = $_SESSION['user'];
			}
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
		} ?>
	</div>

	<div id="restoPagina">
		<div id="buscador">
			<div id="lupaBuscador">
				<div id="barraBusqueda" class="barraBusqueda">
					<form id="buscador2" aria-label="Botón de búsqueda de playlists" action="">
						<input type="hidden" name="username" value="<?php echo $username; ?>">
						<input type="text" id="inputBusqueda" class="inputBuscador" placeholder="¿Qué quieres buscar?">
						<a class="button-wrapper">
							<span class="dot dot-1"></span>
							<span class="dot dot-2"></span>
							<span class="dot dot-3"></span>
							<span class="dot dot-4"></span>
							<span class="dot dot-5"></span>
							<span class="dot dot-6"></span>
							<span class="dot dot-7"></span>
							<span class="dot dot-1"></span>
							<span class="dot dot-2"></span>
							<span class="dot dot-3"></span>
							<span class="dot dot-4"></span>
							<span class="dot dot-5"></span>
							<span class="dot dot-6"></span>
							<span class="dot dot-7"></span>
							<span id="botonBuscar" class="button btn btn-lg rounded-pill btn-primary-subtle">
								<button id="botonBuscar"
									class="btn btn-primary-subtle rounded-pill btnBuscar">Buscar</button>
							</span>
						</a>
					</form>

					<?php if (isset($_SESSION['user'])) { ?>

						<form id="buscador3" action="./anadirPlaylist.php" method="post">
							<input type="hidden" name="username" value="<?php echo $username; ?>">
							<input type="hidden" id="urlPlaylist" class="inputBuscador" name="urlPlaylist">
							<button id="botonGuardar">Compartir playlist</button>
						</form>

					<?php } ?>



					<iframe id="iframeBusqueda" style="border-radius:12px" src="<?php if (isset($_GET['playlist'])) {
						echo $_GET['playlist'];
					} else {
						echo 'https://open.spotify.com/embed/playlist/6lHivMtxlldZdqEvpwGRxZ?utm_source=generator';
					} ?>" width="100%" height="152" frameborder="0" allowfullscreen=""
						allow="autoplay; clipboard-write; encrypted-media; fullscreen; picture-in-picture"
						loading="lazy"></iframe>




					<!--<iframe id="iframeBusqueda" style="border-radius:12px" src="https://open.spotify.com/embed/playlist/6lHivMtxlldZdqEvpwGRxZ?utm_source=generator" width="100%" height="152" frameborder="0" allowfullscreen="" allow="autoplay; clipboard-write; encrypted-media; fullscreen; picture-in-picture" loading="lazy"></iframe>-->
					<?php if (isset($_SESSION['user'])) { ?>

						<div class="valoracionesBuscador">
							<div class="contenedorSoporteParaValoraciones w-100">
								<div class="cuadrado botonDesplegable">Sin Valoración</div>
								<div class="ratingDropdown dropdown" style="display: none;">
									<form action="./subirValoracion.php" method="post">
										<div class="ratingBlock">
											<input type="hidden" name="username" value="
											<?php echo $_SESSION['user'];
											?>">
											<input type="hidden" name="url" value="
											<?php if (isset($_GET['playlist'])) {
												echo $_GET['playlist'];
											} else {
												echo 'https://open.spotify.com/embed/playlist/6lHivMtxlldZdqEvpwGRxZ?utm_source=generator';
											} ?>">
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
											<input type="hidden" name="rating" class="rating-value">
											<p><button type="submit" class="submit-button">Enviar</button></p>
											<p class="listaComentarios"></p>

										</div>
									</form>
								</div>
							</div>
						</div>
					<?php } else {
						echo '<p style="text-align: center" >Debes estar logueado para poder valorar</p>';
					} ?>
				</div>
			</div>

			<!-- CUIDADO DIV TODO -->
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
								// echo '<div class="carousel-item ' . $active . '">';
								// echo '<iframe style="border-radius:12px"
								// 		src="' . $rating['LINK'] . '?utm_source=generator"
								// 		width="100%" height="152" frameBorder="0" allowfullscreen=""
								// 		allow="autoplay; clipboard-write; encrypted-media; fullscreen; picture-in-picture"
								// 		loading="lazy"></iframe>';
								// echo '<div id="verValoracion" class="valoracionExistente">';
						
								// foreach ($ratings as $rating) {
								// 	echo '<p>' . $rating['USER_NAME'] . ' - ' . $rating['SCORE'] . ': ' . $rating['TEXT'] . '</p>';
								// 	//echo '</div>';
								// }
								// echo '</div>';
								// echo '</div>';
								// $active = '';
								?>
								<div class="valoracion carousel-item">
									<form action="./editarValoracion.php" method="post">
										<div class="<?= $active ?> ">
											<iframe src="<?= $rating['LINK'] ?>?utm_source=generator" frameborder="0"
												allowfullscreen="" width="100%" height="152" frameBorder="0" allowfullscreen=""
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
													<input type="hidden" name="url" value="<?= $rating['LINK'] ?>">
													<p><textarea name="nuevaValoracion" class="comment"
															placeholder="Escribe tu comentario aquí (opcional)"></textarea></p>
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
								<?php
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
						echo '<p style="text-align:center">Tus amigos son unos sosos y aún no han subido playlists :(</p>';
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
</div>


<?php if ($mostrarWarning == true) { ?>
	<div class="bloque" id="avisoc">
		<div id="avisoCookies">
			<h4>Aviso de Cookies<h4>
		</div>
		<div id="textoCookies">Para mejorar tu experiencia en la web recogemos algunas cookies, nos sirven para acordarnos
			de si preferias
			modo oscuro o claro, de quien eras (para no tener que iniciar sesión cada vez) y para algunos datos de
			configuración más.<br>
			No recogemos ni recopilamos ningún tipo de dato sensible.
			Y tranqui, con nosotres tus cookies están a salvo.
		</div>
		<div id="aceptarCookies"> <a href="index.php?aceptadas=true">Aceptar Cookies</a></div>
		<div id="imgCookies1"><img class="imgCookies" src="./img/cookieMonster.png" alt="cookie1"></div>
		<div id="imgCookies2"><img class="imgCookies" src="./img/cookies.png" alt="cookie2"></div>
	</div>
<?php } ?>
<!-- <script src="./js/BusquedaSpotify.js" defer></script> -->
<script src="./js/playlistsAPI.js" defer></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.10.2/umd/popper.min.js" defer></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" defer></script>
<script src="./js/star-rating.js" defer></script>
<script src="./js/editarValoraciones.js" defer></script>
<script src="./js/script.js" defer></script>
</body>


</html>