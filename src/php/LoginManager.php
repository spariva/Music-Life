<?php
include('../config/init.php');

class LoginManager{
    public $errors;

    public function __construct($datos){
        $this->errors = [];
        $this->email = Sanitizer::sanitizeEmail($datos['email'], $this->errors['email']);
        $this->password = Sanitizer::sanitizeString($datos['password'], $this->errors['password']);
    }

    public function login(): bool{
        $db = Db::getInstance();
        $sql = "SELECT * FROM usuarios WHERE email = :email";
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':email', $this->email, PDO::PARAM_STR);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        $db->closeConnection();

        if ($user === false) {
            $this->errors['email'] = 'El email no es valido.';
            return false;
        }

        if (!password_verify($this->password, $user['password'])) {
            $this->errors['password'] = 'La contraseña no es correcta.';
            return false;
        }

        return true;
    }
    //user exist ();
    //user is valid();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $userName = $_POST["userName"]?? "";
    $userMail = $_POST["userMail"]?? "";
    $userPassword = $_POST["userPassword"]?? "";


    if (empty($userName)) {
        echo "El nombre de userName es requerido.";
    } 

    if (empty($userMail)) {
        echo "El correo electrónico es requerido.";
    }
    //la userPassword debería ser encriptada?
    if (empty($userPassword)) {
        echo "La contraseña es requerida.";
    }

    // Hacemos uso del singleton para obtener una instancia de la base de datos
    $db = Db::getInstance();

    $sql = "INSERT INTO usuarios (nombre, email, conrasena) VALUES (:userName, :userMail, :userPassword)";
    $stmt = $db->prepare($sql);
    
    $stmt->bindValue(':nombre', $userName, PDO::PARAM_STR);
    $stmt->bindValue(':email', $userMail, PDO::PARAM_STR);
    $stmt->bindValue(':nombre', $userPassword, PDO::PARAM_STR);

    $stmt->execute();

    $db->closeConnection();

    header("Location: ../public/html/ususario.html");
    exit();
}