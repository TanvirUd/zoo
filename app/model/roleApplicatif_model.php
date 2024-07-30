<?php
require_once("../app/model/pdo_model.php");
class RoleApplicatifModel extends PdoModel
{
    public function getAll() {
        $sql = "SELECT * FROM RoleApplicatif";
        $result = $this->_db->prepare($sql);
        $result->execute();
        $roles = $result->fetchAll(PDO::FETCH_ASSOC);
        return $roles;
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

    public function getBddByAppliId($idAppli) {
        try{
            $sql = "SELECT * FROM RoleApplicatif WHERE dbAppli=:dbAppli";
            $result = $this->_db->prepare($sql);
            $result->bindParam(":dbAppli", $idAppli, PDO::PARAM_STR);
            $result->execute();
            $role = $result->fetchAll();
            $sql = "SELECT * FROM `Application` WHERE idAppli=:idAppli";
            $result = $this->_db->prepare($sql);
            $result->bindParam(":dbAppli", $idAppli, PDO::PARAM_INT);
            $result->execute();
            $role['application'] = $result->fetch();
            return $role;
        } catch (PDOException $e){
            die('Erreur : '. $e->getMessage());
        }
    }

    public function getRolesByUserAndAppliId($idAppli, $numMatriculePerso) {
        try{
            $sql = "SELECT * FROM RoleApplicatif WHERE idAppli=:idAppli AND numMatriculePerso=:numMatriculePerso";
            $result = $this->_db->prepare($sql);
            $result->bindParam(":idAppli", $idAppli, PDO::PARAM_INT);
            $result->bindParam(":numMatriculePerso", $numMatriculePerso, PDO::PARAM_STR);
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
            $sql = "INSERT INTO RoleApplicatif(idAppli, idRoleAppli, mdpRoleAppli) 
            VALUES (:idAppli, :idRoleAppli, :mdpRoleAppli);";
            $result = $this->_db->prepare($sql);
            $result->bindParam(":idAppli", $idAppli, PDO::PARAM_INT);
            $result->bindParam(":idRoleAppli", $idRoleAppli, PDO::PARAM_STR);
            $result->bindParam(":mdpRoleAppli", $mdpRoleAppli, PDO::PARAM_STR);
            return $result->execute();
        } catch (PDOException $e){
            die('Erreur : '. $e->getMessage());
        }
    }

    public function createRoleLoginOnDb($id,  $mdp, $nomDb) {
        try{
            $sql1 = "CREATE USER " . $this->_db->quote($id) . "@" . $_ENV['DBHOST'] . " IDENTIFIED BY ".$this->_db->quote($mdp).";";
            var_dump($sql1);
            $result = $this->_db->prepare($sql1);
            $result->execute();    
            return true;
        } catch (PDOException $e){
            die('Erreur : '. $e->getMessage());
        }
    }

    public function updateRoleApplicatif($idAppli, $roleAppli, $mdpRoleAppli) {
        $flag = false;
        try{
            if($idAppli != ""){
                $sql = "UPDATE EstHabilite SET idAppli=:idAppli WHERE idRoleAppli=:roleAppli";
                $result = $this->_db->prepare($sql);
                $result->bindParam(":idAppli", $idAppli, PDO::PARAM_INT);
                $result->bindParam(":roleAppli", $roleAppli, PDO::PARAM_STR);
                $result->execute();
            }
            $sql = "UPDATE RoleApplicatif SET ";
            if($idAppli != ""){
                $sql .= "idAppli=:idAppli ";
                $flag = true;
            }
            if($mdpRoleAppli != ""){
                if($flag){
                    $sql .= ", ";
                }
                $sql .= "mdpRoleAppli=:mdpRoleAppli ";
            }
            $sql .= "WHERE idRoleAppli=:roleAppli";
            $result = $this->_db->prepare($sql);
            if($idAppli != ""){
                $result->bindParam(":idAppli", $idAppli, PDO::PARAM_INT);
            }
            if($mdpRoleAppli != ""){
                $result->bindParam(":mdpRoleAppli", $mdpRoleAppli, PDO::PARAM_STR);
            }
            $result->bindParam(":roleAppli", $roleAppli, PDO::PARAM_STR);
            return $result->execute();
        } catch (PDOException $e){
            die('Erreur : '. $e->getMessage());
        }
    }

    public function deleteRoleApplicatif($idAppli) {
        try {
            $habil = "DELETE FROM EstHabilite WHERE idRoleAppli = :idRoleAppli";
            $stmt = $this->_db->prepare($habil);
            $stmt->bindParam(':idRoleAppli', $idAppli, PDO::PARAM_STR);
            $stmt->execute();
            $sql = "DELETE FROM RoleApplicatif WHERE idRoleAppli = :idRoleAppli";
            $stmt = $this->_db->prepare($sql);
            $stmt->bindParam(':idRoleAppli', $idAppli, PDO::PARAM_STR);
            return $stmt->execute();
        } catch (PDOException $e){
            throw new RuntimeException("Database error: " . $e->getMessage());
        }
    }
}