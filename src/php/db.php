<?php

class Db
{
    private static $instance; 
    private $databaseConnect;
    private const CONFIG_FILE = '../config/db.json';

    private function __construct()
    {
        // Cargar las configuraciones desde el archivo JSON en el constructor
        $this->loadConfig();

        try 
        {
            // Utilizar las constantes en lugar de acceder a la configuración directamente. De momento el host está en local.
            $this->databaseConnect = new PDO(
                "mysql:host=" . $this->config['host'] . ";database=" . $this->config['db'] . ";charset=" . $this->config['charset'],
                $this->config['username'],
                $this->config['password']
            );
            $this->databaseConnect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
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
        //! Cargar configuración desde el archivo JSON. No sería mejor ponerlo a capón?
        $this->config = json_decode(file_get_contents(self::CONFIG_FILE), true);

        if ($this->config === null) {
            throw new JsonException("Error al cargar el archivo de configuración JSON.");
        }
    }


    public function closeConnection()
    {
        $this->databaseConnect = null;
    }
    
    public function prepare($sql)
    {
        return $this->databaseConnect->prepare($sql);
    }
}