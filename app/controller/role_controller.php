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

        if(count($errors) > 0) {
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
            $dropSelect = explode(":", $_POST['nomAppli'])??"";
            $idAppli = filter_var($dropSelect[0])??"";
            $roleApplicatif = filter_var($dropSelect[1])??"";

            if($numMatriculePerso == "" || $idAppli == "") {
                $errors[] = "Veuillez renseigner tous les champs";
            }

            if(count($errors) == 0) {
                $estHabiliteModel = new EstHabiliteModel();
                $estHabiliteModel->assignHabilitesPourPersonnel($numMatriculePerso, intval($idAppli), $roleApplicatif);
            }
        }
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
}