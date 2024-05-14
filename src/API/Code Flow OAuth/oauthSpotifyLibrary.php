<?php
require_once '../../../config/init.php';
// require '../../../vendor/autoload.php';

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
    // $state = $_GET['state'];
    // Fetch the stored state value from somewhere. A session for example
    // if ($state !== $storedState) {
    //     // The state returned isn't the same as the one we've stored, we shouldn't continue
    //     die('State mismatch');
    // }

    // Request an access token using the code from Spotify
    $session->requestAccessToken($_GET['code']);

    $accessToken = $session->getAccessToken();
    $refreshToken = $session->getRefreshToken();

    // Store the access and refresh tokens somewhere. In a session for example
    $_SESSION['accessToken'] = $accessToken;
    $_SESSION['refreshToken'] = $refreshToken;  
    // Send the user along and fetch some data!
    // header('Location: ' . DOC_ROOT . '/public/usuario.php'); why doesn't work?
    header('Location: ../../../public/usuario.php');
    die();
} else {
    // Request authorization from the user
    $state = $session->generateState();
    $options = [
        'scope' => [
            'user-read-email', 
            'user-read-private',  
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






