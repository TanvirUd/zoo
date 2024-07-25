<?php
require_once("mother_entity.php");

class RoleApplicatif extends Entity
{
    private int $idAppli; // en référence à idAppli de Application
    private string $idRoleAppli;
    private string $mdpRoleAppli;

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