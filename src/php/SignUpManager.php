<?php
include_once './Sanitizer.php';
include_once './DbConnection.php';
class SignUpManager
{
    public $errors = [];
    public $userName;
    public $userMail;
    private $userPassword;

    public function __construct($username, $usermail, $userpassword)
    {
        $this->errors = [];
        $this->userName = $username;
        $this->userMail = $usermail;
        $this->userPassword = $userpassword;
    }

    public function sanitizeSignUpManager(): void
    {
        $this->userName = Sanitizer::sanitizeString($this->userName);
        $this->userMail = Sanitizer::sanitizeEmail($this->userMail);
        $this->userPassword = Sanitizer::sanitizeString($this->userPassword);
    }

    //function to validate the user inputs, name, email and password. The password must be the same as the confirmation password, and at least 2 characters long. 
    public function validateSignUpManager(): bool
    {
        if (empty($this->userName)) {
            $this->errors['userName'] = 'El nombre de usuario es requerido.';
        }

        if (empty($this->userMail)) {
            $this->errors['userMail'] = 'El correo electrónico es requerido.';
        } else if (!filter_var($this->userMail, FILTER_VALIDATE_EMAIL)) {
            $this->errors['userMail'] = 'El email no es válido.';
        }


        if (empty($this->userPassword) || strlen($this->userPassword) < 2) {
            $this->errors['userPassword'] = 'La contraseña es requerida y mayor a 2 carácteres.';
        }

        //check if the password is the same as the confirmation password
        if ($this->userPassword != $_POST['confirmPassword']) {
            $this->errors['confirmPassword'] = 'Las contraseñas no coinciden.';
        }
        if (count($this->errors) > 0) {
            return false;
        }
        return true;
    }

    public function checkEmailExist($db): bool
    {
        $sql = "SELECT * FROM USER WHERE EMAIL = :EMAIL LIMIT 1";
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':EMAIL', $this->userMail, PDO::PARAM_STR);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            $this->errors['userMail'] = 'El email ya está registrado.';
            return true;
        }
        return false;
    }

    public function getPassword(): string
    {
        return $this->userPassword;
    }

    public function saveUser($db)
    {
        $sql = "INSERT INTO USER (NAME, EMAIL, PASSWORD) VALUES (:NAME, :EMAIL, :PASSWORD)";
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':NAME', $this->userName, PDO::PARAM_STR);
        $stmt->bindValue(':EMAIL', $this->userMail, PDO::PARAM_STR);
        $stmt->bindValue(':PASSWORD', $this->userPassword, PDO::PARAM_STR);
        $stmt->execute();
    }
}