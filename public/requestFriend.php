<?php

require_once '../config/init.php';
                    
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $search = $_POST['search'];
    $username = $_POST['username']; 

                    
    if (empty($username) || empty($search)) {
                            
        header("Location: ./usuario.php?mensaje=El usuario introducido no existe");
        exit();
    }
    echo 'El usuario introducido no existe o ya ha sido añadido';
                    
    $db = DbConnection::getInstance()->getConnection();

    $stmt = $db->prepare("INSERT INTO requests (REQUEST_USER, REQUESTED_USER) VALUES (:username, :search)");
    $result = $stmt->execute([$username, $search]);
                    
    if ($result) {
                            
        header("Location: ./usuario.php?mensaje=Solicitud enviada correctamente");
        exit();
    } else {
                            
        echo "Error: " . $stmt->errorInfo()[2];
    }
}