<?php
require 'vendor/autoload.php';

use SpotifyWebAPI\Session;
use SpotifyWebAPI\SpotifyWebAPI;

$clientId = $_ENV['SPOTIFY_CLIENT_ID'];
$clientSecret = $_ENV['SPOTIFY_CLIENT_SECRET'];
$redirectUri = $_ENV['SPOTIFY_REDIRECT_URI'];

$session = new Session(
    $clientId,
    $clientSecret,
    $redirectUri
);

$api = new SpotifyWebAPI();

session_start();
if (isset($_SESSION['accessToken'])) {
    $accessToken = $_SESSION['accessToken'];
    $api->setAccessToken($accessToken);
} else {
    header('Location: ./oauthSpotifyLibrary.php');
    exit();
}

$playlistId = 'tu_playlist_id_aqui';

$playlist = $api->getPlaylist($playlistId);
$tracks = $api->getPlaylistTracks($playlistId);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Spotify Playlist</title>
</head>
<body>
    <h1><?php echo $playlist->name; ?></h1>
    <p><?php echo $playlist->description; ?></p>
    <?php if (!empty($playlist->images)): ?>
        <img src="<?php echo $playlist->images[0]->url; ?>" alt="Playlist Cover" style="max-width: 300px;">
    <?php endif; ?>

    <h2>Tracks</h2>
    <ul>
        <?php foreach ($tracks->items as $item): ?>
            <li>
                <?php 
                $track = $item->track;
                if ($track->is_local) {
                    echo '[Local] ';
                }
                echo $track->name . ' by ' . $track->artists[0]->name; 
                ?>
            </li>
        <?php endforeach; ?>
    </ul>
</body>
</html>