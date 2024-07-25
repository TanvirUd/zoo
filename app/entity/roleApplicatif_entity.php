<?php

class RoleApplicatif
{
    private int $idAppli; // en référence à idAppli de Application
    private string $idRoleAppli;
    private string $mdpRoleAppli;

    public function getIdAppli(): int
    {
        return $this->idAppli;
    }

    public function setIdAppli(int $idAppli): void
    {
        $this->idAppli = $idAppli;
    }

    public function getIdRoleAppli(): string
    {
        return $this->idRoleAppli;
    }

    public function setIdRoleAppli(string $idRoleAppli): void
    {
        $this->idRoleAppli = $idRoleAppli;
    }

    public function getMdpRoleAppli(): string
    {
        return $this->mdpRoleAppli;
    }

    public function setMdpRoleAppli(string $mdpRoleAppli): void
    {
        $this->mdpRoleAppli = $mdpRoleAppli;
    }


}