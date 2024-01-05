<?php
include_once '../config/init.php';

class LoginManager {
    // ... (existing code remains unchanged)
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $userName = $_POST["userName"] ?? "";
    $userMail = $_POST["userMail"] ?? "";
    $userPassword = $_POST["userPassword"] ?? "";

    // Validate input data
    $errors = [];

    if (empty($userName)) {
        $errors[] = "El nombre de userName es requerido.";
    }

    if (empty($userMail)) {
        $errors[] = "El correo electrónico es requerido.";
    }

    if (empty($userPassword)) {
        $errors[] = "La contraseña es requerida.";
    }

    // If there are validation errors, display them
    if (!empty($errors)) {
        foreach ($errors as $error) {
            echo $error . "<br>";
        }
        exit();
    }

    // Hash the password before storing it in the database
    $hashedPassword = password_hash($userPassword, PASSWORD_DEFAULT);

    // Use the singleton to obtain a database instance
    $db = Db::getInstance();

    // Insert user data into the usuarios table
    $sql = "INSERT INTO usuarios (nombre, email, contrasena) VALUES (:userName, :userMail, :hashedPassword)";
    $stmt = $db->prepare($sql);

    $stmt->bindValue(':userName', $userName, PDO::PARAM_STR);
    $stmt->bindValue(':userMail', $userMail, PDO::PARAM_STR);
    $stmt->bindValue(':hashedPassword', $hashedPassword, PDO::PARAM_STR);

    $stmt->execute();

    // Redirect after successful registration
    header("Location: ../../public/usuario.html");
    exit();
}

// Add code to handle rating submission to the database
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["playlistId"]) && isset($_POST["userId"]) && isset($_POST["rating"])) {
    $playlistId = $_POST["playlistId"];
    $userId = $_POST["userId"];
    $rating = $_POST["rating"];
    $comment = $_POST["comment"] ?? null;

    $db = DbConnection::getInstance();

    // Insert rating data into the VALORACION table
    $sql = "INSERT INTO VALORACION (PLAYLIST_ID, USUARIO_ID, PUNTUACION, COMENTARIO) VALUES (:playlistId, :userId, :rating, :comment)";
    $stmt = $db->prepare($sql);

    $stmt->bindValue(':playlistId', $playlistId, PDO::PARAM_INT);
    $stmt->bindValue(':userId', $userId, PDO::PARAM_INT);
    $stmt->bindValue(':rating', $rating, PDO::PARAM_STR);
    $stmt->bindValue(':comment', $comment, PDO::PARAM_STR);

    $stmt->execute();

    $db->closeConnection();
}

