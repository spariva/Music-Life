<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_pl = $_POST["id_pl"]?? "";
    $playlistName = $_POST["playlistName"]?? "";
    $creator = $_POST["creator"]?? "";

    if (empty($playlistName)) {
        echo "El nombre de Playlist es requerido.";
    } 

    // Hacemos uso del singleton para obtener una instancia de la base de datos
    $db = Db::getInstance();

    $sql = "INSERT INTO PLAYLIST (id_pl, nombre, creador_id) VALUES (:id_pl, :playlistName, :creator)";
    $stmt = $db->prepare($sql);
    
    $stmt->bindValue(':id_pl', $id_pl, PDO::PARAM_STR);
    $stmt->bindValue(':nombre', $playlistName, PDO::PARAM_STR);
    $stmt->bindValue(':creador_id', $creator, PDO::PARAM_STR);

    $stmt->execute();

    $db->closeConnection();

    header("Location: ../../public/usuario.php"); //cambiar el doc root a que sea public
    exit();
}
?>

