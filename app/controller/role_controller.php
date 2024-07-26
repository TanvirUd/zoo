<?php
require_once('../app/controller/mother_controller.php');

class RoleCtrl extends MotherCtrl
{
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

        $personnelModel = new PersonnelModel();
        $personnels = $personnelModel->getPersonnelByFullName();

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

        $numMatriculePerso = filter_var($_POST[''])??"";
        $idAppli = filter_var($_POST[''])??"";
        $roleApplicatif = filter_var($_POST[''])??"";

        if (isset($_POST)){
            if($numMatriculePerso == "" || $idAppli == "") {
                $errors[] = "Veuillez renseigner tous les champs";
            }

            if(count($errors) == 0) {
                $estHabiliteModel = new EstHabiliteModel();
                $estHabiliteModel->assignHabilitesPourPersonnel($numMatriculePerso, $idAppli, $roleApplicatif);
            }
        }

        if(count($errors) > 0) {
            $this->_data['errors'] = $errors;
        }

        $this->affectRole();
    }

    public function permissions()
    {
        $this->_data['title'] = "Définition des drits associes à un rôle";
        $errors = array();

        require_once("../app/model/roleApplicatif_model.php");
        $roleApplicatif = new RoleApplicatifModel();
        $roleApplicatifs = $roleApplicatif->getAll();
        if (isset($roleApplicatifs) && count($roleApplicatifs) > 0) {
            $roleAppEntities = array();
            foreach ($roleApplicatifs as $roleApplicatif) {
                require_once("./app/entity/roleApplicatif_entity.php");
                $roleAppEntity = new RoleApplicatif();
                $roleAppEntity->hydrate($roleApplicatif);
                $roleAppEntities[] = $roleAppEntity;
            }
            $this->_data['roleApplicatifs'] = $roleAppEntities;
        }

    }
}