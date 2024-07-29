<?php
require_once("../app/entity/mother_entity.php");
require_once("../app/entity/application_entity.php");

class RoleApplicatif extends Entity
{
    private int $idAppli; // en référence à idAppli de Application
    private string $idRoleAppli;
    private string $mdpRoleAppli;
   // private Application $application;

    // public function getApplication(): Application
    // {
    //     return $this->application;
    // }

    // public function setApplication(array $application): void
    // {
    //     $this->application = New application($application['idAppli'], $application['nomAppli'], $application['dbAppli']);
    // }
    
    /**
     * Get the value of idAppli
     */
    public function getIdAppli(): int
    {
        return $this->idAppli;
    }


    /**
     * Set the value of idAppli
     */
    public function setIdAppli(int $idAppli): void
    {
        $this->idAppli = $idAppli;
    }

    /**
     * Get the value of idRoleAppli
     */
    public function getIdRoleAppli(): string
    {
        return $this->idRoleAppli;
    }

    /**
     * Set the value of idRoleAppli
     */
    public function setIdRoleAppli(string $idRoleAppli): void
    {
        $this->idRoleAppli = $idRoleAppli;
    }

    /**
     * Get the value of mdpRoleAppli
     */
    public function getMdpRoleAppli(): string
    {
        return $this->mdpRoleAppli;
    }

    /**
     * Set the value of mdpRoleAppli
     */
    public function setMdpRoleAppli(string $mdpRoleAppli): void
    {
        $this->mdpRoleAppli = $mdpRoleAppli;
    }
}