<?php
// include_once '../config/init.php';
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
        //gettype($userPwd);
        // $userPwd = $stmt->fetch(PDO::FETCH_NUM);
        //user no exite:
        if ($userPwd === false) {
            $this->errors['userPassword'] = 'User inexistente.';
            return false;
        }
        //user existe pero la contraseña no es correcta: el [0] es porque devuelve un array de un solo elemento, y queremos comparar con string, no array
        // if (!password_verify($this->userPassword, $userPwd['0'])) {
        //     $this->errors['userPassword'] = 'La contraseña no es válida.';
        //     return false;
        // }
        if (!password_verify($this->userPassword, $userPwd['password'])) {
            $pwdInput = gettype($this->userPassword);
            $pwdBasedatos = gettype($userPwd['password']);
            $this->errors['userPassword'] = $pwdInput . ' ' . $pwdBasedatos . ' La contraseña no es válida.';
            return false;
            //son strings ambas... y uso password_verify, y password_hash para guardar en la base de datos
            //PERO si pongo 'PASSWORD' el tipo se vuelve null?????
            //y con array num ambas strings pero no funciona tampoco
        }
        return true;
    }

    public function getPassword(): string{
        return $this->userPassword;
    }
}

