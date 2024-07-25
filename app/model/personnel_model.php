<?php

require_once('pdo_model.php');

class personnelModel extends PdoModel
{
    public function createPersonnel(){
        $melPerso = $_POST['']; //insérer contenu form
        $nomPerso = $_POST['']; //insérer contenu form
        $prenomPerso = $_POST['']; //insérer contenu form
        $dateNaissancePerso = $_POST['']; //insérer contenu form
        $adressePerso = $_POST['']; //insérer contenu form
        $telPerso = $_POST['']; //insérer contenu form
        $mdpPerso = password_hash($_POST[''], PASSWORD_DEFAULT); //insérer contenu form
        try{
            $sql = "INSERT INTO personel(/*************/) VALUES (/*************/);";
            $result = $this->_db->prepare($sql);
            $result->bindParam(/*************/ PDO::PARAM_STR);
            return $result->execute();
        } catch (PDOException $e){
            die('Erreur : '. $e->getMessage());
        }
    }
}