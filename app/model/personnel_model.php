<?php
require_once("../app/model/pdo_model.php");
class PersonnelModel extends PdoModel
{

    //récupérer les personnels par leurs nom complets
    public function getPersonnelByFullName(): array {
        $sql = "SELECT numMatriculePerso, CONCAT(prenomPerso, ' ', nomPerso) AS fullName FROM Personnel";
        $stmt = $this->_db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function createPersonnel(){
        $melPerso = strip_tags($_POST['mel_perso_signup']);
        $nomPerso = htmlentities($_POST['nom_perso_signup']);
        $prenomPerso = htmlentities($_POST['prenom_perso_signup']);
        $dateNaissancePerso = htmlentities($_POST['date_naissance_perso_signup']);
        $adressePerso = htmlentities($_POST['adresse_perso_signup']);
        $telPerso = htmlentities($_POST['tel_perso_signup']);
        $mdpPerso = password_hash($_POST['mdp_perso_signup']?? "", PASSWORD_DEFAULT); //insérer contenu form

        // Générer un numéro matricule unique avec 2 chiffres et 2 lettres
        do {
            $digits = mt_rand(10, 99); // Génère 2 chiffres
            $letters = strtoupper(chr(mt_rand(65, 90)) . chr(mt_rand(65, 90))); // Génère 2 lettres
            $numMatriculePerso = $digits . $letters; // Par exemple "12AB"

            // Vérification de l'unicité du numéro matricule
            $sqlCheck = "SELECT COUNT(*) FROM Personnel WHERE numMatriculePerso = :numMatriculePerso";
            $stmtCheck = $this->_db->prepare($sqlCheck);
            $stmtCheck->bindParam(":numMatriculePerso", $numMatriculePerso, PDO::PARAM_STR);
            $stmtCheck->execute();
            $exists = $stmtCheck->fetchColumn();
        } while ($exists > 0); // Répéter jusqu'à trouver un numéro unique

        try{
            $sql = "INSERT INTO Personnel(melPerso, mdpPerso, nomPerso, prenomPerso, dateNaissancePerso, adressePerso, telPerso, numMatriculePerso) 
            VALUES (:melPerso, :mdpPerso, :nomPerso, :prenomPerso, :dateNaissancePerso, :adressePerso, :telPerso, :numMatriculePerso);";
            $result = $this->_db->prepare($sql);
            $result->bindParam(":melPerso", $melPerso, PDO::PARAM_STR);
            $result->bindParam(":mdpPerso", $mdpPerso, PDO::PARAM_STR);
            $result->bindParam(":nomPerso", $nomPerso, PDO::PARAM_STR);
            $result->bindParam(":prenomPerso", $prenomPerso, PDO::PARAM_STR);
            $result->bindParam(":dateNaissancePerso", $dateNaissancePerso, PDO::PARAM_STR);
            $result->bindParam(":adressePerso", $adressePerso, PDO::PARAM_STR);
            $result->bindParam(":telPerso", $telPerso, PDO::PARAM_STR);
            $result->bindParam(":numMatriculePerso", $numMatriculePerso, PDO::PARAM_STR);
            return $result->execute();
        } catch (PDOException $e){
            die('Erreur : '. $e->getMessage());
        }
    }

    public function createPersonnelFaker($melPerso, $nomPerso, $prenomPerso, $dateNaissancePerso, $adressePerso, $telPerso){
        $mdpPerso = password_hash("admin", PASSWORD_DEFAULT); //insérer contenu form
        
        // Générer un numéro matricule unique avec 2 chiffres et 2 lettres
        do {
            $digits = mt_rand(10, 99); // Génère 2 chiffres
            $letters = strtoupper(chr(mt_rand(65, 90)) . chr(mt_rand(65, 90))); // Génère 2 lettres
            $numMatriculePerso = $digits . $letters; // Par exemple "12AB"

            // Vérification de l'unicité du numéro matricule
            $sqlCheck = "SELECT COUNT(*) FROM Personnel WHERE numMatriculePerso = :numMatriculePerso";
            $stmtCheck = $this->_db->prepare($sqlCheck);
            $stmtCheck->bindParam(":numMatriculePerso", $numMatriculePerso, PDO::PARAM_STR);
            $stmtCheck->execute();
            $exists = $stmtCheck->fetchColumn();
        } while ($exists > 0); // Répéter jusqu'à trouver un numéro unique

        try{
            $sql = "INSERT INTO Personnel(melPerso, mdpPerso, nomPerso, prenomPerso, dateNaissancePerso, adressePerso, telPerso, numMatriculePerso) 
            VALUES (:melPerso, :mdpPerso, :nomPerso, :prenomPerso, :dateNaissancePerso, :adressePerso, :telPerso, :numMatriculePerso);";
            $result = $this->_db->prepare($sql);
            $result->bindParam(":melPerso", $melPerso, PDO::PARAM_STR);
            $result->bindParam(":mdpPerso", $mdpPerso, PDO::PARAM_STR);
            $result->bindParam(":nomPerso", $nomPerso, PDO::PARAM_STR);
            $result->bindParam(":prenomPerso", $prenomPerso, PDO::PARAM_STR);
            $result->bindParam(":dateNaissancePerso", $dateNaissancePerso, PDO::PARAM_STR);
            $result->bindParam(":adressePerso", $adressePerso, PDO::PARAM_STR);
            $result->bindParam(":telPerso", $telPerso, PDO::PARAM_STR);
            $result->bindParam(":numMatriculePerso", $numMatriculePerso, PDO::PARAM_STR);
            return $result->execute();
        } catch (PDOException $e){
            die('Erreur : '. $e->getMessage());
        }
    }

    public function getAllPersonnel(){
        try{
            $sql = "SELECT * FROM personnel";
            $result = $this->_db->prepare($sql);
            $result->execute();
            $personnel = $result->fetchAll();
            return $personnel;
        } catch (PDOException $e){
            die('Erreur : '. $e->getMessage());
        }
    }

    public function getPersonnelByNumMatricule($numMatriculePerso){

        try{
            $sql = "SELECT * FROM Personnel WHERE numMatriculePerso=:numMatriculePerso";
            $result = $this->_db->prepare($sql);
            $result->bindParam(":numMatriculePerso", $numMatriculePerso, PDO::PARAM_STR);
            $result->execute();
            $personnel = $result->fetch();
            return $personnel;
        } catch (PDOException $e){
            die('Erreur : '. $e->getMessage());
        }
    }

    public function checkIfMatriculeExist($numMatriculePerso){
        $sql = "SELECT numMatriculePerso FROM Personnel WHERE numMatriculePerso = :numMatriculePerso;";
        $result = $this->_db->prepare($sql);
        $result->bindValue(":numMatriculePerso", $numMatriculePerso, PDO::PARAM_STR);
        $result->execute();
        $personnel = $result->fetch();
        return $personnel != false;
    }

    public function checkIfMelExist($melPerso){
        $sql = "SELECT melPerso FROM Personnel WHERE melPerso=:melPerso";
        $result = $this->_db->prepare($sql);
        $result->bindValue(":melPerso", $melPerso, PDO::PARAM_STR);
        $result->execute();
        $personnel = $result->fetch();
        return $personnel != false;
    }

    public function connectPersonnel(){
        $melPerso = $_POST['melPerso']; //insérer contenu form
        $mdpPerso = $_POST['mdpPerso']; //insérer contenu form

        $sql = "SELECT * FROM Personnel WHERE melPerso=:melPerso";
        $result = $this->_db->prepare($sql);
        $result->bindValue(":melPerso", $melPerso, PDO::PARAM_STR);
        $result->execute();
        $user = $result->fetch();

        if($user && password_verify($mdpPerso, $user['mdpPerso'])){
            unset($user['mdpPerso']);
            return $user;
        }

        return false;
    }

    public function updatePersonnel(){
        $numMatriculePerso = $_SESSION['']; //insérer contenu form
        $numMatriculePersoUpdate = $_POST['']??""; //insérer contenu form
        $melPerso = $_POST['email']??""; //insérer contenu form
        $mdpPerso = $_POST['signup-password']??""; //insérer contenu form
        $mdpPersoHash = password_hash($mdpPerso, PASSWORD_DEFAULT);
        $nomPerso = $_POST['']; //insérer contenu form
        $prenomPerso = $_POST['']; //insérer contenu form
        $dateNaissancePerso = $_POST['']; //insérer contenu form
        $adressePerso = $_POST['']; //insérer contenu form
        $telPerso = $_POST['']; //insérer contenu form
        $flag = false;
        try{
            $sql = "UPDATE user SET ";
            if($numMatriculePersoUpdate != "" && $numMatriculePerso != $numMatriculePersoUpdate && !$this->checkIfMatriculeExist($numMatriculePersoUpdate)){
                $sql .= "numMatriculePerso=:numMatriculePersoUpdate ";
                $flag = true;
            }
            if($melPerso != "" && !$this->checkIfMelExist($melPerso)){
                if($flag){
                    $sql .= ", ";
                }
                $sql .= "melPerso=:melPerso ";
                $flag = true;
            }
            if($mdpPerso != ""){
                if($flag){
                    $sql .= ", ";
                }
                $sql .= "mdpPerso=:mdpPerso ";
                $flag = true;
            }
            if($nomPerso != ""){
                if($flag){
                    $sql .= ", ";
                }
                $sql .= "nomPerso=:nomPerso ";
                $flag = true;
            }
            if($prenomPerso != ""){
                if($flag){
                    $sql .= ", ";
                }
                $sql .= "prenomPerso=:prenomPerso ";
                $flag = true;
            }
            if($dateNaissancePerso != ""){
                if($flag){
                    $sql .= ", ";
                }
                $sql .= "dateNaissancePerso=:dateNaissancePerso ";
                $flag = true;
            }
            if($adressePerso != ""){
                if($flag){
                    $sql .= ", ";
                }
                $sql .= "adressePerso=:adressePerso ";
                $flag = true;
            }
            if($telPerso != ""){
                if($flag){
                    $sql .= ", ";
                }
                $sql .= "telPerso=:telPerso ";
            }
            $sql .= "WHERE numMatriculePerso=:numMatriculePerso";
            $result = $this->_db->prepare($sql);
            if($numMatriculePersoUpdate != "" && $numMatriculePerso != $numMatriculePersoUpdate && !$this->checkIfMatriculeExist($numMatriculePersoUpdate)){
                $result->bindParam(":numMatriculePersoUpdate", $numMatriculePersoUpdate, PDO::PARAM_STR);
                $_SESSION[''] = $numMatriculePersoUpdate; //insérer contenu form
            }
            if($melPerso != "" && !$this->checkIfMelExist($melPerso)){
                $result->bindParam(":melPerso", $melPerso, PDO::PARAM_STR);
                $_SESSION[''] = $melPerso; //insérer contenu form
            }
            if($mdpPerso != ""){
                $result->bindParam(":mdpPerso", $mdpPersoHash, PDO::PARAM_STR);
            }
            if($nomPerso != ""){
                $result->bindParam(":nomPerso", $nomPerso, PDO::PARAM_STR);
            }
            if($prenomPerso != ""){
                $result->bindParam(":prenomPerso", $prenomPerso, PDO::PARAM_STR);
            }
            if($dateNaissancePerso != ""){
                $result->bindParam(":dateNaissancePerso", $dateNaissancePerso, PDO::PARAM_STR);
            }
            if($adressePerso != ""){
                $result->bindParam(":adressePerso", $adressePerso, PDO::PARAM_STR);
            }
            if($telPerso != ""){
                $result->bindParam(":telPerso", $telPerso, PDO::PARAM_STR);
            }
            $result->bindParam(":numMatriculePerso", $numMatriculePerso, PDO::PARAM_STR);
            return $result->execute();
        } catch (PDOException $e){
            die('Erreur : '. $e->getMessage());
        }
    }

    public function deletePersonnel($numMatriculePerso){
        try{
            $sql = "DELETE FROM Personnel WHERE numMatriculePerso=:numMatriculePerso";
            $result = $this->_db->prepare($sql);
            $result->bindParam(":numMatriculePerso", $numMatriculePerso, PDO::PARAM_STR);
            return $result->execute();
        } catch (PDOException $e){
            die('Erreur : '. $e->getMessage());
        }
    }
}