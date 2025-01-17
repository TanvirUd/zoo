<?php
require_once("../app/entity/mother_entity.php");

class EstHabilite extends Entity
{
    private string $numMatriculePerso; //en référence à numMatriculePerso de Personnel
    private string $idAppli; // en référence à idAppli
    private string $idRoleAppli; // idRoleAppli de RoleApplicatif

    public function getNumMatriculePerso(): string
    {
        return $this->numMatriculePerso;
    }

    public function setNumMatriculePerso(string $numMatriculePerso): void
    {
        $this->numMatriculePerso = $numMatriculePerso;
    }

    public function getIdAppli(): string
    {
        return $this->idAppli;
    }

    public function setIdAppli(string $idAppli): void
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

}