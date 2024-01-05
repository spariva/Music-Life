<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
//include '../config/init.php';
include './DbConnection.php';
include './SignUpManager.php';

session_start();
$mdb = DbConnection::getInstance();
$db = $mdb->getConnection();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {

    $userName = $_POST["userName"] ?? "";
    $userMail = $_POST["userMail"] ?? "";
    $userPassword = $_POST["userPassword"] ?? "";

    $registrator = new SignUpManager($userName, $userMail, $userPassword);
    $registrator->sanitizeSignUpManager();

    if (!$registrator->validateSignUpManager()) {
        echo "Error en los datos ingresados.";
        print_r($registrator->errors);
        exit();
    }

    if (!$registrator->checkEmailExist($db)) {
        $registrator->saveUser($db);
        $_SESSION['user'] = $userName;
        $_SESSION['email'] = $userMail;
        header("Location: ../../public/usuario.php");
        die();
    } else {
        $registrator->saveUser($db);
        echo "El correo electrónico ya está registrado.";
    }
}
$db = new PDO("mysql:host=localhost;dbname=musicLifeDatabase;charset=utf8mb4", "musicLifeProd", "musicLifeProd1234");
$sql = "SELECT * FROM USER WHERE EMAIL = :EMAIL LIMIT 1";
$stmt = $db->prepare($sql);
$stmt->bindValue(':EMAIL', $userMail, PDO::PARAM_STR);
$stmt->execute();
$user = $stmt->fetch(PDO::FETCH_ASSOC);
print_r($user);