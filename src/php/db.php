<?php

class Db
{
    private static $instance; 
    private $db;
    private const CONFIG_FILE = '../config/db.json';

    private function __construct()
    {
        // Cargar las configuraciones desde el archivo JSON en el constructor
        $this->config = $this->loadConfig();

        try 
        {
            // Utilizar las constantes en lugar de acceder a la configuración directamente. De momento el host está en local.
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
        return $this->config = json_decode(file_get_contents(self::CONFIG_FILE), true);

        if ($this->config === null) {
            throw new JsonException("Error al cargar el archivo de configuración JSON.");
        }
    }


    public function closeConnection()
    {
        $this->db = null;
    }
    
    public function prepare($sql)
    {
        return $this->db->prepare($sql);
    }
}