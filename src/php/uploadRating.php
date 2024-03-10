<?php
include_once '../../config/init.php';


if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["playlistId"]) && isset($_POST["userId"]) && isset($_POST["rating"])) {
    $playlistId = $_POST["playlistId"];
    $userId = $_POST["userId"];
    $rating = $_POST["rating"];
    $comment = $_POST["comment"] ?? null;

    $mdb = DbConnection::getInstance();
    $db = $mdb->getConnection();

    // Insert rating data into the VALORACION table
    $sql = "INSERT INTO VALORACION (PLAYLIST_ID, USUARIO_ID, PUNTUACION, COMENTARIO) VALUES (:playlistId, :userId, :rating, :comment)";
    $stmt = $db->prepare($sql);

    $stmt->bindValue(':playlistId', $playlistId, PDO::PARAM_INT);
    $stmt->bindValue(':userId', $userId, PDO::PARAM_INT);
    $stmt->bindValue(':rating', $rating, PDO::PARAM_STR);
    $stmt->bindValue(':comment', $comment, PDO::PARAM_STR);

    $stmt->execute();

    $mdb->closeConnection();
}

