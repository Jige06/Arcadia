<?php

class Habitat
{
    private $habitatId;
    private $nom;
    private $description;
    private $commentaireHabitat;
    // Tableau d'objets Animal appartenant à cet habitat (rempli par le repository)
    private $animaux = [];
    // Tableau de chemins d'images (rempli par le repository)
    private $images = [];

    public function getHabitatId()
    {
        return $this->habitatId;
    }

    public function setHabitatId($habitatId)
    {
        $this->habitatId = $habitatId;
        return $this;
    }

    public function getNom()
    {
        return $this->nom;
    }

    public function setNom($nom)
    {
        $this->nom = $nom;
        return $this;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function setDescription($description)
    {
        $this->description = $description;
        return $this;
    }

    public function getCommentaireHabitat()
    {
        return $this->commentaireHabitat;
    }

    public function setCommentaireHabitat($commentaireHabitat)
    {
        $this->commentaireHabitat = $commentaireHabitat;
        return $this;
    }

    public function getAnimaux()
    {
        return $this->animaux;
    }

    public function setAnimaux($animaux)
    {
        $this->animaux = $animaux;
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
