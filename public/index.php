<!-- require '../config/init.php';
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
							creator: <?php echo $_SESSION['user']; ?> // Asumiendo que 'id_usuario' es la clave correcta para el ID del usuario
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
	<video src="./img/FondoIndexClaro.mp4" id="videoFondo" autoplay="true" muted="true" loop="true"></video>
	<!-- <header id="header">
		<a class="textoCabecera" href="./index.php" id="logo">Music-Life</a>
		<nav class="navbar">
			<a class="textoCabecera" href="./login.php">Cuenta</a>
			<a class="textoCabecera" href="./usuario.php">Usuario</a>
			<a class="textoCabecera" href="./spotify.html">Spotify</a>
			<a class="textoCabecera" href="./contacto.php">Contacto</a>
			<a class="textoCabecera" href="https://github.com/spariva/Music-Life" target="blank">Info</a>
			<a class="textoCabecera" id="modo-oscuro">Modo Oscuro</a>
		</nav>
	</header> -->

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
                    <li class="nav-item"><a class="nav-link" href="https://github.com/spariva/Music-Life" target="_blank">Info</a></li>
                    <li class="nav-item"><a class="nav-link" id="modo-oscuro">Modo Oscuro</a></li>
                </ul>
            </div>
        </nav>
    </header>
	

	<div id="contenido">
		<!-- https://open.spotify.com/embed/album/1pzvBxYgT6OVwJLtHkrdQK?utm_source=generator -->
		<div class="contenedor" id="recomendado">
			<div id="apartado">Top Artistas 2023</div>
			<iframe style="border-radius:12px" src="https://open.spotify.com/embed/playlist/37i9dQZF1DX5KpP2LN299J?utm_source=generator" width="100%" height="152" frameBorder="0" allowfullscreen="" allow="autoplay; clipboard-write; encrypted-media; fullscreen; picture-in-picture" loading="lazy"></iframe>
			<iframe style="border-radius:12px" src="https://open.spotify.com/embed/playlist/37i9dQZF1DX2apWzyECwyZ?utm_source=generator" width="100%" height="152" frameBorder="0" allowfullscreen="" allow="autoplay; clipboard-write; encrypted-media; fullscreen; picture-in-picture" loading="lazy"></iframe>
			<iframe style="border-radius:12px" src="https://open.spotify.com/embed/playlist/37i9dQZF1DX6bnzK9KPvrz?utm_source=generator" width="100%" height="152" frameBorder="0" allowfullscreen="" allow="autoplay; clipboard-write; encrypted-media; fullscreen; picture-in-picture" loading="lazy"></iframe>
			<iframe style="border-radius:12px" src="https://open.spotify.com/embed/playlist/37i9dQZF1DX1LUyBs1uGpN?utm_source=generator" width="100%" height="152" frameBorder="0" allowfullscreen="" allow="autoplay; clipboard-write; encrypted-media; fullscreen; picture-in-picture" loading="lazy"></iframe>
			<iframe style="border-radius:12px" src="https://open.spotify.com/embed/playlist/37i9dQZF1DZ06evO4e5iLu?utm_source=generator" width="100%" height="152" frameBorder="0" allowfullscreen="" allow="autoplay; clipboard-write; encrypted-media; fullscreen; picture-in-picture" loading="lazy"></iframe>
		</div>


		<div id="restoPagina">
			<div id="buscador">
				<div id="lupaBuscador">
					<div id="barraBusqueda" class="barraBusqueda">
						<input type="text" id="nombrePlaylist" class="inputBuscador" placeholder="Introduzca la ruta embedida del álbum..." value="">
						<button id="botonBuscar">Buscar</button>
						<iframe id="iframeBusqueda" style="border-radius:12px" src="https://open.spotify.com/embed/playlist/0XJs446xvZpKhz3pglrOlX?utm_source=generator" width="100%" height="152" frameborder="0" allowfullscreen="" allow="autoplay; clipboard-write; encrypted-media; fullscreen; picture-in-picture" loading="lazy"></iframe>
					</div>
				</div>

				<div id="valoracionesBuscador">
					<div class="contenedorSoporteParaValoraciones w-100">
						<div class="cuadrado" id="botonDesplegable">Sin Valoración</div>
						<div id="ratingDropdown" class="dropdown" style="display: none;">
							<div class="ratingBlock">
								<div class="star-rating">
									<img class="star" data-rating="1" src="./img/star/EstrellaVacia.png" alt="Estrella 1">
									<img class="star" data-rating="2" src="./img/star/EstrellaVacia.png" alt="Estrella 2">
									<img class="star" data-rating="3" src="./img/star/EstrellaVacia.png" alt="Estrella 3">
									<img class="star" data-rating="4" src="./img/star/EstrellaVacia.png" alt="Estrella 4">
									<img class="star" data-rating="5" src="./img/star/EstrellaVacia.png" alt="Estrella 5">
								</div>
								<p></p><textarea id="comment" placeholder="Escribe tu comentario aquí (opcional)"></textarea></p>
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
							<iframe style="border-radius:12px" src="https://open.spotify.com/embed/playlist/37i9dQZEVXbMDoHDwVN2tF?utm_source=generator" width="100%" height="152" frameBorder="0" allowfullscreen="" allow="autoplay; clipboard-write; encrypted-media; fullscreen; picture-in-picture" loading="lazy"></iframe>
						</div>
						<div class="carousel-item">
							<iframe style="border-radius:12px" src="https://open.spotify.com/embed/playlist/37i9dQZEVXbNFJfN1Vw8d9?utm_source=generator" width="100%" height="152" frameBorder="0" allowfullscreen="" allow="autoplay; clipboard-write; encrypted-media; fullscreen; picture-in-picture" loading="lazy"></iframe>
						</div>
						<div class="carousel-item">
							<iframe style="border-radius:12px" src="https://open.spotify.com/embed/playlist/37i9dQZF1DXcBWIGoYBM5M?utm_source=generator" width="100%" height="352" frameBorder="0" allowfullscreen="" allow="autoplay; clipboard-write; encrypted-media; fullscreen; picture-in-picture" loading="lazy"></iframe>
						</div>
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
				<div id="valoracionesListas">
					<div id="apartado">Valoraciones</div>
					<div id="iframeCarouselValoraciones" class="carousel slide" data-ride="carousel">
						<div class="carousel-inner">
							<div class="carousel-item active">
								<iframe style="border-radius:12px" src="https://open.spotify.com/embed/playlist/37i9dQZF1DX3fRquEp6m8D?utm_source=generator" width="100%" height="152" frameBorder="0" allowfullscreen="" allow="autoplay; clipboard-write; encrypted-media; fullscreen; picture-in-picture" loading="lazy"></iframe>
							</div>
							<div class="carousel-item">
								<iframe style="border-radius:12px" src="https://open.spotify.com/embed/playlist/37i9dQZF1DX1PfYnYcpw8w?utm_source=generator" width="100%" height="152" frameBorder="0" allowfullscreen="" allow="autoplay; clipboard-write; encrypted-media; fullscreen; picture-in-picture" loading="lazy"></iframe>
							</div>
						</div>
						<a class="carousel-control-prev" href="#iframeCarouselValoraciones" role="button" data-slide="prev">
							<span class="carousel-control-prev-icon" aria-hidden="true"></span>
							<span class="sr-only">Anterior</span>
						</a>
						<a class="carousel-control-next" href="#iframeCarouselValoraciones" role="button" data-slide="next">
							<span class="carousel-control-next-icon" aria-hidden="true"></span>
							<span class="sr-only">Siguiente</span>
						</a>
					</div>
				</div>
				<div id="valoracionesValoraciones">
					<div id="textoValoraciones">5 estrellas: (Sergio) Me ha encantado <br> 3 estrellas: (luis) No esta mal pero no me encanta
						<br>4 estrellas: (Ana) Muy bueno, ¡me sorprendió gratamente!
						<br>3 estrellas: (Carlos) Aceptable, cumple su función pero esperaba más.
						<br>5 estrellas: (María) ¡Excelente! Superó mis expectativas, lo recomiendo totalmente.
						<br>2 estrellas: (Juan) No me convenció del todo, hay aspectos que podrían mejorar.
					</div>
				</div>
			</div>
		</div>
	</div>
	<script src="./js/BusquedaSpotify.js" defer></script>
	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.10.2/umd/popper.min.js" defer></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" defer></script>
	<script src="./js/star-rating.js"></script>
	<script src="./js/script.js"></script>
</body>

</html>