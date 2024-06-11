<?php
require_once '../config/init.php';

$clientId = $_ENV['SPOTIFY_CLIENT_ID'];
$clientSecret = $_ENV['SPOTIFY_CLIENT_SECRET'];
$redirectUri = $_ENV['SPOTIFY_REDIRECT_URI'];

// Initialize the Spotify Web API client
$session = new SpotifyWebAPI\Session(
    $clientId,
    $clientSecret,
    $redirectUri
);

// Later, after Spotify redirects to your redirect URI
if (isset($_GET['code'])) {
    $state = $_GET['state'];
    //console log de php

    $storedState = $_SESSION['state'];
    // Fetch the stored state value from somewhere. A session for example
    if ($state !== $storedState) {
        echo "<script>console.log('falló lo del state...');</script>";
        // The state returned isn't the same as the one we've stored, we shouldn't continue
        // $msje = "Error al conectar con Spotify";
        // $mensajeCodificado = urlencode($msj);
        // header("Location: http://music-life.es/index.php?mensaje=" . $mensajeCodificado);
        // die('State mismatch');
    }

    // Request an access token using the code from Spotify
    $session->requestAccessToken($_GET['code']);

    $accessToken = $session->getAccessToken();
    $refreshToken = $session->getRefreshToken();

    // Store the access and refresh tokens somewhere. In a session for example
    $_SESSION['accessToken'] = $accessToken;
    $_SESSION['refreshToken'] = $refreshToken;
    $userName = $_SESSION['user'];
    
    // $mdb = DbConnection::getInstance();
    // $mdb->saveTokensToDatabase($userName, $accessToken, $refreshToken);

    // Send the user along and fetch some data!
    header('Location: ./spotifyLab.php');
    die();
} else {
    // Request authorization from the user
    $state = $session->generateState();
    $_SESSION['state'] = $state;
    $options = [
        'scope' => [
            'user-read-email', 
            'user-read-private',
            'user-top-read',  
            'playlist-read-private',
            'playlist-read-collaborative', 
            'playlist-modify-private',
            'playlist-modify-public',
        ],
        'state' => $state,
    ];

    // Redirect user to Spotify's authorization page
    header('Location: ' . $session->getAuthorizeUrl($options));
    exit();
}






