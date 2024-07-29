<?php
require_once("../app/model/pdo_model.php");
class RoleApplicatifModel extends PdoModel
{
    public function getAll() {
        $sql = "SELECT * FROM RoleApplicatif";
        $result = $this->_db->prepare($sql);
        $result->execute();
        $roles = $result->fetchAll(PDO::FETCH_ASSOC);
        // $data = [];
        // foreach ($roles as $role) {
        //     $sql = "SELECT * FROM `Application` WHERE idAppli=:idAppli";
        //     $result = $this->_db->prepare($sql);
        //     $result->bindParam(":idAppli", $role['idAppli'], PDO::PARAM_INT);
        //     $result->execute();
        //     $role['application'] = $result->fetch();
        //     $data[] = $role;
        // }
        // return $data;
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

    public function createRoleApplicatif($idAppli, $nomRole, $mdpRoleAppli) {
        $idAppli = $_POST['idAppli'];
        $nomRole = htmlentities($_POST['nomRole']);
        $mdpRoleAppli = htmlentities($_POST['mdpAppli']);

        try{
            $sql = "INSERT INTO RoleApplicatif(idAppli, idRoleAppli, mdpRoleAppli) 
            VALUES (:idAppli, :idRoleAppli, :mdpRoleAppli);";
            $result = $this->_db->prepare($sql);
            $result->bindParam(":idAppli", $idAppli, PDO::PARAM_INT);
            $result->bindParam(":idRoleAppli", $nomRole, PDO::PARAM_STR);
            $result->bindParam(":mdpRoleAppli", $mdpRoleAppli, PDO::PARAM_STR);
            return $result->execute();
        } catch (PDOException $e){
            die('Erreur : '. $e->getMessage());
        }
    }

    public function updateRoleApplicatif($idAppli, $nomRole, $mdpRoleAppli) {
        $idAppli = $_POST['idAppli'];
        $nomRole = $_POST['nomRole']??""; //insérer contenu form
        $mdpRoleAppli = $_POST['mdpAppli']??""; //insérer contenu form
        $flag = false;
        try{
            $sql = "UPDATE RoleApplicatif SET ";
            if($nomRole != ""){
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
            if($idAppli != ""){
                if($flag){
                    $sql .= ", ";
                }
                $sql .= "idAppli=:idAppli ";
            }
            $sql .= "WHERE nomRole=:nomRole";
            $result = $this->_db->prepare($sql);
            if($mdpRoleAppli != ""){
                $result->bindParam(":mdpPerso", $mdpRoleAppli, PDO::PARAM_STR);
            }
            if($nomRole != ""){
                $result->bindParam(":idAppli", $idAppli, PDO::PARAM_STR);
            }
            $result->bindParam(":nomRole", $nomRole, PDO::PARAM_STR);
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