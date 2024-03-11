<?php
require_once '../../config/init.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $url = $_POST['urlPlaylist'];
    $username = $_POST['username'];

    // Extract the URL between src=" and "
    preg_match('/src="([^"]*)"/', $url, $matches);
    $url = $matches[1] ?? '';

    echo $url. '// ';
    echo $username. '// ';

    $db = DbConnection::getInstance()->getConnection();
    $stmt = $db->prepare("INSERT INTO playlist VALUES (?, ?)");
    $result = $stmt->execute([$url, $username]);

    if ($result) {
        // Redirect to index.php on success
        header("Location: /public/index.php?playlist=".$url."&mensaje=Playlist añadida correctamente");
        exit();
    } else {
        // Echo error message on failure
        echo "Error: " . $stmt->errorInfo()[2];
    }
}