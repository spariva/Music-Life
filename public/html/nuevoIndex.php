<?php 
define('NUM_COLUMNS',3);
define('NUM_ELEM_POR_PAG',5);

if(isset($_GET['orderby'])&&is_numeric($_GET['orderby'])&& 1<= $_GET['orderby']&& $_GET['orderby']<= NUM_COLUMNS){
    $orderby = $_GET['orderby'];
}else{
    //LOGGEAR
    $orderby = 1;
}

//Revisa si le hemos especificado el tipo de orden y asi lo asigna
if(isset($_GET['order'])){
    if($_GET['order']=="ASC"){
        $order = 'ASC';
    }else{
        $order = 'DESC';
    }
}else{//En caso contrario ordenará por defecto en orden ascendente
    $order = 'ASC';
}

//Revisa la pagina y comprueba si es nu,erica para asignar
if(isset($_GET['page'])&& is_numeric($_GET['page'])){
    $page = $_GET['page']; //Si se cumple asigna esa pagina
}else{
    $page = 1;//Si no establece una por defecto
}

try{
    $db = new PDO('mysql:host=localhost; dbname=sergio', 'sergio', '1234');
	
    $consulta = $db ->prepare("SELECT id, nombre, calorias FROM Comida ORDER BY :orderby $order LIMIT :limite OFFSET :o"); //falta??
    $consulta->bindParam(':orderby',$orderby, PDO::PARAM_INT);
    $consulta->bindValue(':limite', NUM_ELEM_POR_PAG, PDO::PARAM_INT);
    $consulta->bindValue(':offset', NUM_ELEM_POR_PAG*($page-1), PDO::PARAM_INT);
    $results = $consulta->execute();
    $datos = $consulta->fetchAll(PDO::FETCH_ASSOC);

    $consulta_count = $DB->query("SELECT Count(id) AS N From Comida");
    $count = $consulta_count->fetch();
    $count = $count[0];
    $num_pages= ceil($count/NUM_ELEM_POR_PAG);

}catch(PDOException $e){
    echo "ERROR:" .$e->getMessage();
    die();
}

function generateQueryString($orderapintar, $orderby, $order){
    if($orderapintar == $orderby){//Invertir orden
        $neworder = ($order=="ASC")?"DESC":"ASC";
        return "?orderby=$orderapintar&order=$neworder";
    }else{
        return "?orderby=$orderapintar&order=ASC";
    }
}
?>


<!DOCTYPE html>
<html lang="es">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="icon" href="https://developer.spotify.com/images/guidelines/design/icon3@2x.png" type="image/png">
	<title>Music-Life</title>
	<link rel="stylesheet" type="text/css" href="../css/nuevocss.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
	<script src="../js/BusquedaSpotify.js" defer></script>

</head>

<body>
	<video src="../img/FondoIndexClaro.mp4" autoplay="true" muted="true" loop="true"></video>
	<header id="header">
		<a class="textoCabecera" href="./index.html" id="logo">Music-Life</a>
		<nav class="navbar">
			<a class="textoCabecera" href="./login.html">Cuenta</a>
			<a class="textoCabecera" href="./spotify.html">Spotify</a>
			<a class="textoCabecera" href="./contacto.html">Contacto</a>
			<a class="textoCabecera" href="https://github.com/spariva/Music-Life" target="blank">Info</a>
			<a class="textoCabecera" id="modo-oscuro" onclick="modoOscuro()">Modo Oscuro</a>
		</nav>
	</header>

	<div id="contenido">
		<!-- https://open.spotify.com/embed/album/1pzvBxYgT6OVwJLtHkrdQK?utm_source=generator -->
		<div class="contenedor" id="recomendado">
			<div id="apartado">Recomendado</div>
			<iframe style="border-radius:12px"
				src="" width="100%"
				height="152" frameBorder="0" allowfullscreen="https://open.spotify.com/embed/album/1pzvBxYgT6OVwJLtHkrdQK?utm_source=generator"
				allow="autoplay; clipboard-write; encrypted-media; fullscreen; picture-in-picture"
				loading="lazy"></iframe>
			<iframe style="border-radius:12px"
				src="https://open.spotify.com/embed/album/64LU4c1nfjz1t4VnGhagcg?utm_source=generator" width="100%"
				height="152" frameBorder="0" allowfullscreen=""
				allow="autoplay; clipboard-write; encrypted-media; fullscreen; picture-in-picture"
				loading="lazy"></iframe>
			<iframe style="border-radius:12px"
				src="https://open.spotify.com/embed/album/151w1FgRZfnKZA9FEcg9Z3?utm_source=generator" width="100%"
				height="152" frameBorder="0" allowfullscreen=""
				allow="autoplay; clipboard-write; encrypted-media; fullscreen; picture-in-picture"
				loading="lazy"></iframe>
			<iframe style="border-radius:12px"
				src="https://open.spotify.com/embed/album/6kZ42qRrzov54LcAk4onW9?utm_source=generator" width="100%"
				height="152" frameBorder="0" allowfullscreen=""
				allow="autoplay; clipboard-write; encrypted-media; fullscreen; picture-in-picture"
				loading="lazy"></iframe>
			<iframe style="border-radius:12px"
				src="https://open.spotify.com/embed/album/4hDok0OAJd57SGIT8xuWJH?utm_source=generator" width="100%"
				height="152" frameBorder="0" allowfullscreen=""
				allow="autoplay; clipboard-write; encrypted-media; fullscreen; picture-in-picture"
				loading="lazy"></iframe>
			<iframe style="border-radius:12px"
				src="https://open.spotify.com/embed/album/5AEDGbliTTfjOB8TSm1sxt?utm_source=generator" width="100%"
				height="152" frameBorder="0" allowfullscreen=""
				allow="autoplay; clipboard-write; encrypted-media; fullscreen; picture-in-picture"
				loading="lazy"></iframe> <iframe style="border-radius:12px"
				src="https://open.spotify.com/embed/album/2Xoteh7uEpea4TohMxjtaq?utm_source=generator" width="100%"
				height="152" frameBorder="0" allowfullscreen=""
				allow="autoplay; clipboard-write; encrypted-media; fullscreen; picture-in-picture"
				loading="lazy"></iframe>

		</div>
		<div class="contendor" id="restoPagina">
			<div class="contenedor" id="buscador">
				<p>Escucha tu lista favorita. Introduce un enlace embed de tu lista en el buscador</p>
				<div id="barraBusqueda" class="barraBusqueda">
					<input type="text" name="" class="inputBuscador"
						placeholder="Introduzca la ruta embedida del álbum..." value="">
					<!-- <div id="barraBusqueda__icono" class="barraBusqueda__icono">
							<img src="../img/search.png">
						</div> -->
					<button class="boton__buscar" onclick="buscarLista()">Buscar en Spotify</button>
				</div>
				<br>
				<iframe class="iframeBuscador"
					src="https://open.spotify.com/embed/playlist/0XJs446xvZpKhz3pglrOlX?utm_source=generator"
					frameborder="0" allowtransparency="true" allow="encrypted-media"></iframe>

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
					<div id="textoValoraciones">5 estrellas: (Sergio) Me ha encantado <br> 3 estrellas: (luis) No esta mal pero no me encanta
					<br>4 estrellas: (Ana) Muy bueno, ¡me sorprendió gratamente!
					<br>3 estrellas: (Carlos) Aceptable, cumple su función pero esperaba más.
					<br>5 estrellas: (María) ¡Excelente! Superó mis expectativas, lo recomiendo totalmente.
					<br>2 estrellas: (Juan) No me convenció del todo, hay aspectos que podrían mejorar. </div>

				</div>

			</div>

		</div>

		<!-- Enlaces a Bootstrap JS (jQuery y Popper.js son necesarios para Bootstrap) -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.10.2/umd/popper.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>

</html>