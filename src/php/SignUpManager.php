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
        $db = Db::getInstance();
        $sql = "SELECT * FROM usuarios WHERE email = :email LIMIT 1";
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':email', $this->userMail, PDO::PARAM_STR);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        $db->closeConnection();

        //user no exite:
        if ($user !== false) {
            $this->errors['email'] = 'El email ya está registrado.';
            return false;
        }

        return true;

    }

    public function getPassword(): string{
        return $this->userPassword;
    }


}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
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
    if (empty($userPassword) || strlen($userPassword) < 8) {
        echo "La contraseña es requerida y mayor a 8 carácteres.";
    }

    // Hacemos uso del singleton para obtener una instancia de la base de datos
    $db = Db::getInstance();

    $sql = "INSERT INTO usuarios (nombre, email, contrasena) VALUES (:userName, :userMail, :userPassword)";
    $stmt = $db->prepare($sql);
    
    $stmt->bindValue(':nombre', $userName, PDO::PARAM_STR);
    $stmt->bindValue(':email', $userMail, PDO::PARAM_STR);
    $stmt->bindValue(':nombre', $userPassword, PDO::PARAM_STR);

    $stmt->execute();

    $db->closeConnection();

    header("Location: ../../public/usuario.html"); //cambiar el doc root a que sea public
    exit();
}