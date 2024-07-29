<?php
require_once('../app/controller/mother_controller.php');

class RoleApplicatifCtrl extends MotherCtrl
{
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
