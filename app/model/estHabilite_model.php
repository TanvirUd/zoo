<?php
require_once('pdo_model.php');

class estHabiliteModel extends PdoModel
{
    public function getHabilitesById(string $numMatriculePerso) {
        try {
            $sqlQuery="";
            $stmt = $this->_db->prepare($sqlQuery);
            $stmt->bindParam();
            $stmt->execute();

            //retourner tous les résultats
            return $stmt->fetchAll(PDO::FETCH_ASSOC);

        } catch (PDOException $e) {
            error_log($e->getMessage());
            throw new Exception("Une erreur s'est produite");
        }
    }
}