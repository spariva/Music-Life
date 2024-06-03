<?php
require_once '../config/init.php';

echo $_POST['url']. '// ';
echo $_POST['rating']. '// ';
echo $_POST['comment']. '// ';
echo $_POST['username']. '// ';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $url = $_POST['url'];
    $rating = $_POST['rating'];
    $comment = $_POST['comment'];
    $username = $_POST['username']; 

    if (empty($username) || empty($url) || empty($rating)) {
        // Handle the error here. For example, you can redirect back with an error message.
        header("Location: ./index.php?mensaje=Debes rellenar todos los campos");
        exit();
    }

    $db = DbConnection::getInstance()->getConnection();
    $stmt = $db->prepare("INSERT INTO rating (TEXT, USER_NAME, LINK, SCORE) VALUES (?, ?, ?, ?)");
    $result = $stmt->execute([$comment, $username, $url, $rating]);

    if ($result) {
        // Redirect to index.php on success
        header("Location: ./index.php?mensaje=Valoración añadida correctamente");
        exit();
    } else {
        // Echo error message on failure
        echo "Error: " . $stmt->errorInfo()[2];
    }
}

