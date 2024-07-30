<?php 
require_once('../app/controller/mother_controller.php');

class ApplicationCtrl extends MotherCtrl
{
    public function application()
    {
        $appli = intval($_GET['appli'])??0;

        require_once("../app/model/application_model.php");
        require_once("../app/entity/application_entity.php");

        $applicationModel = new ApplicationModel();

        if($appli != 0 && $applicationModel->checkApplicationById($appli)){
            $application = $applicationModel->getApplicationById($appli);
            $applicationEntity = new Application();
            $applicationEntity->hydrate($application);
    
            if($applicationEntity->getNomAppli() == 'bdauthentification'){
                session_destroy();
                header("Location: index.php?controller=login&action=login");
            }

            $this->_data['title'] = "Application : ".$applicationEntity->getNomAppli();

            $this->_data['application'] = $applicationEntity;

            require_once("../app/model/estHabilite_model.php");
            require_once("../app/entity/estHabilite_entity.php");
            require_once("../app/entity/roleApplicatif_entity.php");
            require_once("../app/model/application_model.php");
            require_once("../app/entity/application_entity.php");

            $estHabiliteModel = new EstHabiliteModel();
            $estHabilite = $estHabiliteModel->getHabilitesByMatriculeAndIdAppli($_SESSION['matricule'], $appli);
            $roleApplicatifEntity = new RoleApplicatif();
            $roleApplicatifEntity->hydrate($estHabilite);

            $applicationModel = new ApplicationModel();
            $application = $applicationModel->getApplicationById($appli);
            $applicationEntity = new Application();
            $applicationEntity->hydrate($application);

            $this->_data['roleApplicatif'] = $roleApplicatifEntity;
            $this->_data['application'] = $applicationEntity;
            $tempTable = array();

            try{
                $servers = $applicationModel->connectDbApplication($roleApplicatifEntity->getIdRoleAppli(), $roleApplicatifEntity->getMdpRoleAppli(), $applicationEntity->getDbAppli());
                if ($servers) {
                    foreach ($servers as $server) {
                        $tempTable[] = $server['TABLE_NAME'];
                    }                
                } else {
                    $tempTable = false;
                }
            } catch (Exception $e) {
                $tempTable = false;
            } 

            $this->_data['servers'] = $tempTable;
        } else {
            session_destroy();
            header("Location: index.php?controller=personnel&action=connexion");
        }

        $this->_data['page'] = "application";
        $this->render();
    }
}