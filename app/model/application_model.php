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

    
}