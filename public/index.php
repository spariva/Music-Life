<?php
require '../config/init.php';

//Gestion de la ventana flotante con el aviso sobre las cookies
$mostrarWarning = true;
if (isset($_COOKIE['aceptadas']) && $_COOKIE['aceptadas'] == true) {
    $mostrarWarning = false;
    setcookie('aceptadas', true, time() + (60 * 60 * 24 * 7), "/");
}else {
  if(isset($_GET['aceptadas']) && ($_GET['aceptadas']) == true){
    $mostrarWarning = false;
    setcookie('aceptadas', true, time() + (60 * 60 * 24 * 7), "/");
  }else{
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
						<li class="nav-item"><a class="nav-link" href="./login.php">Cuenta</a></li>
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


		<div id="contenido">
			<!-- < ?php
				$json = file_get_contents('./json/playlistPorDefecto.json');

				$playlists = json_decode($json, true);//Convertir el contenido del archivo JSON a un array en PHP

				shuffle($playlists);

				$playlists = array_slice($playlists, 0, 5); //elegimos cuantas mostrar
			?> -->
			<?php
			$db = DbConnection::getInstance();

			$urls = $db->getRandomUrls(4, 'spotify'); //meter esto en starrating pa q se suba etc
			?>

			<!-- https://open.spotify.com/embed/album/1pzvBxYgT6OVwJLtHkrdQK?utm_source=generator -->
			<div class="contenedor" id="recomendado">
				<div id="apartado">Top Artistas 2023</div>

				<!-- < ?php
				// 5. Generar los iframes con las URLs seleccionadas
				foreach ($playlists as $playlist) {
					echo '<iframe style="border-radius:12px"
						src="' . $playlist . '?utm_source=generator"
						width="100%" height="152" frameBorder="0" allowfullscreen=""
						allow="autoplay; clipboard-write; encrypted-media; fullscreen; picture-in-picture"
						loading="lazy"></iframe>';
				?> -->

				<?php
				foreach ($urls as $url) {
					echo '<iframe style="border-radius:12px"
						src="' . $url . '?utm_source=generator"
						width="100%" height="152" frameBorder="0" allowfullscreen=""
						allow="autoplay; clipboard-write; encrypted-media; fullscreen; picture-in-picture"
						loading="lazy"></iframe>';
				?>

				<div class="valoracionesBuscador"> //de alguna manera guardar aqui el src para subir la valoraciion al darle al boton o pillarla y ya ns
					<div class="contenedorSoporteParaValoraciones w-100">
						<div class="cuadrado botonDesplegable">Sin Valoración</div>
						<div class="ratingDropdown dropdown" style="display: none;">
							<div class="ratingBlock">
								<div class="star-rating">
									<img class="star" data-rating="1" src="./img/star/EstrellaVacia.png" alt="Estrella 1">
									<img class="star" data-rating="2" src="./img/star/EstrellaVacia.png" alt="Estrella 2">
									<img class="star" data-rating="3" src="./img/star/EstrellaVacia.png" alt="Estrella 3">
									<img class="star" data-rating="4" src="./img/star/EstrellaVacia.png" alt="Estrella 4">
									<img class="star" data-rating="5" src="./img/star/EstrellaVacia.png" alt="Estrella 5">
								</div>
								<p></p><textarea class="comment" placeholder="Escribe tu comentario aquí (opcional)"></textarea></p>
								<p><button class="submit-button">Enviar</button></p>
								<p class="rating-value"></p>
								<p class="listaComentarios"></p>
							</div>
						</div>
					</div>
				</div>
				<?php
				}
				?>
			</div>


			<div id="restoPagina">
				<div id="buscador">
					<div id="lupaBuscador">
						<div id="barraBusqueda" class="barraBusqueda">
							<input type="text" id="nombrePlaylist" class="inputBuscador"
								placeholder="Introduzca la ruta embedida del álbum..." value="">
							<button id="botonBuscar">Buscar</button>
							<iframe id="iframeBusqueda" style="border-radius:12px"
								src="https://open.spotify.com/embed/playlist/6lHivMtxlldZdqEvpwGRxZ?utm_source=generator"
								width="100%" height="152" frameborder="0" allowfullscreen=""
								allow="autoplay; clipboard-write; encrypted-media; fullscreen; picture-in-picture"
								loading="lazy"></iframe>
								<div class="valoracionesBuscador">
								<div class="contenedorSoporteParaValoraciones w-100">
									<div class="cuadrado botonDesplegable">Sin Valoración</div>
									<div class="ratingDropdown dropdown" style="display: none;">
										<div class="ratingBlock">
											<div class="star-rating">
												<img class="star" data-rating="1" src="./img/star/EstrellaVacia.png" alt="Estrella 1">
												<img class="star" data-rating="2" src="./img/star/EstrellaVacia.png" alt="Estrella 2">
												<img class="star" data-rating="3" src="./img/star/EstrellaVacia.png" alt="Estrella 3">
												<img class="star" data-rating="4" src="./img/star/EstrellaVacia.png" alt="Estrella 4">
												<img class="star" data-rating="5" src="./img/star/EstrellaVacia.png" alt="Estrella 5">
											</div>
											<p></p><textarea class="comment" placeholder="Escribe tu comentario aquí (opcional)"></textarea></p>
											<p><button class="submit-button">Enviar</button></p>
											<p class="rating-value"></p>
											<p class="listaComentarios"></p>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>

					<div id="valoracionesBuscador">
						<div class="contenedorSoporteParaValoraciones w-100">
							<div class="cuadrado" id="botonDesplegable">Sin Valoración</div>
							<div id="ratingDropdown" class="dropdown" style="display: none;">
								<div class="ratingBlock">
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
									<p></p><textarea id="comment"
										placeholder="Escribe tu comentario aquí (opcional)"></textarea></p>
									<p><button id="submit-button">Enviar</button></p>
									<p id="rating-value"></p>
									<p id="listaComentarios"></p>
								</div>
							</div>
						</div>
					</div>
				</div>

				<div class="contenedor" id="tendencia">
					<div id="apartado">Tendencia</div>
					<div id="iframeCarouselTendencia" class="carousel slide" data-ride="carousel">
						<div class="carousel-inner">
							<div class="carousel-item active">
								<iframe style="border-radius:12px"
									src="https://open.spotify.com/embed/playlist/37i9dQZEVXbMDoHDwVN2tF?utm_source=generator"
									width="100%" height="152" frameBorder="0" allowfullscreen=""
									allow="autoplay; clipboard-write; encrypted-media; fullscreen; picture-in-picture"
									loading="lazy"></iframe>
							</div>
							<div class="carousel-item">
								<iframe style="border-radius:12px"
									src="https://open.spotify.com/embed/playlist/37i9dQZEVXbNFJfN1Vw8d9?utm_source=generator"
									width="100%" height="152" frameBorder="0" allowfullscreen=""
									allow="autoplay; clipboard-write; encrypted-media; fullscreen; picture-in-picture"
									loading="lazy"></iframe>
							</div>
							<div class="carousel-item">
								<iframe style="border-radius:12px"
									src="https://open.spotify.com/embed/playlist/37i9dQZF1DXcBWIGoYBM5M?utm_source=generator"
									width="100%" height="352" frameBorder="0" allowfullscreen=""
									allow="autoplay; clipboard-write; encrypted-media; fullscreen; picture-in-picture"
									loading="lazy"></iframe>
							</div>
						</div>
						<a class="carousel-control-prev" href="#iframeCarouselTendencia" role="button"
							data-slide="prev">
							<span class="carousel-control-prev-icon" aria-hidden="true"></span>
							<span class="sr-only">Anterior</span>
						</a>
						<a class="carousel-control-next" href="#iframeCarouselTendencia" role="button"
							data-slide="next">
							<span class="carousel-control-next-icon" aria-hidden="true"></span>
							<span class="sr-only">Siguiente</span>
						</a>
					</div>
				</div>

				<div class="contenedor" id="valoraciones">
					<div id="valoracionesListas">
						<div id="apartado">Valoraciones</div>
						<div id="iframeCarouselValoraciones" class="carousel slide" data-ride="carousel">
							<div class="carousel-inner">
								<div class="carousel-item active">
									<iframe style="border-radius:12px"
										src="https://open.spotify.com/embed/playlist/37i9dQZF1DX3fRquEp6m8D?utm_source=generator"
										width="100%" height="152" frameBorder="0" allowfullscreen=""
										allow="autoplay; clipboard-write; encrypted-media; fullscreen; picture-in-picture"
										loading="lazy"></iframe>
								</div>
								<div class="carousel-item">
									<iframe style="border-radius:12px"
										src="https://open.spotify.com/embed/playlist/37i9dQZF1DX1PfYnYcpw8w?utm_source=generator"
										width="100%" height="152" frameBorder="0" allowfullscreen=""
										allow="autoplay; clipboard-write; encrypted-media; fullscreen; picture-in-picture"
										loading="lazy"></iframe>
								</div>
							</div>
							<a class="carousel-control-prev" href="#iframeCarouselValoraciones" role="button"
								data-slide="prev">
								<span class="carousel-control-prev-icon" aria-hidden="true"></span>
								<span class="sr-only">Anterior</span>
							</a>
							<a class="carousel-control-next" href="#iframeCarouselValoraciones" role="button"
								data-slide="next">
								<span class="carousel-control-next-icon" aria-hidden="true"></span>
								<span class="sr-only">Siguiente</span>
							</a>
						</div>
					</div>
					<div id="valoracionesValoraciones">
						<div id="textoValoraciones">5 estrellas: (Sergio) Me ha encantado <br> 3 estrellas: (Lu) No esta
							mal pero no me encanta
							<br>4 estrellas: (Ana) Muy bueno, ¡me sorprendió gratamente!
							<br>3 estrellas: (Carlos) Aceptable, cumple su función pero esperaba más.
							<br>5 estrellas: (Maki) ¡Excelente! Superó mis expectativas.
							<br>2 estrellas: (Juan) No me convenció del todo, hay aspectos que podrían mejorar.
						</div>
					</div>
				</div>
			</div>
		</div>

		<?php if($mostrarWarning==true) {?>
			<div class="bloque" id="avisoCookies">
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