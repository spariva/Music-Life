<?php
include_once '../config/init.php';
class LoginManager{
    public $errors = [];
    public $email;
    private $password;

    public function __construct($datos){
        $this->errors = [];
        $this->email = Sanitizer::sanitizeEmail($datos['email'], $this->errors['email']);
        $this->password = Sanitizer::sanitizeString($datos['password'], $this->errors['password']);
    }

    //user exist ();
    //user is valid();
    public function validateLogin(): bool{
        $db = Db::getInstance();
        $sql = "SELECT * FROM usuarios WHERE email = :email LIMIT 1";
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':email', $this->email, PDO::PARAM_STR);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        $db->closeConnection();

        //user no exite:
        if ($user === false) {
            $this->errors['email'] = 'El email no es valido.';
            return false;
        }

        if (!password_verify($this->getPassword(), $user['password'])) {
            $this->errors['password'] = 'La contraseña no es correcta.';
            return false;
        }

        return true;

    }

    public function getPassword(): string{
        return $this->password;
    }

}

