<?php
require_once('../app/controller/mother_controller.php');

class HomeCtrl extends MotherCtrl
{
    /**
     * Renders the homepage view with the title "Accueil" and sets the page variable to "home".
     *
     * @return void
     */
    public function homepage()
    {
        $this->_data['title'] = "Gestion des rôles";
        $errors = array();

        require_once("../app/model/roleApplicatif_model.php");
        $roleApplicatif = new RoleApplicatifModel();
        $roleApplicatifs = $roleApplicatif->getAll();
        
        if(isset($roleApplicatifs) && count($roleApplicatifs) > 0) {
            $roleAppEntities = array();
            foreach($roleApplicatifs as $roleApplicatif) {
                require_once("../app/entity/roleApplicatif_entity.php");
                $roleAppEntity = new RoleApplicatif();
                $roleAppEntity->hydrate($roleApplicatif);  
                require_once("../app/model/application_model.php");
                $applicationModel = new ApplicationModel;
                $applicationBd = $applicationModel->getApplicationById($roleAppEntity->getIdAppli());
                require_once("../app/entity/application_entity.php");
                $applicationEntity = new Application;
                $applicationEntity->hydrate($applicationBd);   

                $tempTable = [
                    "application" => $applicationEntity,
                    "roleApplicatifs" => $roleAppEntity
                ];
                $roleAppEntities[] = $tempTable;
            }
            $this->_data['roleApplicatifs'] = $roleAppEntities;
        }else{
            $errors[] = "Il n'y a pas de role applicatif";
        }

        if(count($errors) > 0) {
            $this->_data['errors'] = $errors;
        }

        $this->_data['page'] = "rolepage";
        $this->render();
    }
}