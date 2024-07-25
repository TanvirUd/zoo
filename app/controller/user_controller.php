<?php
require_once('mother_controller.php');

class UserCtrl extends MotherCtrl
{
    public function inscription()
    {
        $this->_data['title'] = 'Inscription';
        $errors = array();

        $email = $_POST['melPerso']??'';
        $mdp = $_POST['mdpPerso']??'';
        $verifMdp = $_POST['verifMdpPerso']??'';
        $nom = $_POST['nomPerso']??'';
        $prenom = $_POST['prenomPerso']??'';
        $dateNaissance = $_POST['dateNaissancePerso']??'';
        $adresse = $_POST['adressePerso']??'';
        $tel = $_POST['telPerso']??'';

        if(count($_POST) > 0) {
            if($email == ""){
                $errors[] = "Veuillez entrer votre adresse email";
            }
            if($mdp == ""){
                $errors[] = "Veuillez entrer votre mot de passe";
            }
            if($verifMdp == ""){
                $errors[] = "Veuillez confirmer votre mot de passe";
            }
            if($mdp != $verifMdp){
                $errors[] = "Les mots de passe ne sont pas identiques";
            }
            if($nom == ""){
                $errors[] = "Veuillez entrer votre nom";
            }

            if(count($errors) == 0) {
                require_once("../app/Model/personnel_model.php");
                $personnelModel = new PersonnelModel();
                if($personnelModel->checkEmail($email)) {
                    $errors[] = "Cet email est déjà utilisé";
                }

                if(count($errors) == 0) {
                    $personnelModel->createPersonnel();
                }
            }
        }

        if(count($errors) > 0) {
            $this->_data['errors'] = $errors;
        }

        $this->_data['page'] = 'inscription';
        $this->render();
    }

    public function connexion()
    {
        $this->_data['title'] = 'Connexion';
        $errors = array();

        $email = $_POST['melPerso']??'';
        $mdp = $_POST['mdpPerso']??'';

        if(count($_POST) > 0) {
            if($email == ""){
                $errors[] = "Veuillez entrer votre adresse email";
            }
            if($mdp == ""){
                $errors[] = "Veuillez entrer votre mot de passe";
            }

            if(count($errors) == 0) {
                require_once("../app/Model/personnel_model.php");
                $personnelModel = new PersonnelModel();

                if(!$personnelModel->checkEmail($email)) {
                    $errors[] = "Cet email n'existe pas";
                }

                if(count($errors) == 0) {
                    if($personnelModel->connect()) {
                        require_once("../app/Entity/personnel_entity.php");
                        $personnel = new Personel();
                        $personnel->hydrate = $personnelModel;

                        $_SESSION['matricule'] = $personnel->getNumMatriculePerso();
                        $_SESSION['nom'] = $personnel->getNomPerso();
                        $_SESSION['prenom'] = $personnel->getPrenomPerso();
                        $_SESSION['dateNaissance'] = $personnel->getDateNaissancePerso();
                        $_SESSION['adresse'] = $personnel->getAdressePerso();
                        $_SESSION['tel'] = $personnel->getTelPerso();
                        $_SESSION['mel'] = $personnel->getMelPerso();

                        header('Location: index.php');
                    }
                }
            }

        }

        if(count($errors) > 0) {
            $this->_data['errors'] = $errors;
        }

        $this->_data['page'] = 'connexion';
        $this->render();
    }

    public function deconnexion()
    {
        session_destroy();
        header('Location: index.php');
    }
}