<?php

include_once '../config/init.php';
include_once './Sanitizer.php';
class LoginManager{
    public $errors = [];
    public $userName;
    private $userPassword;

    public function __construct($username, $userpassword)
    {
        $this->errors = [];
        $this->userName = $username;
        $this->userPassword = $userpassword;
    }

    public function sanitizeLoginManager(): void
    {
        $this->userName = Sanitizer::sanitizeString($this->userName);
        $this->password = Sanitizer::sanitizeString($this->userPassword);
    }

    public function validateLogin($db): bool{
        if (!$this->validateData()) {
            return false;
        }

        if (count($this->errors) > 0) {
            return false;
        }

        if (!$this->checkUserExists($db)) {
            return false;
        }

        if (!$this->checkPassword($db)) {
            return false;
        }

        return true;
    }

    public function validateData(): bool
    {
        if (empty($this->userName)) {
            $this->errors['userName'] = 'El nombre de usuario es requerido.';
            return false;
        }

        if (empty($this->userPassword)) {
            $this->errors['userPassword'] = 'La contraseña es requerida.';
            return false;
        }

        return true;
    }

    public function checkUserExists($db)
    {
        $sql = "SELECT * FROM user WHERE name = :name LIMIT 1";
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':name', $this->userName, PDO::PARAM_STR);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        //user no exite:
        if ($user === false) {
            $this->errors['userName'] = 'El nombre no es valido.';
            return false;
        }
        return $user;
    }
 
    public function checkPassword($db)
    {
        $sql = "SELECT password FROM user WHERE name = :name LIMIT 1";
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':name', $this->userName, PDO::PARAM_STR);
        $stmt->execute();
        $userPwd = $stmt->fetch(PDO::FETCH_NUM);
        //user no exite:
        if ($userPwd === false) {
            $this->errors['userPassword'] = 'La contraseña no es valida.';
            return false;
        }
        //user existe pero la contraseña no es correcta:
        if (!password_verify($this->userPassword, $userPwd[0])) {
            $this->errors['userPassword'] = 'La contraseña no es valida.';
            return false;
        }
        return true;
    }

    public function getPassword(): string{
        return $this->userPassword;
    }
}

