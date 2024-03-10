<?php
require_once '../../config/init.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_pl = $_POST["id_pl"]?? "";
    $playlistName = $_POST["playlistName"]?? "";
    $creator = $_POST["creator"]?? "";

    if (empty($playlistName)) {
        echo "El nombre de Playlist es requerido.";
    } 


    $mdb = DbConnection::getInstance();
    $db = $mdb->getConnection();

    $sql = "INSERT INTO playlist (id_pl, nombre, creador_id) VALUES (:id_pl, :playlistName, :creator)";
    $stmt = $db->prepare($sql);
    
    $stmt->bindValue(':id_pl', $id_pl, PDO::PARAM_STR);
    $stmt->bindValue(':nombre', $playlistName, PDO::PARAM_STR);
    $stmt->bindValue(':creador_id', $creator, PDO::PARAM_STR);

    $stmt->execute();

    $mdb->closeConnection();

    header("Location: ../../public/usuario.php");
    // header("Location: " . DOC_ROOT . "public/usuario.php");
    exit();
}


