<?php 

class SignUpManager{
    public $errors = [];
    public $userName;
    public $userMail;
    private $userPassword;

    public function __construct($datos){
        $this->errors = [];
        $this->userName = Sanitizer::sanitizeString($datos['userName']);
        $this->userMail = Sanitizer::sanitizeEmail($datos['userMail'], $this->errors['userMail']);
        $this->userPassword = Sanitizer::sanitizeString($datos['userPassword']);
    }

    public function validateSignUp(): bool{
        $db = DbConnection::getInstance();
        $sql = "SELECT * FROM usuarios WHERE email = :email LIMIT 1";
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':email', $this->userMail, PDO::PARAM_STR);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        $db->closeConnection();

        //user no exite:
        if ($user != false) {
            $this->errors['email'] = 'El email ya está registrado.';
            return false;
        }
        return true;
    }

    public function getPassword(): string{
        return $this->userPassword;
    }

    public function saveUser(){
        $db = DbConnection::getInstance();
        $sql = "INSERT INTO usuarios (nombre, email, contrasena) VALUES (:userName, :userMail, :userPassword)";
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':nombre', $this->userName, PDO::PARAM_STR);
        $stmt->bindValue(':email', $this->userMail, PDO::PARAM_STR);
        $stmt->bindValue(':contrasena', $this->userPassword, PDO::PARAM_STR);
        $stmt->execute();
        $db->closeConnection();
    }
}