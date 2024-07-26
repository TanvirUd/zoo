<?php
require_once('../app/controller/mother_controller.php');

class PersonnelCtrl extends MotherCtrl
{
    //méthode pour afficher les noms complets des personnels dans le select
    public function afficherNomsPersonnels()
    {
        require_once("personnel_model.php");
        $personnelModel = new PersonnelModel();
        $fullNames = $personnelModel->getPersonnelByFullName();

        // construction du select pour afficher les noms du personnel
        $selectNomsPersonnel = "";

        foreach ($fullNames as $personnel) {
            $selectNomsPersonnel .= '<option>' . htmlspecialchars($personnel['fullName']) . '</option>';
        }
        $this->_data['selectNomsPersonnel'] = $selectNomsPersonnel;
        $this->_data['page'] = 'affectationrole';
        $this->render();
    }

    public function inscription()
    {
        $this->_data['title'] = 'Inscription';
        $errors = array();

        $email = $_POST['mel_perso_signup']??'';
        $mdp = $_POST['mdp_perso_signup']??'';
        $verifMdp = $_POST['verifMdpPerso']??'';
        $nom = $_POST['nom_perso_signup']??'';
        $prenom = $_POST['prenom_perso_signup']??'';
        $dateNaissance = $_POST['date_naissance_perso_signup']??'';
        $adresse = $_POST['adresse_perso_signup']??'';
        $tel = $_POST['tel_perso_signup']??'';


        $this->_data['email'] = $email;
        $this->_data['mdp'] = $mdp;
        $this->_data['verifMdp'] = $verifMdp;
        $this->_data['nom'] = $nom;
        $this->_data['prenom'] = $prenom;
        $this->_data['dateNaissance'] = $dateNaissance;
        $this->_data['adresse'] = $adresse;
        $this->_data['tel'] = $tel;

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
                require_once("../app/model/personnel_model.php");
                $personnelModel = new PersonnelModel();
                if($personnelModel->checkIfMelExist($email)) {
                    $errors[] = "Cet email est déjà utilisé";
                }

                if(count($errors) == 0) {
                    if($personnelModel->createPersonnel()){
                        header('Location: index.php?controller=personnel&action=connexion');
                    }else{
                        $errors[] = "Une erreur est survenue";
                    }
                    
                }
            }
        }

        if(count($errors) > 0) {
            $this->_data['errors'] = $errors;
            var_dump($errors);
        }

        $this->_data['page'] = 'signup';
        $this->render();
    }

    public function connexion()
    {
        $this->_data['title'] = 'login';
        $errors = array();

        $email = $_POST['melPerso']??'';
        $mdp = $_POST['mdpPerso']??'';

        $this->_data['email'] = $email;
        $this->_data['mdp'] = $mdp;

        if(count($_POST) > 0) {
            if($email == ""){
                $errors[] = "Veuillez entrer votre adresse email";
            }
            if($mdp == ""){
                $errors[] = "Veuillez entrer votre mot de passe";
            }

            if(count($errors) == 0) {
                require_once("../app/model/personnel_model.php");
                $personnelModel = new PersonnelModel();

                if(!$personnelModel->checkIfMelExist($email)) {
                    $errors[] = "Cet email n'existe pas";
                }

                if(count($errors) == 0) {
                    $user = $personnelModel->connectPersonnel();
                    if($user) {
                        require_once("../app/entity/personnel_entity.php");
                        $personnel = new Personnel();
                        $personnel->hydrate($user);

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
            var_dump($errors);
        }

        $this->_data['page'] = 'login';
        $this->render();
    }

    public function deconnexion()
    {
        session_destroy();
        header('Location: index.php');
    }
}