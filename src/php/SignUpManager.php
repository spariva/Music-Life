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

    public function validateSignUpManager($db): bool
    {
        if (!$this->validateData()) {
            return false;
        }

        if (count($this->errors) > 0) {
            return false;
        }

        if ($this->checkMailExist($db)) {
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

        if (empty($this->userMail)) {
            $this->errors['userMail'] = 'El correo electrónico es requerido.';
            return false;
        }

        if (!filter_var($this->userMail, FILTER_VALIDATE_EMAIL)) {
            $this->errors['userMail'] = 'El email no es válido.';
            return false;
        }

        if (empty($this->userPassword) || strlen($this->userPassword) < 2) {
            $this->errors['userPassword'] = 'La contraseña es requerida y mayor a 2 carácteres.';
            return false;
        }

        if ($this->userPassword != $_POST['confirmPassword']) {
            $this->errors['confirmPassword'] = 'Las contraseñas no coinciden.';
            return false;
        }

        return true;
    }

    public function checkMailExist($db): bool
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
        $this->userPassword = password_hash($this->userPassword, PASSWORD_DEFAULT);
        $sql = "INSERT INTO USER (NAME, EMAIL, PASSWORD) VALUES (:NAME, :EMAIL, :PASSWORD)";
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':NAME', $this->userName, PDO::PARAM_STR);
        $stmt->bindValue(':EMAIL', $this->userMail, PDO::PARAM_STR);
        $stmt->bindValue(':PASSWORD', $this->userPassword, PDO::PARAM_STR);
        $stmt->execute();
    }
}

