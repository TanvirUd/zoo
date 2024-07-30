<?php
require_once('pdo_model.php');

class estHabiliteModel extends PdoModel
{
    /**
     * Retrieves all habilites from the estHabilite table.
     *
     * @return array Returns an array of associative arrays representing the habilites.
     * @throws Exception If there is an error executing the SQL query.
     */
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

    /**
     * Retrieves the habilites for a given personnel's matricule number.
     *
     * @param string $numMatriculePerso The matricule number of the personnel.
     * @return array An array of associative arrays representing the habilites.
     * @throws Exception If there is an error executing the SQL query.
     */
    public function getHabilitesByMatricule(string $numMatriculePerso) {
        try {
            $sqlQuery="SELECT EstHabilite.idAppli, EstHabilite.idRoleAppli, RoleApplicatif.mdpRoleAppli 
                        FROM EstHabilite INNER JOIN RoleApplicatif 
                        ON EstHabilite.idAppli = RoleApplicatif.idAppli 
                        AND EstHabilite.idRoleAppli = RoleApplicatif.idRoleAppli
                        WHERE EstHabilite.numMatriculePerso = :numMatriculePerso";
            $stmt = $this->_db->prepare($sqlQuery);
            $stmt->bindParam(':numMatriculePerso', $numMatriculePerso, PDO::PARAM_STR);
            $stmt->execute();

            //retourner tous les résultats
            return $stmt->fetchAll(PDO::FETCH_ASSOC);

        } catch (PDOException $e) {
            error_log($e->getMessage());
            throw new Exception("Une erreur s'est produite : ".$e->getMessage());
        }
    }

    public function getHabilitesByMatriculeAndIdAppli(string $numMatriculePerso, int $idAppli) {
        try {
            $sqlQuery="SELECT EstHabilite.idAppli, EstHabilite.idRoleAppli, RoleApplicatif.mdpRoleAppli 
                        FROM EstHabilite INNER JOIN RoleApplicatif 
                        ON EstHabilite.idAppli = RoleApplicatif.idAppli 
                        AND EstHabilite.idRoleAppli = RoleApplicatif.idRoleAppli
                        WHERE EstHabilite.numMatriculePerso = :numMatriculePerso AND EstHabilite.idAppli = :idAppli";
            $stmt = $this->_db->prepare($sqlQuery);
            $stmt->bindParam(':numMatriculePerso', $numMatriculePerso, PDO::PARAM_STR);
            $stmt->bindParam(':idAppli', $idAppli, PDO::PARAM_INT);
            $stmt->execute();

            //retourner tous les résultats
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log($e->getMessage());
            throw new Exception("Une erreur s'est produite : ".$e->getMessage());
        }
    }

    /**
     * Checks if a person with the given matriculation number has the specified application role.
     *
     * @param string $numMatriculePerso The matriculation number of the person.
     * @param int $idAppli The ID of the application.
     * @throws Exception If an error occurs while executing the SQL query.
     * @return bool Returns true if the person has the specified application role, false otherwise.
     */
    public function checkHabilitesByMatriculAndIdAppli(string $numMatriculePerso, int $idAppli) {
        try {
            $sqlQuery="SELECT idAppli, idRoleAppli FROM EstHabilite WHERE numMatriculePerso=:numMatriculePerso AND idAppli=:idAppli";
            $stmt = $this->_db->prepare($sqlQuery);
            $stmt->bindParam(':numMatriculePerso', $numMatriculePerso, PDO::PARAM_STR);
            $stmt->bindParam(':idAppli', $idAppli, PDO::PARAM_INT);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result != false;         
        } catch (PDOException $e) {
            error_log($e->getMessage());
            throw new Exception("Une erreur s'est produite : ".$e->getMessage());
        }
    }

    /**
     * Checks if a person with the given matriculation number is an admin.
     *
     * @param string $numMatriculePerso The matriculation number of the person.
     * @throws Exception If an error occurs while executing the SQL query.
     * @return bool Returns true if the person is an admin, false otherwise.
     */
    public function checkIfAdmin(string $numMatriculePerso) {
        try {
            $sqlQuery="SELECT idAppli FROM EstHabilite WHERE numMatriculePerso=:numMatriculePerso AND idRoleAppli='bdauthentification'";
            $stmt = $this->_db->prepare($sqlQuery);
            $stmt->bindParam(':numMatriculePerso', $numMatriculePerso, PDO::PARAM_STR);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result != false;         
        } catch (PDOException $e) {
            error_log($e->getMessage());
            throw new Exception("Une erreur s'est produite : ".$e->getMessage());
        }
    }

    public function checkHabilite(string $numMatriculePerso, int $idAppli){
        try {
            $sqlQuery="SELECT idAppli, idRoleAppli FROM EstHabilite WHERE numMatriculePerso=:numMatriculePerso AND idAppli=:idAppli";
            $stmt = $this->_db->prepare($sqlQuery);
            $stmt->bindParam(':numMatriculePerso', $numMatriculePerso, PDO::PARAM_STR);
            $stmt->bindParam(':idAppli', $idAppli, PDO::PARAM_INT);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result != false;         
        } catch (PDOException $e) {
            error_log($e->getMessage());
            throw new Exception("Une erreur s'est produite : ".$e->getMessage());
        }
    }

    /**
     * Updates the habilites for a person with the given matriculation number and application ID.
     *
     * @param string $numMatriculePerso The matriculation number of the person.
     * @param int $idAppli The ID of the application.
     * @param string $idRoleAppli The ID of the role to assign to the person.
     * @throws Exception If an error occurs while executing the SQL query.
     * @return array An array of associative arrays representing the updated habilites.
     */
    public function updateHabilitesPourPersonnel(string $numMatriculePerso, int $idAppli, string $idRoleAppli) {
        try {
            $sqlQuery="UPDATE EstHabilite SET idRoleAppli=:idRoleAppli WHERE numMatriculePerso=:numMatriculePerso AND idAppli=:idAppli";
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

    /**
     * Assigns habilites for a person with the given matriculation number, application ID, and role ID.
     *
     * @param string $numMatriculePerso The matriculation number of the person.
     * @param int $idAppli The ID of the application.
     * @param int $idRoleAppli The ID of the role to assign to the person.
     * @throws Exception If an error occurs while executing the SQL query.
     * @return bool Returns true if the habilites are successfully assigned, false otherwise.
     */
    public function assignHabilitesPourPersonnel($numMatriculePerso, $idAppli, $idRoleAppli)
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
    
    /**
     * Removes habilites for a person with the given matriculation number and application ID.
     *
     * @param string $numMatriculePerso The matriculation number of the person.
     * @param int $idAppli The ID of the application.
     * @throws PDOException If an error occurs while executing the SQL query.
     * @return bool Returns true if the habilites are successfully removed, false otherwise.
     */
    public function removeHabilitesPourPersonnel($numMatriculePerso, $idAppli) {
        $sql = "DELETE FROM EstHabilite WHERE numMatriculePerso = :numMatriculePerso AND idAppli = :idAppli";
        $stmt = $this->_db->prepare($sql);
        $stmt->bindParam(':numMatriculePerso', $numMatriculePerso, PDO::PARAM_STR);
        $stmt->bindParam(':idAppli', $idAppli, PDO::PARAM_INT);
        return $stmt->execute();
    }
}