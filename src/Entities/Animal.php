<?php

class Animal
{
    private $animalId;
    private $prenom;
    private $etat;
    private $raceId;
    private $habitatId;
    // Libellé de la race, rempli par le repository via une jointure (évite un 2e aller-retour BDD)
    private $raceLibelle;
    private $images = [];

    public function getAnimalId()
    {
        return $this->animalId;
    }

    public function setAnimalId($animalId)
    {
        $this->animalId = $animalId;
        return $this;
    }

    public function getPrenom()
    {
        return $this->prenom;
    }

    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;
        return $this;
    }

    public function getEtat()
    {
        return $this->etat;
    }

    public function setEtat($etat)
    {
        $this->etat = $etat;
        return $this;
    }

    public function getRaceId()
    {
        return $this->raceId;
    }

    public function setRaceId($raceId)
    {
        $this->raceId = $raceId;
        return $this;
    }

    public function getHabitatId()
    {
        return $this->habitatId;
    }

    public function setHabitatId($habitatId)
    {
        $this->habitatId = $habitatId;
        return $this;
    }

    public function getRaceLibelle()
    {
        return $this->raceLibelle;
    }

    public function setRaceLibelle($raceLibelle)
    {
        $this->raceLibelle = $raceLibelle;
        return $this;
    }

    public function getImages()
    {
        return $this->images;
    }

    public function setImages($images)
    {
        $this->images = $images;
        return $this;
    }
}
