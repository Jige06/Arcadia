<?php

class StatistiqueRepository
{
    private $collection;

    public function __construct()
    {
        $database = MongoDatabase::getInstance()->getDatabase();
        $this->collection = $database->selectCollection('consultations_animaux');
    }

    // Incrémente de 1 le compteur de consultation de l'animal donné.
    // upsert => true : si aucun document n'existe encore pour cet animal, il est créé avec compteur = 1
    public function incrementerConsultation($animalId, $prenomAnimal)
    {
        $this->collection->updateOne(
            ['animal_id' => $animalId],
            [
                '$set' => ['prenom' => $prenomAnimal],
                '$inc' => ['nombre_consultations' => 1],
            ],
            ['upsert' => true]
        );
    }
}