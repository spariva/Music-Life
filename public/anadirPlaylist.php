<?php
require_once '../config/init.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $url = $_POST['urlPlaylist'];
    $username = $_POST['username'];

    try {
        $db = DbConnection::getInstance()->getConnection();
        $stmt = $db->prepare("INSERT INTO playlist VALUES (?, ?)");
        $result = $stmt->execute([$url, $username]);

        if ($result) {
            // Redirect to index.php on success
            header("Location: ./index.php?mensaje=Playlist añadida correctamente");
            exit();
        } else {
            // Echo error message on failure
            header("Location: ./index.php?playlist=" . $url . "&mensaje=Esta playlist ya ha sido añadida por otro usuario :(");
            exit();
        }
    } catch (Exception $error) {
        header("Location: ./index.php?playlist=" . $url . "&mensaje=Esta playlist ya ha sido añadida por otro usuario :(");
        exit();
    }
    header("Location: ./index.php?playlist=".$url."&error=Esta playlist ya ha sido añadida por otro usuario");

}