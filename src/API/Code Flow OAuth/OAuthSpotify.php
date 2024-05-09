<?php
include_once '../../../config/init.php';
require '../../vendor/autoload.php';

// Load environment variables
(Dotenv\Dotenv::createImmutable(__DIR__))->load();

// Spotify credentials
$clientId = getenv('SPOTIFY_CLIENT_ID');
$clientSecret = getenv('SPOTIFY_CLIENT_SECRET');
$redirectUri = getenv('SPOTIFY_REDIRECT_URI');

// Authorization parameters
$scope = 'user-read-private user-read-email playlist-read-private playlist-read-collaborative playlist-modify-private playlist-modify-public';
$state = bin2hex(random_bytes(16));

// Spotify authorization URL
$authorizeUrl = 'https://accounts.spotify.com/authorize?' . http_build_query([
    'client_id' => $clientId,
    'response_type' => 'code',
    'redirect_uri' => $redirectUri,
    'scope' => $scope,
    'state' => $state
]);

// Redirect user to Spotify authorization page
header('Location: ' . $authorizeUrl);
exit();
