<?php

//require_once __DIR__ . '/vendor/autoload.php'; // Path may vary based on your project structure

//$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
//$dotenv->load();

// $dbHost = $_ENV['DB_HOST'];
// $dbUsername = $_ENV['DB_USERNAME'];
// $dbPassword = $_ENV['DB_PASSWORD'];
// $dbDatabase = $_ENV['DB_DATABASE'];
// $dbDialect = $_ENV['DB_DIALECT'];
// $dbSeederStorage = $_ENV['DB_SEEDER_STORAGE'];
// $dbCharset = $_ENV['DB_CHARSET'];

class DbConnection
{
    private static $instance;
    private $db;
    private const CONFIG_FILE = DOC_ROOT.'/config/db.json';
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

    public function getRandomUrls($limit, $userName){
        $limit = (int)$limit; // Asegurarse de que el límite es un entero
        $consulta = $this->db->prepare("SELECT LINK FROM playlist WHERE USER_NAME = :USERNAME ORDER BY RAND() LIMIT $limit");
        $consulta->bindParam(":USERNAME", $userName, PDO::PARAM_STR);
        $consulta->execute();
        $urls = $consulta->fetchAll(PDO::FETCH_COLUMN);
        return $urls;
    }

    public function showAllPlaylists(){
        $consulta = $this->db->prepare("SELECT LINK FROM playlist");
        $consulta->execute();
        $urls = $consulta->fetchAll(PDO::FETCH_COLUMN);
        return $urls;
    }

    public function showUserPlaylists($userName){
        $consulta = $this->db->prepare("SELECT LINK FROM playlist WHERE USER_NAME = :USERNAME");
        $consulta->bindParam(":USERNAME", $userName, PDO::PARAM_STR);
        $consulta->execute();
        $urls = $consulta->fetchAll(PDO::FETCH_COLUMN);
        return $urls;
    }

    public function showUserPlaylistsRandom($userName, $limit){
        $consulta = $this->db->prepare("SELECT LINK FROM playlist WHERE USER_NAME = :USERNAME ORDER BY RAND() LIMIT $limit");
        $consulta->bindParam(":USERNAME", $userName, PDO::PARAM_STR);
        $consulta->execute();
        $urls = $consulta->fetchAll(PDO::FETCH_COLUMN);
        return $urls;
    }

    public function showAllPlaylistsRandom($limit){
        $consulta = $this->db->prepare("SELECT LINK FROM playlist ORDER BY RAND() LIMIT $limit");
        $consulta->execute();
        $urls = $consulta->fetchAll(PDO::FETCH_COLUMN);
        return $urls;
    }

    public function showUserRatings($userName, $limit){
        $consulta = $this->db->prepare("SELECT * FROM rating WHERE USER_NAME = :USERNAME ORDER BY RAND() LIMIT $limit");
        $consulta->bindParam(":USERNAME", $userName, PDO::PARAM_STR);
        $consulta->execute();
        $ratings = $consulta->fetchAll(PDO::FETCH_COLUMN);
        return $ratings;
    }

}
