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

    public function getRolesByAppliId($idAppli) {
        try{
            $sql = "SELECT * FROM RoleApplicatif WHERE idAppli=:idAppli";
            $result = $this->_db->prepare($sql);
            $result->bindParam(":idAppli", $idAppli, PDO::PARAM_INT);
            $result->execute();
            $role = $result->fetchAll();
            return $role;
        } catch (PDOException $e){
            die('Erreur : '. $e->getMessage());
        }
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

    public function updateRoleApplicatif($idAppli) {
        $roleAppli = $_POST['']??""; //insérer contenu form
        $mdpRoleAppli = $_POST['']??""; //insérer contenu form
        $flag = false;
        try{
            $sql = "UPDATE RoleApplicatif SET ";
            if($roleAppli != ""){
                if($flag){
                    $sql .= ", ";
                }
                $sql .= "roleAppli=:roleAppli ";
                $flag = true;
            }
            if($mdpRoleAppli != ""){
                if($flag){
                    $sql .= ", ";
                }
                $sql .= "mdpRoleAppli=:mdpRoleAppli ";
            }
            $sql .= "WHERE idAppli=:idAppli";
            $result = $this->_db->prepare($sql);
            if($mdpRoleAppli != ""){
                $result->bindParam(":mdpPerso", $mdpRoleAppli, PDO::PARAM_STR);
            }
            if($roleAppli != ""){
                $result->bindParam(":mdpPerso", $roleAppli, PDO::PARAM_STR);
            }
            $result->bindParam(":idAppli", $idAppli, PDO::PARAM_STR);
            return $result->execute();
        } catch (PDOException $e){
            die('Erreur : '. $e->getMessage());
        }
    }

    public function deleteRoleApplicatif($idAppli) {
        try {
            $sql = "DELETE FROM RoleApplicatif WHERE idRoleAppli = :idRoleAppli";
            $stmt = $this->_db->prepare($sql);
            $stmt->bindParam(':idRoleAppli', $idAppli, PDO::PARAM_STR);
            return $stmt->execute();
            } catch (PDOException $e){
        die('Erreur : '. $e->getMessage());
        }
    }
}