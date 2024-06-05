<?php
require_once '../config/init.php';

if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['nuevaValoracion'])){
    $enlace = $_POST['url'];
    $nuevoRating = $_POST['nuevoRating'];
    $nuevoComment = $_POST['nuevaValoracion'];
    $username = $_SESSION['user'];

    try{
        $db = DbConnection::getInstance()->getConnection();
        $stmt = $db->prepare("UPDATE rating SET TEXT = ?, SCORE = ? WHERE USER_NAME = ? AND LINK = ?");
        $result = $stmt->execute([$nuevoComment, $nuevoRating, $username, $enlace]);

        if($result){
            echo "bien";
            header("Location: ./usuario.php");
            exit();
        }else{
            echo "Error: " . $stmt->errorInfo()[2];
        }
    }catch(PDOException $e){
        echo "Error" . $e->getMessage();
    }   
}else{
    echo "Error";
}

?>