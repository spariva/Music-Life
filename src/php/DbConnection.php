<?php

class DbConnection
{
    private static $instance;
    private $db;
    private const CONFIG_FILE = '../../config/db.json';
    private $config;

    private function __construct()
    {
        // Cargar las configuraciones desde el archivo JSON en el constructor
        $this->config = $this->loadConfig();

        try {
            $dsn = "{$this->config['dialect']}:host={$this->config['host']};dbname={$this->config['database']};charset={$this->config['charset']}";
            $options = [
                PDO::ATTR_EMULATE_PREPARES => false, // Para evitar inyección de SQL, usar siempre prepare()
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, // Para manejar errores
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC // Para traer los datos como array asociativo
            ];
            $this->db = new PDO($dsn, $this->config['username'], $this->config['password'], $options);
        } catch (PDOException $e) {
            throw new Exception("Error de conexión: " . $e->getMessage());
        }
    }

    // Método estático para obtener la instancia de la clase
    public static function getInstance()
    {
        if (!isset(self::$instance)) {
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

    public function getConnection()
    {
        return $this->db;
    }

    public function closeConnection()
    {
        $this->db = null;
    }

    public function getUsernameById($userId)
    {
        $consulta = $this->db->prepare("SELECT NAME FROM USUARIO WHERE ID = userId LIMIT 1");

        $consulta->bindParam(":userId", $userId, PDO::PARAM_INT);

        $consulta->execute();
        $data = $consulta->fetch(PDO::FETCH_NUM);
        return $data[0];
    }

    public function getUserPassword($userName)
    {
        $consulta = $this->db->prepare("SELECT PASSWORD FROM USER WHERE Nombre=:userName");
        $consulta->bindParam(":userName", $userName, PDO::PARAM_STR);
        $consulta->execute();
        $userPwd = $consulta->fetch(PDO::FETCH_NUM);
        return $userPwd;
    }
}
