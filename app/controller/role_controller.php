<?php
require_once('../app/controller/mother_controller.php');

class RoleCtrl extends MotherCtrl
{
    // http://primary.mshome.net/index.php?controller=role&action=affectRole
    public function affectRole()
    {
        require_once("../app/model/personnel_model.php");
        require_once("../app/entity/personnel_entity.php");
        require_once("../app/model/roleApplicatif_model.php");
        require_once("../app/entity/roleApplicatif_entity.php");
        require_once("../app/model/application_model.php");
        require_once("../app/entity/application_entity.php");

        $this->_data['title'] = "Affectation des roles aux membres du personnel";
        $errors = array();

        $this->affectRolePost();

        $personnelModel = new PersonnelModel();
        $personnels = $personnelModel->getAllPersonnel();

        if (isset($personnels) && count($personnels) > 0) {
            $personnelEntities = array();
            foreach ($personnels as $personnel) {
                $personnelEntity = new Personnel();
                $personnelEntity->hydrate($personnel);
                $personnelEntities[] = $personnelEntity;
            }
            $this->_data['personnels'] = $personnelEntities;
        }

        $applicationModel = new ApplicationModel();
        $applications = $applicationModel->getAllApplication();

        if (isset($applications) && count($applications) > 0) {
            $applicationEntities = array();
            foreach ($applications as $application) {
                $applicationEntity = new Application();
                $applicationEntity->hydrate($application);

                $roleAppEntities = array();

                $roleAppModel = new RoleApplicatifModel();
                $roleApplicatifs = $roleAppModel->getRolesByAppliId($applicationEntity->getIdAppli());
                if (isset($roleApplicatifs) && count($roleApplicatifs) > 0) {
                    foreach ($roleApplicatifs as $roleApplicatif) {
                        $roleAppEntity = new RoleApplicatif();
                        $roleAppEntity->hydrate($roleApplicatif);
                        $roleAppEntities[] = $roleAppEntity;
                    }
                }

                $tempTable = [
                    "application" => $applicationEntity,
                    "roleApplicatifs" => $roleAppEntities
                ];
                $applicationEntities[] = $tempTable;
            }
            $this->_data['applications'] = $applicationEntities;
        }

        if (count($errors) > 0) {
            $this->_data['errors'] = $errors;
        }

        $this->_data['page'] = "affectationrole";
        $this->render();
    }

    public function affectRolePost()
    {
        require_once("../app/model/estHabilite_model.php");
        require_once("../app/entity/estHabilite_entity.php");

        if (isset($_POST) && count($_POST) > 0) {
            $numMatriculePerso = filter_var($_POST['nomPerso'])??"";
            foreach ($_POST as $key => $value) {
                $selection = explode(":", $key);

                if ($selection[0] == "nomAppli" && $value != "none") {    
                    $dropSelect = explode(":", $value)??"";
                    $idAppli = filter_var($dropSelect[0])??"";
                    $roleApplicatif = filter_var($dropSelect[1])??"";

                    if($numMatriculePerso == "" || $idAppli == "") {
                        $errors['champs-vide'] = "Veuillez renseigner tous les champs";
                    }else{
                        $estHabiliteModel = new EstHabiliteModel();
                        $checkUserRole = $estHabiliteModel->checkHabilitesByMatriculAndIdAppli($numMatriculePerso, $idAppli);

                        if ($roleApplicatif == "delete") {
                            $estHabiliteModel->removeHabilitesPourPersonnel($numMatriculePerso, intval($idAppli));
                        } else {
                            if ($checkUserRole) {
                                $estHabiliteModel->updateHabilitesPourPersonnel($numMatriculePerso, intval($idAppli), $roleApplicatif);
                            }else{
                                $estHabiliteModel->assignHabilitesPourPersonnel($numMatriculePerso, intval($idAppli), $roleApplicatif);
                            }                            
                        }                       
                    }
                }
            }
        }

        if (count($errors) > 0) {
            $this->_data['errors'] = $errors;
        }

        $this->affectRole();
    }

    public function permissions()
    {
        $this->_data['title'] = "Définition des droits associes à un rôle";
        $errors = array();

        require_once("../app/model/roleApplicatif_model.php");
        $roleApplicatif = new RoleApplicatifModel();
        $roleApplicatifs = $roleApplicatif->getAll();
        if (isset($roleApplicatifs) && count($roleApplicatifs) > 0) {
            $roleAppEntities = array();
            foreach ($roleApplicatifs as $roleApplicatif) {
                require_once("../app/entity/roleApplicatif_entity.php");
                $roleAppEntity = new RoleApplicatif();
                $roleAppEntity->hydrate($roleApplicatif);
                $roleAppEntities[] = $roleAppEntity;
            }
        }
        $this->_data['page'] = "droits";
        $this->render();
    }


    public function addNewRole()
    {
        $this->_data['title'] = "Gestion des rôles";
        $errors = array();

        // Récupération des applications disponibles
        require_once("../app/model/application_model.php");
        $applicationModel = new ApplicationModel();
        $applications = $applicationModel->getAllApplication();

        // Vérification si des applications sont disponibles
        if (isset($applications) && count($applications) > 0) {
            $applicationEntities = array();
            // Hydratation des entités d'application
            foreach ($applications as $application) {
                require_once("../app/entity/application_entity.php");
                $applicationEntity = new Application();
                $applicationEntity->hydrate($application);
                $applicationEntities[] = $applicationEntity; // Ajout de l'entité à la liste
            }
            // Stockage des applications dans les données pour la vue
            $this->_data['applications'] = $applicationEntities;
        } else {
            // Ajout d'une erreur si aucune application n'est disponible
            $errors[] = "Aucune application disponible.";
        }

        // Traitement du formulaire pour l'ajout d'un rôle applicatif
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Récupération des données du formulaire
            $nomAppli = $_POST['applicationId'] ?? ''; // ID de l'application
            $roleAppli = $_POST['roleName'] ?? ''; // Nom du rôle

            // Validation des données du formulaire
            if (empty($nomAppli)) {
                $errors[] = "Le nom de l'application est requis.";
            }
            if (empty($roleAppli)) {
                $errors[] = "Le nom du rôle est requis.";
            }

            // ajout en bdd
            if (count($errors) === 0) {
                require_once("../app/model/roleApplicatif_model.php");
                $roleApplicatifModel = new RoleApplicatifModel();

                switch ($nomAppli) {
                    case 'Gestion du parc animalier':
                        $roleNom = 'animaux_';
                        $idAppli = 1;
                        break;
                    case  'Gestion des ateliers':
                        $roleNom = 'ateliers_';
                        $idAppli = 2;
                        break;
                    case  'Gestion des hébergements':
                        $roleNom = 'hotellerie_';
                        $idAppli = 3;
                        break;
                }

                switch ($roleAppli) {
                    case 'developpeur':
                        $roleNom .= 'developpeur';
                        $roleMdp = 'devel';
                        break;
                    case 'stagiaire':
                        $roleNom .= 'stagiaire';
                        $roleMdp = NULL;
                        break;
                    case  'coordinateur':
                        $roleNom .= 'coordinateur';
                        $roleMdp = 'coord';
                        break;
                    case  'superviseur':
                        $roleNom .= 'superviseur';
                        $roleMdp = 'super';
                        break;
                }


                if ($roleApplicatifModel->createRoleApplicatif($idAppli, $roleNom, $roleMdp)) {
                    $this->_data['success'] = "Le rôle a été ajouté avec succès.";
                    // Récupération de tous les rôles applicatifs pour les afficher dans le tableau
                    $this->_data['roleApplicatifs'] = $roleApplicatifModel->getAll();
                    header("location: index.php?controller=role&action=rolepage");
                } else {
                    $errors[] = "Une erreur est survenue.";
                }
            }
        }

        // Affichage des erreurs
        if (count($errors) > 0) {
            $this->_data['errors'] = $errors;
        }

        // Définition de la page à rendre
        $this->_data['page'] = "rolepage";
        // Appel de la méthode pour afficher la vue
        $this->render();
    }
}
