<?php
require_once './../config/init.php';

$token = $_GET['token'];

try {
    $db = DbConnection::getInstance();
    $conn = $db->getConnection();

    $sql = 'SELECT USERID FROM tokens WHERE TIPO = "RECOVERY" AND EXPIRES > NOW() AND TOKEN = :TOKEN';
    $stmt = $conn->prepare($sql);

    $stmt->bindParam(':TOKEN', $token, PDO::PARAM_STR);

    $stmt->execute();

    // comprobar si funciono (mediante ver el mensaje que nos sale siempre en tyerminal etc)
    $rowCount = $stmt->rowCount();

    if ($rowCount > 0) {
        //echo "token recibido con éxito.";

        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $mail = $result['USERID'];
        //header("Location: login.php?contrasenaCambiada=true");
        //exit();  // Detiene la ejecución del script después de enviar el encabezado de redirección
    } else {
        $mensaje = "El link ha expirado";
        header("Location: login.php?mensaje=$mensaje&error=true");
        exit();
    }
} catch (PDOException $pe) {
    die("No se pudo conectar a la base de datos $dbname: " . $pe->getMessage());
} finally {
    $conn = null; // Cerramoos
} ?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cambiar Contraseña</title>
    <style>

@font-face {
  font-family: popText;
  src: url(../../public/img/fonts/PopArt-Regular.ttf);
}

        body,
        html {
            margin: 0;
            padding: 0;
            height: 100%;
            overflow: hidden;
            font-family: Arial, sans-serif;
        }

        #videoFondo {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            z-index: -1;
        }

        #ubicador {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
        }

        .contenedor {
            background: rgba(255, 255, 255, 0.8);
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            text-align: center;
            max-width: 350px;
            width: 100%;
        }

        .contenedor h3 {
            margin-bottom: 20px;
            font-size: 24px;
            color: #333;
        }

        .inputBox p {
            margin: 0;
        }

        .inputBox input {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
            text-align: center;
        }

        button {
            background-color: #007BFF;
            color: white;
            border: none;
            padding: 10px 20px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 10px 0;
            cursor: pointer;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #0056b3;
        }

        #logo2 {
            color: white;
            display: block;
            margin-top: 60px;
            font-size: 55px;
            position: absolute;
            margin-bottom: 20px;
            top: 0;
            left: 50%;
            transform: translate(-50%, 0);
            z-index: 11;
            /* Asegúrate de que este valor sea mayor que el z-index de .navbar */
            text-decoration: none;
            font-weight: 550;
            font-family: popText, Impact, Haettenschweiler, 'Arial Narrow Bold', sans-serif;
        }

        @media (max-width: 1200px) {

            .contenedor {
                width: calc(100% - 40px);
                /* Reduce width to ensure margin on both sides */
                margin: 0 20px;
                /* Add margin to ensure the container is not touching screen edges */
            }
            #logo2 {
                font-size: 30px;

            }
        }
    </style>
</head>
<header>
    <a class="textoCabecera" id="logo2">Music-Life</a>
</header>


<body>
    <video src="./img/FondoSpotifyClaro.mp4" id="videoFondo" autoplay="true" muted="true" loop="true" disablePictureInPicture loading="eager" playsinline></video>
    <video src="./img/FondoIndexClaro.mp4" id="videoFondo" autoplay="true" muted="true" loop="true" disablePictureInPicture loading="eager" playsinline></video>
    <div id="ubicador">
        <div class="contenedor">
            <span class="contenedor__efectos"></span>
            <form action="cambiarPsswd2.php" method="post">
                <h2>Nueva contraseña</h2>
                <br>
                <p>Para usuario: <?php echo $mail; ?> </p>
                <div class="inputBox">
                    <p><input type="text" id="new_password" name="new_password" required></p>
                </div>
                <input type="hidden" name="mail" value="<?php echo $mail; ?>">
                <button type="submit">Cambiar ahora</button>
            </form>
        </div>
    </div>
</body>

</html>





<?php
require_once '../config/init.php';


//If there's a msg in the url, it's because the user tried to access the user page without logging in
if (isset($_GET['msg'])) {
    $msg = $_GET['msg'];
    unset($_GET['msg']);
}

$errorsLogin = $_SESSION['errorsLogin'] ?? [];
// es lo mismo que isset($_SESSION['errorsLogin']) ? $_SESSION['errorsLogin'] : [];
unset($_SESSION['errorsLogin']);

$errorsSignUp = $_SESSION['errorsSignUp'] ?? [];
unset($_SESSION['errorsSignUp']);

//Si hay errores en el SignUp para que se cargue el Registro en vez del Login
$bodyClass = $_SESSION['bodyClass'] ?? "";
unset($_SESSION['bodyClass']);
//Recupera los datos del formulario de registro
$userNameSignUp = $_SESSION['userNameSignUp'] ?? "";
$userMailSignUp = $_SESSION['userMailSignUp'] ?? "";
unset($_SESSION['userNameSignUp']);
unset($_SESSION['userMailSignUp']);

//Recupera los datos del formulario de crear cuenta
$userNameLogin = $_SESSION['userNameLogin'] ?? "";
unset($_SESSION['userNameLogin']);

// if(isset($_POST["enviar"]) && (empty($comprobator->errors))){ 
//     $mailer = MailerSingleton::obtenerInstancia();
//     $mailer->enviarCorreo($userMail, $motivo, $nombre, $mensajeExtra);
// }

?>