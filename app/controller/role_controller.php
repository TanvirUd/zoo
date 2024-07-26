<?php
require_once('../app/controller/mother_controller.php');

class RoleCtrl extends MotherCtrl
{
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