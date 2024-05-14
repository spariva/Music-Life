<?php
require_once '../../../config/init.php';
require '../../../vendor/autoload.php';

// Spotify credentials
$clientId = $_ENV['SPOTIFY_CLIENT_ID'];
$clientSecret = $_ENV['SPOTIFY_CLIENT_SECRET'];
$redirectUri = $_ENV['SPOTIFY_REDIRECT_URI'];

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

// Esta feo coger un par de funciones para evitar usar toda una librería?
// public function requestAccessToken(string $authorizationCode, string $codeVerifier = ''): bool
// {
//     $parameters = [
//         'client_id' => $this->getClientId(),
//         'code' => $authorizationCode,
//         'grant_type' => 'authorization_code',
//         'redirect_uri' => $this->getRedirectUri(),
//     ];

//     // Send a code verifier when PKCE, client secret otherwise Esto se podría quitar.
//     if ($codeVerifier) {
//         $parameters['code_verifier'] = $codeVerifier;
//     } else {
//         $parameters['client_secret'] = $this->getClientSecret();
//     }

//     ['body' => $response] = $this->request->account('POST', '/api/token', $parameters, []);

//     if (isset($response->refresh_token) && isset($response->access_token)) {
//         $this->refreshToken = $response->refresh_token;
//         $this->accessToken = $response->access_token;
//         $this->expirationTime = time() + $response->expires_in;
//         $this->scope = $response->scope ?? $this->scope;

//         return true;
//     }

//     return false;
// }