<?php 
require_once '../config/init.php';
?>

<!DOCTYPE html>
<html lang="es">

	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="icon" href="https://developer.spotify.com/images/guidelines/design/icon3@2x.png" type="image/png">
		<title>Music-Life</title>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="./css/navbar.css">
		<!-- <link rel="stylesheet" type="text/css" href="./css/nuevocss.css">
		<link rel="stylesheet" type="text/css" href="./css/star-rating.css">
        <link rel="stylesheet" type="text/css" href="./css/usuario.css"> -->
		<script src="https://code.jquery.com/jquery-3.6.0.min.js" defer></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.10.2/umd/popper.min.js" defer></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" defer></script>
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
		<script src="./js/star-rating.js" defer></script>
		<script src="./js/script.js" defer></script>
		<script src="./js/cargaCss.js"></script>
		<script src="./js/login.js" defer></script>
		<script src="./js/procesarInputs.js" defer></script>
	</head>

	<!-- <body> -->
	<!-- <video id="videoFondo" autoplay="true" muted="true" loop="true" disablePictureInPicture loading="eager"></video> -->
	<body class="<?= $bodyClass ?>">
        <?php if ($bodyClass == "crearCuenta"): ?>
            <video src="./img/FondoSpotifyClaro.mp4" id="videoFondo" autoplay="true" muted="true" loop="true"
                disablePictureInPicture></video>
        <?php else: ?>
            <video src="./img/FondoIndexClaro.mp4" id="videoFondo" autoplay="true" muted="true" loop="true"
                disablePictureInPicture></video>
        <?php endif ?>
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
						<li class="nav-item"><a class="nav-link" href="./spotifyLab.php">Labs</a></li>
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