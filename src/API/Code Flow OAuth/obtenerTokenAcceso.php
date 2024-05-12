<?php
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


