<?php
require_once("pdo_model.php");

class ApplicationModel extends PDOModel
{
    /**
     * Retrieves an application from the database based on its ID.
     *
     * @param int $idAppli The ID of the application to retrieve.
     * @throws PDOException If there is an error executing the SQL query.
     * @return mixed The fetched application data as an associative array, or false if no matching application is found.
     */
    public function getApplicationById($idAppli)
    {
        try {
            $sql = "SELECT * FROM Application WHERE idAppli = :idAppli";
            $stmt = $this->_db->prepare($sql);
            $stmt->bindParam(':idAppli', $idAppli, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetch();
        } catch (PDOException $e) {
            die('Erreur : ' . $e->getMessage());
        }
    }

    /**
     * Retrieves an application from the database based on its database name.
     *
     * @param string $nomDb The name of the database to search for.
     * @throws PDOException If there is an error executing the SQL query.
     * @return mixed The fetched application data as an associative array, or false if no matching application is found.
     */
    public function getApplicationByNameDb($nomDb){
        try {
            $sql = "SELECT * FROM Application WHERE dbAppli = :dbAppli";
            $stmt = $this->_db->prepare($sql);
            $stmt->bindParam(':dbAppli', $nomDb, PDO::PARAM_STR);
            $stmt->execute();
            return $stmt->fetch();
        } catch (PDOException $e) {
            die('Erreur : ' . $e->getMessage());
        }
    }
  
    /**
     * Retrieves all applications from the database.
     *
     * @return array An array of application data fetched from the database.
     * @throws PDOException If there is an error executing the SQL query.
     */
    public function getAllApplication()
    {
        try {
            $sql = "SELECT * FROM Application";
            $stmt = $this->_db->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (PDOException $e) {
            die('Erreur : ' . $e->getMessage());
        }
    }

    /**
     * Creates a new application in the database.
     *
     * @param string $nomAppli The name of the application.
     * @param string $dbAppli The database name of the application.
     * @throws PDOException If there is an error executing the SQL query.
     * @return void
     */
    public function createApplication($nomAppli, $dbAppli)
    {
        try {
            $sql = "INSERT INTO Application (nomAppli, dbAppli) VALUES (:nomAppli, :dbAppli)";
            $stmt = $this->_db->prepare($sql);
            $stmt->bindParam(':nomAppli', $nomAppli, PDO::PARAM_STR);
            $stmt->bindParam(':dbAppli', $dbAppli, PDO::PARAM_STR);
            $stmt->execute();
        } catch (PDOException $e) {
            die('Erreur : ' . $e->getMessage());
        }
    }
    
}