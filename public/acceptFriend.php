<?php

require_once '../config/init.php';
                    
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $friend = $_POST['friend']; 
    $aceptar = $_POST['aceptar'];
    $rechazar = $_POST['rechazar'];


    if (empty($username) || empty($friend)) {
                            
        header("Location: ./usuario.php?mensaje=El usuario introducido no existe");
        exit();
    }

    if($aceptar != null) {
        $db = DbConnection::getInstance()->getConnection();

        $stmt = $db->prepare("INSERT INTO friends (USER_NAME, FRIEND_NAME) VALUES (:username, :friend)");
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':friend', $friend);
        $result1 = $stmt->execute();
    
        $stmt = $db->prepare("INSERT INTO friends (USER_NAME, FRIEND_NAME) VALUES (:friend, :username)");
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':friend', $friend);
        $result2 = $stmt->execute();

        $stmt = $db->prepare("DELETE FROM requests WHERE REQUEST_USER = :friend AND REQUESTED_USER = :username");
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':friend', $friend);
        $result3 = $stmt->execute();

        $result = $result1 && $result2 && $result3; // Ambas consultas deben ser exitosas
        header("Location: ./usuario.php?mensaje=Ahora sois amigos :)");
        exit();

    } elseif($rechazar != null) {
        $db = DbConnection::getInstance()->getConnection();
                
        $stmt = $db->prepare("DELETE FROM requests WHERE REQUEST_USER = :friend AND REQUESTED_USER = :username");
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':friend', $friend);
        $result4 = $stmt->execute();

        header("Location: ./usuario.php?mensaje=Solicitud rechazada");
        exit();
        
    }
  
                    
    if ($result) {           
        header("Location: ./usuario.php?mensaje=Ahora sois amigos :)");
        exit();
    } else {
        header("Location: ./usuario.php?mensaje=Hubo un problema, vuelve a intentarlo :(");
        exit();
    }
}