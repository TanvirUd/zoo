<?php

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ ."/../..");
$dotenv->load();

class PdoModel{
    
    protected PDO $_db;
    protected PDO $_dbApp;

    /**
     * Constructs a new instance of the class and establishes a connection to the database.
     *
     * @throws PDOException If there is an error with the database connection.
     */
    public function __construct(){
        try {
            $options = [
                // utiliser des exceptions pour gérer les erreurs
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                // utiliser uniquement des tableau associatifs
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                // laisser mysql gérer les requêtes préparées
                PDO::ATTR_EMULATE_PREPARES => false
            ];

            $this->_db = new PDO('mysql:host=' . $_ENV['DBHOST'] . ';dbname=' . $_ENV['DBNAME'] . ';charset=utf8mb4', $_ENV['DBUSER'], $_ENV['DBPASS'], $options);
        } catch (PDOException $exception) {
            // If there is an error with the connection, stop the script and display the error.
            exit('<br><b>Erreur de connexion à la base de données : ' . $exception->getMessage() . '</b>');
        }
    }

    public function appUser($id, $mdp, $appli){
        try {
            $options = [
                // utiliser des exceptions pour gérer les erreurs
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                // utiliser uniquement des tableau associatifs
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                // laisser mysql gérer les requêtes préparées
                PDO::ATTR_EMULATE_PREPARES => false
            ];

            $this->_dbApp = new PDO('mysql:host=' . $_ENV['DBHOST'] . ';dbname=' . $appli . ';charset=utf8mb4', $id, $mdp, $options);
        } catch (PDOException $exception) {
            // If there is an error with the connection, stop the script and display the error.
            throw new Exception('Erreur de connexion à la base de données : ' . $exception->getMessage() );
        }

    }
}