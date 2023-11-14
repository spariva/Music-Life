<?php

class Db
{
    private static $instance; 
    private $conect;
    private const CONFIG_FILE = '../config/db.json';

    private function __construct()
    {
        // Cargar las configuraciones desde el archivo JSON en el constructor
        $this->loadConfig();

        try {
            // Utilizar las constantes en lugar de acceder a la configuración directamente
            $this->conect = new PDO(
                "mysql:host=" . $this->config['host'] . ";dbname=" . $this->config['db'] . ";charset=" . $this->config['charset'],
                $this->config['user'],
                $this->config['pass']
            );
            $this->conect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
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
        // Cargar configuración desde el archivo JSON
        $this->config = json_decode(file_get_contents(self::CONFIG_FILE), true);

        if ($this->config === null) {
            throw new JsonException("Error al cargar el archivo de configuración JSON.");
        }
    }


    public function cerrarConexion()
    {
        $this->conect = null;
    }

    public function lastInsertId()
    {
        return $this->conect->lastInsertId();
    }
    
    public function prepare($sql)
    {
        return $this->conect->prepare($sql);
    }
}