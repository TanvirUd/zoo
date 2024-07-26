<?php

require_once("mother_entity.php");

class Application extends Entity
{
    private int $idAppli;
    private string $nomAppli;
    private string $dbAppli;

    public function getIdAppli(): int
    {
        return $this->idAppli;
    }

    public function setIdAppli(int $idAppli): void
    {
        $this->idAppli = $idAppli;
    }

    public function getNomAppli(): string
    {
        return $this->nomAppli;
    }

    public function setNomAppli(string $nomAppli): void
    {
        $this->nomAppli = $nomAppli;
    }

    public function getDbAppli(): string
    {
        return $this->dbAppli;
    }

    public function setDbAppli(string $dbAppli): void
    {
        $this->dbAppli = $dbAppli;
    }
}