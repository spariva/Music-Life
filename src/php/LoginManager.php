<?php
// include_once '../config/init.php';
include_once './Sanitizer.php';
class LoginManager{
    public $errors = [];
    public $userName;
    public $userPassword;

    public function __construct($username, $userpassword)
    {
        $this->errors = [];
        $this->userName = $username;
        $this->userPassword = $userpassword;
    }

    public function sanitizeLoginManager(): void
    {
        $this->userName = Sanitizer::sanitizeString($this->userName);
        $this->userPassword = Sanitizer::sanitizeString($this->userPassword);
    }

    public function validateLoginManager($db): bool{
        $this->validateData();

        if (!$this->checkUserNameExists($db)) {
            return false;
        }

        if (!$this->checkPassword($db)) {
            return false;
        }

        if (count($this->errors) > 0) {
            return false;
        }

        return true;
    }

    public function validateData(): void
    {
        if (empty($this->userName)) {
            $this->errors['userName'] = 'El nombre de usuario es requerido.';
        }

        if (empty($this->userPassword)) {
            $this->errors['userPassword'] = 'La contraseña es requerida.';
        }
    }

    public function checkUserNameExists($db): bool
    {
        $sql = "SELECT * FROM user WHERE name = :name LIMIT 1";
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':name', $this->userName, PDO::PARAM_STR);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            return true;
        }
        $this->errors['userName'] = 'Nadie se ha registrado con ese nombre.';
        return false;
    }
 
    public function checkPassword($db)
    {
        $sql = "SELECT password FROM user WHERE name = :name LIMIT 1"; //Diria de cambiar el name por email q es mas dificil q se repita
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':name', $this->userName, PDO::PARAM_STR);
        $stmt->execute();
        $userPwd = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$userPwd) {
            $this->errors['userPassword'] = 'User inexistente.';
            return false;
        }

        $hashedPassword = $userPwd['password'];
        if (!password_verify($this->userPassword, $hashedPassword)) {
            $this->errors['userPassword'] = ' La contraseña no es válida.';

            return false;
        }

        // if($userPwd['password'] != $this->userPassword){
        //     $this->errors['userPassword'] = 'La contraseña no es válida.';
        //     return false;
        // }

        return true;
    }
}

