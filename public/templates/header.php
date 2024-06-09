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
		<script src="https://code.jquery.com/jquery-3.6.0.min.js" defer></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.10.2/umd/popper.min.js" defer></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" defer></script>
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
		<script src="./js/cargaCss.js"></script>
	</head>

	<body class="<?= $bodyClass ?>">
        <?php if ($bodyClass == "crearCuenta"): ?>
            <video src="./img/FondoSpotifyClaro.mp4" id="videoFondo" autoplay="true" muted="true" loop="true"
                disablePictureInPicture></video>
        <?php else: ?>
            <video src="./img/FondoIndexClaro.mp4" id="videoFondo" autoplay="true" muted="true" loop="true"
                disablePictureInPicture></video>
        <?php endif ?>
		<header id="header">
		<nav id='navbar' class="navbar ">

			<a class="textoCabecera" href="./index.php" id="logo">Music-Life</a>

			<a id="homeIcon" class="nav-link" href="./index.php"><i class="fas fa-home"></i><span class="nav-text"> Home</span></a>
			<a class="nav-link" href="./usuario.php"><i class="fas fa-user"></i><span class="nav-text"> Usuario</span></a>
			<a class="nav-link" href="./spotifyLab.php"><i class="fab fa-spotify"></i><span class="nav-text"> Labs</span></a>
			<a class="nav-link" href="./contacto.php"><i class="fas fa-envelope"></i><span class="nav-text"> Contacto</span></a>
			<a class="nav-link" href="https://github.com/spariva/Music-Life" target="_blank"><i class="fas fa-info-circle"></i><span class="nav-text"> Info</span></a>
			<a class="nav-link" id="modo-oscuro"><i id="logo-modo-oscuro" class="fa-solid"></i><span class="nav-text">Modo Oscuro</span></a>
		</nav>
		</header>

		<?php if (isset($msg)) : ?>
			<div class="alert alert-danger w-25 text-center mx-auto d-block mt-5">
				<?php 
					echo $msg;
					unset($msg);
				?>
			</div>
		<?php endif; ?>