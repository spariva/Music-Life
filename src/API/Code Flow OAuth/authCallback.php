<?php
// auth_callback.php
include_once '../../../config/init.php';
require '../../../vendor/autoload.php';

// Datos de configuración de la aplicación en Spotify Developer Dashboard
$clientId = isset($_ENV['CLIENT_ID']) ? $_ENV['CLIENT_ID'] : 'TU_CLIENT_ID';
$clientSecret = 'TU_CLIENT_SECRET';
$redirectUri = 'TU_URL_DE_REDIRECCIONAMIENTO';
echo $clientId;
// Código de autorización recibido como parámetro GET
$authorizationCode = $_GET['code'];

// Solicitar token de acceso a Spotify
$data = [
    'client_id' => $clientId,
    'client_secret' => $clientSecret,
    'grant_type' => 'authorization_code',
    'code' => $authorizationCode,
    'redirect_uri' => $redirectUri
];

$ch = curl_init('https://accounts.spotify.com/api/token');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));

$response = curl_exec($ch);
curl_close($ch);

// Procesar la respuesta de Spotify
$responseData = json_decode($response, true);

// Manejar el token de acceso y el token de actualización como sea necesario
$accessToken = $responseData['access_token'];
$refreshToken = $responseData['refresh_token'];

// Guardar el token de acceso y el token de actualización en la sesión del usuario o en la base de datos, según sea necesario
// Por ejemplo:
// session_start();
// $_SESSION['access_token'] = $accessToken;
// $_SESSION['refresh_token'] = $refreshToken;

// Redirigir al usuario a la página principal de Music-Life


