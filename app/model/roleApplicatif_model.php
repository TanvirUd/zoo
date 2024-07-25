<?php
require_once("../app/model/pdo_model.php");
class RoleApplicatifModel extends PdoModel
{
    public function getAll() {
        $sql = "SELECT * FROM RoleApplicatif";
        $result = $this->_db->prepare($sql);
        $result->execute();
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }

    public function createRoleApplicatif($id, $roleAppli, $mdp) {
        $idAppli = $id; // en référence à idAppli de Application
        $idRoleAppli = $roleAppli;
        $mdpRoleAppli = $mdp;

        try{
            $sql = "INSERT INTO RoleApplicatif(idRoleAppli, mdpRoleAppli) 
            VALUES (:idRoleAppli, :mdpRoleAppli);";
            $result = $this->_db->prepare($sql);
            $result->bindParam(":idAppli", $idAppli, PDO::PARAM_INT);
            $result->bindParam(":idRoleAppli", $idRoleAppli, PDO::PARAM_STR);
            $result->bindParam(":mdpRoleAppli", $mdpRoleAppli, PDO::PARAM_STR);
            return $result->execute();
        } catch (PDOException $e){
            die('Erreur : '. $e->getMessage());
        }
    }
}