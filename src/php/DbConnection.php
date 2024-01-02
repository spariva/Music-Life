<?php

class DbConnection
{
    private static $instance; 
    private $db;
    private const CONFIG_FILE = '../config/db.json';
    private $config;

    private function __construct()
    {
        // Cargar las configuraciones desde el archivo JSON en el constructor
        $this->config = $this->loadConfig();

        try 
        {
            $this->db = new PDO(
                "mysql:host=" . $this->config['host'] . ";db=" . $this->config['db'] . ";charset=" . $this->config['charset'],
                $this->config['username'],
                $this->config['password']
            );
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            throw new Exception("Error de conexión: " . $e->getMessage());
        }
    }

    // Método estático para obtener la instancia de la clase
    public static function getInstance()
    {
        if (!self::$instance) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    private function loadConfig()
    {
        if (file_exists(self::CONFIG_FILE)) {
            $this->config = json_decode(file_get_contents(self::CONFIG_FILE), true);
        } else {
            throw new JsonException("Error loading the JSON configuration file.");
        }
        return $this->config;
    }


    public function closeConnection()
    {
        $this->db = null;
    }
    
    public function prepare($sql)
    {
        return $this->db->prepare($sql);
    }

    public function getUsernameById($userId) {
        $consulta = $this->db->prepare("SELECT NOMBRE FROM USUARIO WHERE ID = userId LIMIT 1");
            
        $consulta->bindParam(":userId", $userId, PDO::PARAM_INT);

        $consulta->execute();
        $data = $consulta->fetch(PDO::FETCH_NUM);
        return $data[0];
    }

    public function checkUserExists($userName){
        $consulta = $this->db->prepare("SELECT NombreUsuario FROM Usuario WHERE NombreUsuario=:userName");
        $consulta->bindParam(":userName", $userName, PDO::PARAM_STR);
        $consulta->execute();
        $usuario = $consulta->fetch(PDO::FETCH_NUM);
        return $usuario;
    }

    public function checkMailExists($mail){
        $consulta = $this->db->prepare("SELECT email FROM Usuario WHERE email=:email LIMIT 1");
        $consulta->bindParam(":email", $mail, PDO::PARAM_STR);
        $consulta->execute();
        $email = $consulta->fetch(PDO::FETCH_NUM);
        return $email;
    }

    public function obtenerContraDeUsuario($userName){
        $consulta = $this->db->prepare("SELECT Contrasena FROM Usuario WHERE Nombre=:userName");
        $consulta->bindParam(":userName", $userName, PDO::PARAM_STR);
        $consulta->execute();
        $userPwd = $consulta->fetch(PDO::FETCH_NUM);
        return $userPwd;
    }
}