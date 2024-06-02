<?php

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

    public function showUserRatings($userName, $url){
        $consulta = $this->db->prepare("SELECT * FROM rating WHERE USER_NAME = :USERNAME AND LINK = :URL");
        $consulta->bindParam(":USERNAME", $userName, PDO::PARAM_STR);
        $consulta->bindParam(":URL", $url, PDO::PARAM_STR);
        $consulta->execute();
        $rating = $consulta->fetch(PDO::FETCH_ASSOC);
        return $rating;
    }

    public function showUserRatingsRandom($userName, $limit){
        $consulta = $this->db->prepare("SELECT * FROM rating WHERE USER_NAME = :USERNAME ORDER BY RAND() LIMIT $limit");
        $consulta->bindParam(":USERNAME", $userName, PDO::PARAM_STR);
        $consulta->execute();
        $ratings = $consulta->fetchAll(PDO::FETCH_ASSOC);
        return $ratings;
    }

    public function showUserRatingsAllRandom($limit){
        $consulta = $this->db->prepare("SELECT * FROM rating ORDER BY RAND() LIMIT :limit");
        $consulta->bindParam(":limit", $limit, PDO::PARAM_INT);
        $consulta->execute();
        $ratings = $consulta->fetchAll(PDO::FETCH_ASSOC);
        return $ratings;
    }

    public function showUserPlaylistRatings($username, $limit){
        $consulta = $this->db->prepare("SELECT r.* FROM rating r INNER JOIN playlist p ON r.LINK = p.LINK WHERE p.USER_NAME = :username ORDER BY RAND() LIMIT :limit");
        $consulta->bindParam(":username", $username, PDO::PARAM_STR);
        $consulta->bindParam(":limit", $limit, PDO::PARAM_INT);
        $consulta->execute();
        $ratings = $consulta->fetchAll(PDO::FETCH_ASSOC);
        return $ratings;
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

    // public function saveTokensToDatabase($accessToken, $refreshToken)
    // {
    //     $consulta = $this->db->prepare("INSERT INTO tokens (access_token, refresh_token) VALUES (:accessToken, :refreshToken)");
    //     $consulta->bindParam(":accessToken", $accessToken, PDO::PARAM_STR);
    //     $consulta->bindParam(":refreshToken", $refreshToken, PDO::PARAM_STR);
    //     $consulta->execute();
    // }

    function saveTokensToDatabase($userName, $accessToken, $refreshToken) {
        $consulta = $this->db->prepare('
            INSERT INTO user_tokens (USER_NAME, ACCESS_TOKEN, REFRESH_TOKEN)
            VALUES (?, ?, ?)
            ON DUPLICATE KEY UPDATE
                ACCESS_TOKEN = VALUES(ACCESS_TOKEN),
                REFRESH_TOKEN = VALUES(REFRESH_TOKEN)
        ');
        $consulta->execute([$userName, $accessToken, $refreshToken]);
    }

    function getApiTokens($userName) {
        $consulta = $this->db->prepare('
            SELECT ACCESS_TOKEN, REFRESH_TOKEN
            FROM user_tokens
            WHERE USER_NAME = ?
        ');
        $consulta->execute([$userName]);
        return $consulta->fetch(PDO::FETCH_ASSOC);
    }
    
    //Este método no va en DbConnection:
    function refreshAccessToken($refreshToken) {
        global $clientId, $clientSecret;
    
        $auth = base64_encode($clientId . ':' . $clientSecret);
        $url = 'https://accounts.spotify.com/api/token';
    
        $data = [
            'grant_type' => 'refresh_token',
            'refresh_token' => $refreshToken,
        ];
    
        $options = [
            'http' => [
                'header' => "Content-type: application/x-www-form-urlencoded\r\n" .
                            "Authorization: Basic $auth\r\n",
                'method' => 'POST',
                'content' => http_build_query($data),
            ],
        ];
    
        $context = stream_context_create($options);
        $result = file_get_contents($url, false, $context);
    
        if ($result === FALSE) {
            // Manejar error
            return false;
        }
    
        $response = json_decode($result, true);
    
        if (isset($response['access_token'])) {
            $accessToken = $response['access_token'];
            $newRefreshToken = $response['refresh_token'] ?? $refreshToken;
    
            //$mdb = DB::getInstance()->saveTokensToDatabase($userName, $accessToken, $newRefreshToken);
    
            return $accessToken;
        }
    
        return false;
    }

}
