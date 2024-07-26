<?php
require_once('pdo_model.php');

class estHabiliteModel extends PdoModel
{
    public function getAllHabilites() {
        try {
            $sqlQuery="SELECT * FROM estHabilite";
            $stmt = $this->_db->prepare($sqlQuery);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log($e->getMessage());
            throw new Exception("Une erreur s'est produite");
        }
    }

    public function getHabilitesByMatricule(string $numMatriculePerso) {
        try {
            $sqlQuery="SELECT estHabilite.idAppli, estHabilite.idRoleAppli, roleApplicatif.mdpRoleAppli 
                        FROM EstHabilite INNER JOIN roleApplicatif 
                        ON estHabilite.idAppli = roleApplicatif.idAppli 
                        AND estHabilite.idRoleAppli = roleApplicatif.idRoleAppli
                        WHERE estHabilite.numMatriculePerso=:numMatriculePerso";
            $stmt = $this->_db->prepare($sqlQuery);
            $stmt->bindParam(':numMatriculePerso', $numMatriculePerso, PDO::PARAM_STR);
            $stmt->execute();

            //retourner tous les résultats
            return $stmt->fetchAll(PDO::FETCH_ASSOC);

        } catch (PDOException $e) {
            error_log($e->getMessage());
            throw new Exception("Une erreur s'est produite");
        }
    }

    public function updateHabilitesPourPersonnel(string $numMatriculePerso) {
        try {
            $sqlQuery="UPDATE estHabilite SET (numMatriculePerso, idAppli, idRoleAppli)
            VALUES(:numMatriculePerso, :idAppli, :idRoleAppli)";
            $stmt = $this->_db->prepare($sqlQuery);
            $stmt->bindParam(':numMatriculePerso', $numMatriculePerso, PDO::PARAM_STR);
            $stmt->bindParam(':idAppli', $idAppli, PDO::PARAM_INT);
            $stmt->bindParam(':idRoleAppli', $idRoleAppli, PDO::PARAM_INT);
            $stmt->execute();

            //retourner tous les résultats
            return $stmt->fetchAll(PDO::FETCH_ASSOC);

        } catch (PDOException $e) {
            error_log($e->getMessage());
            throw new Exception("Une erreur s'est produite");
        }
    }

    public function assignHabilitesPourPersonnel($numMatriculePerso, $idRole)
    {
        try {
            $sql = "INSERT INTO EstHabilite (numMatriculePerso, idAppli, idRoleAppli) VALUES(:numMatriculePerso, :idAppli, :idRoleAppli)";
            $stmt = $this->_db->prepare($sql);
            $stmt->bindParam(':numMatriculePerso', $numMatriculePerso, PDO::PARAM_STR);
            $stmt->bindParam(':idAppli', $idAppli, PDO::PARAM_INT);
            $stmt->bindParam(':idRoleAppli', $idRoleAppli, PDO::PARAM_INT);
            return $stmt->execute();
        } catch (PDOException $e) {
            die('Erreur : ' . $e->getMessage());
        }
    }
    public function removeHabilitesPourPersonnel($numMatriculePerso, $idAppli) {
        $sql = "DELETE FROM EstHabilite WHERE numMatriculePerso = :numMatriculePerso AND idAppli = :idAppli";
        $stmt = $this->_db->prepare($sql);
        $stmt->bindParam(':numMatriculePerso', $numMatriculePerso, PDO::PARAM_STR);
        $stmt->bindParam(':idAppli', $idAppli, PDO::PARAM_INT);
        return $stmt->execute();
    }
}