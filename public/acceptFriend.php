<?php

require_once '../config/init.php';
                    
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $friend = $_POST['friend']; 
    $aceptar = $_POST['aceptar'];
    $rechazar = $_POST['rechazar'];
    echo 'paso 0';


    if (empty($username) || empty($friend)) {
                            
        header("Location: ./usuario.php?mensaje=El usuario introducido no existe");
        echo 'error';

        exit();
    }

    if($aceptar != null) {
        // Código para aceptar la solicitud de amistad
        $db = DbConnection::getInstance()->getConnection();
        echo 'empezamos conexion';

        $stmt = $db->prepare("INSERT INTO friends (USER_NAME, FRIEND_NAME) VALUES (:username, :friend)");
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':friend', $friend);
        $result1 = $stmt->execute();
        echo 'paso 1';

    
        $stmt = $db->prepare("INSERT INTO friends (USER_NAME, FRIEND_NAME) VALUES (:friend, :username)");
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':friend', $friend);
        $result2 = $stmt->execute();
        echo 'paso 2';


        $stmt = $db->prepare("DELETE FROM requests WHERE REQUEST_USER = :friend AND REQUESTED_USER = :username");
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':friend', $friend);
        $result3 = $stmt->execute();
        echo 'paso 3';


        $result = $result1 && $result2 && $result3; // Ambas consultas deben ser exitosas
        header("Location: ./usuario.php?mensaje=Ahora sois amigos :)");
        exit();

    } elseif($rechazar != null) {
        echo 'empezamos conexion rechazar';
        // Código para rechazar la solicitud de amistad
        $db = DbConnection::getInstance()->getConnection();
        
        echo "DELETE FROM requests WHERE REQUEST_USER = " . $username . " AND REQUESTED_USER = " . $friend . "";
        
        $stmt = $db->prepare("DELETE FROM requests WHERE REQUEST_USER = :friend AND REQUESTED_USER = :username");
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':friend', $friend);
        $result4 = $stmt->execute();

        //header("Location: ./usuario.php?mensaje=Solicitud rechazada");
        header("Location: ./usuario.php?mensaje=DELETE FROM requests WHERE REQUEST_USER = " . $username . " AND REQUESTED_USER = " . $friend);
        exit();
        
    }
  
    echo 'El usuario introducido no existe o ya ha sido añadido';
                    
    if ($result) {
                            
        header("Location: ./usuario.php?mensaje=Ahora sois amigos :)");
        exit();
    } else {
                            
        echo "Error: " . $stmt->errorInfo()[2];
    }
}