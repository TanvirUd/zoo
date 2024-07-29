<?php
require_once('../app/controller/mother_controller.php');

class RoleApplicatifCtrl extends MotherCtrl
{

    
    /**
     * Retrieves all personnel and application entities and assigns them to the view data.
     *
     * @throws Exception if an error occurs while retrieving personnel or application entities.
     * @return void
     */
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

    /**
     * Handles the POST request for role assignment.
     *
     * This function is responsible for processing the POST request when a user submits the role assignment form.
     * It retrieves the selected role and application from the POST data and performs the necessary actions based on the selected role.
     * If the selected role is "delete", it removes the user's role for the selected application.
     * If the selected role is not "delete", it checks if the user already has a role for the selected application.
     * If the user has a role, it updates the user's role for the selected application.
     * If the user does not have a role, it assigns the selected role to the user for the selected application.
     *
     * @throws None
     * @return None
     */
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

    /**
     * Creates a new role applicatif with the given ID, name, and password.
     *
     * @return void
     * @throws Exception if there is an error creating the role applicatif
     */
    public function createRole()
    {
        $idAppli = $_POST['idAppli'];
        $nomRole = trim(htmlspecialchars($_POST['nomRole'] ?? ""));
        $mdpRoleAppli = trim(htmlspecialchars($_POST['mdpAppli'] ?? ""));
        if (!empty($idAppli) && !empty($nomRole) && !empty($mdpRoleAppli)) {
            var_dump($idAppli);
            die();
            require_once("../app/model/roleApplicatif_model.php");
            $roleModel = new RoleApplicatifModel();
            try {
                $roleModel->createRoleApplicatif($idAppli, $nomRole, $mdpRoleAppli);
                header("Location: index.php");
                exit;
            } catch (Exception $e) {
                echo "Erreur : " . $e->getMessage();
            }
        } else {
            echo "Erreur : Merci de remplir tous les champs.";
        }
    }


    /**
     * Deletes a role applicatif based on the provided ID.
     *
     * @return void
     * @throws Exception if the deletion fails or if the ID is empty
     */
    public function deleteRole()
    {
        $idAppli = $_POST['roleName'] ?? '';
        if (empty($idAppli)) {
            header("Location: index.php?controller=error&action=error_404");
            exit;
        }

        require_once("../app/model/roleApplicatif_model.php");
        $roleModel = new RoleApplicatifModel();
        try {
            if ($roleModel->deleteRoleApplicatif($idAppli)) {
                header("Location: index.php?controller=Home&action=homepage");
                exit;
            } else {
                throw new Exception("Suppression échouée");
            }
        } catch (Exception $e) {
            error_log($e->getMessage());
            header("Location: index.php?controller=error&action=error_404");
            exit;
        }
    }
    
}
