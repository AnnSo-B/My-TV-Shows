<?php

namespace App\Utils;

use PDO;

/**
 * class allowing connection to the database through PDO
 */
class Database {
    /**
     * PDO Object = DB connection
     * 
     * @var PDO
     */
    private $dbh;
    /**
     * Sole instance of the object
     * 
     * @var Database
     */
    private static $_instance;

    private function __construct() {
        // Get data from config file
        $configData = parse_ini_file(__DIR__.'/../config.ini');
        
        // Attempt of instanciation of the dbh object using the data stored in $configData
        try {
            $this->dbh = new PDO(
                "mysql:host={$configData['DB_HOST']};dbname={$configData['DB_NAME']};charset=utf8",
                $configData['DB_USERNAME'],
                $configData['DB_PASSWORD'],
                array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING) // Affiche les erreurs SQL à l'écran
            );
        }
        // In the event of an exception, display an error message
        catch(\Exception $exception) {
            echo 'Erreur de connexion : <br>';
            echo $exception->getMessage().'<br>';
            echo '<pre>';
            echo $exception->getTraceAsString();
            echo '</pre>';
            exit;
        }
    }

    /**
     * Method to return the dbh property of the PDO object
     *
     * @return PDO
     */
    public static function getPDO() {
        // if the only instance of the class does not exist
        if (empty(self::$_instance)) {
            // then we instantiate it and store it in the property $_instance
            self::$_instance = new Database();
        }
        // Otherwise, we don't do anything

        // We return the dbh property of our only instance
        return self::$_instance->dbh;
    }
}