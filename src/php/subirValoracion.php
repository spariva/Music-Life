<?php
require_once '../../config/init.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $url = $_POST['url'];
    $rating = $_POST['rating'];
    $comment = $_POST['comment'];
    $username = $_SESSION['username']; 

    $pdo = DbConnection::getInstance();
    $stmt = $pdo->prepare("INSERT INTO rating (TEXT, USER_NAME, LINK, SCORE, DATE) VALUES (?, ?, ?, ?, CURRENT_TIMESTAMP)");
    $stmt->execute([$comment, $username, $url, $rating]);
}