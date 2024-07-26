<?php
require_once("mother_entity.php");

class Personnel extends Entity {
    private string $numMatriculePerso;
    private string $melPerso;
    private string $mdpPerso;
    private string $nomPerso;
    private string $prenomPerso;
    private DATETIME $dateNaissancePerso;
    private string $adressePerso;
    private string $telPerso;
    private string $numService; // en référence à numService de Service (=null)

    public function getNomComplet(): string
    {
        return $this->prenomPerso . " " . $this->nomPerso;
    }

    public function getNumMatriculePerso(): string
    {
        return $this->numMatriculePerso;
    }

    public function setNumMatriculePerso(string $numMatriculePerso): void
    {
        $this->numMatriculePerso = $numMatriculePerso;
    }

    public function getMelPerso(): string
    {
        return $this->melPerso;
    }

    public function setMelPerso(string $melPerso): void
    {
        $this->melPerso = $melPerso;
    }

    public function getMdpPerso(): string
    {
        return $this->mdpPerso;
    }

    public function setMdpPerso(string $mdpPerso): void
    {
        $this->mdpPerso = $mdpPerso;
    }

    public function getNomPerso(): string
    {
        return $this->nomPerso;
    }

    public function setNomPerso(string $nomPerso): void
    {
        $this->nomPerso = $nomPerso;
    }

    public function getPrenomPerso(): string
    {
        return $this->prenomPerso;
    }

    public function setPrenomPerso(string $prenomPerso): void
    {
        $this->prenomPerso = $prenomPerso;
    }

    public function getDateNaissancePerso(): DATETIME
    {
        return $this->dateNaissancePerso;
    }

    public function setDateNaissancePerso(DATETIME $dateNaissancePerso): void
    {
        $this->dateNaissancePerso = $dateNaissancePerso;
    }

    public function getAdressePerso(): string
    {
        return $this->adressePerso;
    }

    public function setAdressePerso(string $adressePerso): void
    {
        $this->adressePerso = $adressePerso;
    }

    public function getTelPerso(): string
    {
        return $this->telPerso;
    }

    public function setTelPerso(string $telPerso): void
    {
        $this->telPerso = $telPerso;
    }

    public function getNumService(): string
    {
        return $this->numService;
    }

    public function setNumService(string $numService): void
    {
        $this->numService = $numService;
    }


}

