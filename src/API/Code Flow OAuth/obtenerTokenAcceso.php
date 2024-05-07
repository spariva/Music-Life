<?php
// obtener_token_de_acceso.php
require 'vendor/autoload.php';

// Aquí incluirías cualquier lógica necesaria para validar la solicitud, como verificar la autenticación del usuario, etc.

// Obtener el ID de usuario desde la solicitud (supongamos que se envía como un parámetro POST)
$userId = $_POST['user_id']; // Supongamos que el ID de usuario se envía desde el cliente

// Aquí implementarías la lógica para obtener el token de acceso asociado al usuario desde la base de datos u otro lugar
// Por ejemplo, podrías realizar una consulta SQL para obtener el token de acceso de la tabla de usuarios

// Supongamos que tienes una función ficticia llamada obtenerTokenDeAccesoDesdeBD para obtener el token de acceso
// $accessToken = obtenerTokenDeAccesoDesdeBD($userId);

// // Devolver el token de acceso como respuesta en formato JSON
// echo json_encode(['access_token' => $accessToken]);





// Initialize the Spotify Web API client
$session = new SpotifyWebAPI\Session(
    'your-client-id',      // Your Spotify Client ID
    'your-client-secret',  // Your Spotify Client Secret
    'your-redirect-uri'    // Redirect URI set in your Spotify Developer Dashboard
);

// Request authorization from the user
$options = [
    'scope' => [
        'user-read-email',   // Replace these scopes with the ones you need
        'user-read-private',
    ],
];

// Redirect user to Spotify's authorization page
header('Location: ' . $session->getAuthorizeUrl($options));
exit();

// Later, after Spotify redirects to your redirect URI
if (isset($_GET['code'])) {
    $session->requestAccessToken($_GET['code']);
    $accessToken = $session->getAccessToken();

    // Set up the Spotify API client
    $api = new SpotifyWebAPI\SpotifyWebAPI();
    $api->setAccessToken($accessToken);

    // Fetch user data or perform actions as required
    $user = $api->me();
    print_r($user);
}


