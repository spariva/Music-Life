
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
	<link rel="stylesheet" type="text/css" href="./css/nuevocss.css">
	<link rel="stylesheet" type="text/css" href="./css/star-rating.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
	<script src="./js/BusquedaSpotify.js" defer></script>
	<!-- Enlaces a Bootstrap JS (jQuery y Popper.js son necesarios para Bootstrap) -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js" defer></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.10.2/umd/popper.min.js" defer></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" defer></script>

</head>

<body>
	<video src="./img/FondoIndexClaro.mp4" autoplay="true" muted="true" loop="true"></video>
	<header id="header">
		<a class="textoCabecera" href="./index.html" id="logo">Music-Life</a>
		<nav class="navbar">
			<a class="textoCabecera" href="./login.php">Cuenta</a>
			<a class="textoCabecera" href="./spotify.html">Spotify</a>
			<a class="textoCabecera" href="./contacto.php">Contacto</a>
			<a class="textoCabecera" href="https://github.com/spariva/Music-Life" target="blank">Info</a>
			<a class="textoCabecera" id="modo-oscuro" onclick="modoOscuro()">Modo Oscuro</a>
		</nav>
	</header>

	<div id="contenido">
		<!-- https://open.spotify.com/embed/album/1pzvBxYgT6OVwJLtHkrdQK?utm_source=generator -->
		<div class="contenedor" id="recomendado">
			<div id="apartado">Recomendado</div>
			<iframe style="border-radius:12px" src="https://open.spotify.com/embed/album/64LU4c1nfjz1t4VnGhagcg?utm_source=generator" width="100%" height="152" frameBorder="0" allowfullscreen="" allow="autoplay; clipboard-write; encrypted-media; fullscreen; picture-in-picture" loading="lazy"></iframe>
			<iframe style="border-radius:12px" src="https://open.spotify.com/embed/album/151w1FgRZfnKZA9FEcg9Z3?utm_source=generator" width="100%" height="152" frameBorder="0" allowfullscreen="" allow="autoplay; clipboard-write; encrypted-media; fullscreen; picture-in-picture" loading="lazy"></iframe>
			<iframe style="border-radius:12px" src="https://open.spotify.com/embed/album/6kZ42qRrzov54LcAk4onW9?utm_source=generator" width="100%" height="152" frameBorder="0" allowfullscreen="" allow="autoplay; clipboard-write; encrypted-media; fullscreen; picture-in-picture" loading="lazy"></iframe>
			<iframe style="border-radius:12px" src="https://open.spotify.com/embed/album/4hDok0OAJd57SGIT8xuWJH?utm_source=generator" width="100%" height="152" frameBorder="0" allowfullscreen="" allow="autoplay; clipboard-write; encrypted-media; fullscreen; picture-in-picture" loading="lazy"></iframe>
			<iframe style="border-radius:12px" src="https://open.spotify.com/embed/album/5AEDGbliTTfjOB8TSm1sxt?utm_source=generator" width="100%" height="152" frameBorder="0" allowfullscreen="" allow="autoplay; clipboard-write; encrypted-media; fullscreen; picture-in-picture" loading="lazy"></iframe>
			<iframe style="border-radius:12px" src="https://open.spotify.com/embed/album/2Xoteh7uEpea4TohMxjtaq?utm_source=generator" width="100%" height="152" frameBorder="0" allowfullscreen="" allow="autoplay; clipboard-write; encrypted-media; fullscreen; picture-in-picture" loading="lazy"></iframe>

		</div>


		<div class="contendor" id="restoPagina">
			<div  id="buscador">
				<div id="barraBusqueda" class="barraBusqueda">
					<input type="text" name="" class="inputBuscador" placeholder="Introduzca la ruta embedida del álbum..." value="">
					<!-- <div id="barraBusqueda__icono" class="barraBusqueda__icono">
							<img src="./img/search.png">
						</div> -->
					<button class="boton__buscar" >Buscar en Spotify</button>
					<p class="mx-5">Escucha tu lista favorita. Introduce un enlace embed de tu lista en el buscador</p>
				</div>
				<br>
				<div class="contenedorSoporteParaValoraciones w-50"> //to do poner vlorsin al lado
					<div class="hidden" id="listener1"> <iframe class="iframeBuscador w-100 "  src="https://open.spotify.com/embed/playlist/0XJs446xvZpKhz3pglrOlX?utm_source=generator" 
						width="100%" height="352"" frameborder="0" allowtransparency="true" allow="encrypted-media"></iframe>
					</div>

					<div class="cuadrado" id="botonDesplegable" >Sin Valoración</div>
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

			<div class="contenedor" id="zonaAmigos">
				<div id="apartado">Amigos</div>
				<div id="iframeCarouselAmigos" class="carousel slide" data-ride="carousel">
					<div class="carousel-inner">
						<div class="carousel-item active">
							<iframe style="border-radius:12px" src="https://open.spotify.com/embed/playlist/37i9dQZF1DX3fRquEp6m8D?utm_source=generator" width="100%" height="152" frameBorder="0" allowfullscreen="" allow="autoplay; clipboard-write; encrypted-media; fullscreen; picture-in-picture" loading="lazy"></iframe>
						</div>
						<div class="carousel-item">
							<iframe style="border-radius:12px" src="https://open.spotify.com/embed/playlist/37i9dQZF1DX1PfYnYcpw8w?utm_source=generator" width="100%" height="152" frameBorder="0" allowfullscreen="" allow="autoplay; clipboard-write; encrypted-media; fullscreen; picture-in-picture" loading="lazy"></iframe>
						</div>
					</div>
					<a class="carousel-control-prev" href="#iframeCarouselAmigos" role="button" data-slide="prev">
						<span class="carousel-control-prev-icon" aria-hidden="true"></span>
						<span class="sr-only">Anterior</span>
					</a>
					<a class="carousel-control-next" href="#iframeCarouselAmigos" role="button" data-slide="next">
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
		<script src="./js/star-rating.js"></script>
</body>
</html>