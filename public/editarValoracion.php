<?php
require_once '../config/init.php';

if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['nuevaValoracion']) && isset($_POST['editar'])){
    $enlace = $_POST['url'];
    $nuevoRating = $_POST['nuevoRating'];
    $nuevoComment = $_POST['nuevaValoracion'];
    $username = $_SESSION['user'];

    try{
        $db = DbConnection::getInstance()->getConnection();
        $sanitizer = new Sanitizer();
        $stmt = $db->prepare("UPDATE rating SET TEXT = ?, SCORE = ? WHERE USER_NAME = ? AND LINK = ?");
        $result = $stmt->execute([
            $sanitizer->sanitize($nuevoComment), 
            $sanitizer->sanitize($nuevoRating), 
            $sanitizer->sanitize($username), 
            $sanitizer->sanitize($enlace)]);

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
}elseif($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['eliminar']) && isset($_POST['url'])){  
    $enlace = $_POST['url'];
    $username = $_SESSION['user'];

    try{
        $db = DbConnection::getInstance()->getConnection();
        $sanitizer = new Sanitizer();
        $stmt = $db->prepare("DELETE FROM rating WHERE USER_NAME = ? AND LINK = ?");
        $result = $stmt->execute([
            $sanitizer->sanitize($username), 
            $sanitizer->sanitize($enlace)]);

        if($result){
            echo "borrado";
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