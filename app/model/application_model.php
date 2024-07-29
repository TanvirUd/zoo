<?php
require_once("pdo_model.php");

class ApplicationModel extends PDOModel
{
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