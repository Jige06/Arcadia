<?php

class HabitatRepository
{
    private $pdo;

    public function __construct()
    {
        $this->pdo = Database::getInstance()->getConnection();
    }

    // Récupère tous les habitats avec leurs images, pour la vue liste (US4)
    public function findAll()
    {
        $sql = "SELECT h.habitat_id, h.nom, h.description, h.commentaire_habitat, i.chemin
                FROM HABITAT h
                LEFT JOIN IMAGE i ON i.habitat_id = h.habitat_id
                ORDER BY h.habitat_id";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        $lignes = $stmt->fetchAll();

        // Regroupe les lignes SQL (une par image) en un seul objet Habitat par habitat_id
        $habitats = [];
        foreach ($lignes as $ligne) {
            $id = $ligne['habitat_id'];

            if (!isset($habitats[$id])) {
                $habitat = new Habitat();
                $habitat->setHabitatId($ligne['habitat_id']);
                $habitat->setNom($ligne['nom']);
                $habitat->setDescription($ligne['description']);
                $habitat->setCommentaireHabitat($ligne['commentaire_habitat']);
                $habitats[$id] = $habitat;
            }

            if ($ligne['chemin'] !== null) {
                $images = $habitats[$id]->getImages();
                $images[] = $ligne['chemin'];
                $habitats[$id]->setImages($images);
            }
        }

        return array_values($habitats);
    }

    // Récupère un habitat précis avec ses animaux (et la race de chacun), pour le détail dynamique (US4 + C4)
    public function findById($habitatId)
    {
        // 1. L'habitat lui-même
        $sql = "SELECT habitat_id, nom, description, commentaire_habitat FROM HABITAT WHERE habitat_id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['id' => $habitatId]);
        $ligneHabitat = $stmt->fetch();

        if (!$ligneHabitat) {
            return null;
        }

        $habitat = new Habitat();
        $habitat->setHabitatId($ligneHabitat['habitat_id']);
        $habitat->setNom($ligneHabitat['nom']);
        $habitat->setDescription($ligneHabitat['description']);
        $habitat->setCommentaireHabitat($ligneHabitat['commentaire_habitat']);

        // 2. Les animaux de cet habitat, avec le libellé de leur race (jointure)
        $sqlAnimaux = "SELECT a.animal_id, a.prenom, a.etat, r.libelle AS race_libelle
                       FROM ANIMAL a
                       JOIN RACE r ON r.race_id = a.race_id
                       WHERE a.habitat_id = :id";
        $stmtAnimaux = $this->pdo->prepare($sqlAnimaux);
        $stmtAnimaux->execute(['id' => $habitatId]);
        $lignesAnimaux = $stmtAnimaux->fetchAll();

        $animaux = [];
        foreach ($lignesAnimaux as $ligneAnimal) {
            $animal = new Animal();
            $animal->setAnimalId($ligneAnimal['animal_id']);
            $animal->setPrenom($ligneAnimal['prenom']);
            $animal->setEtat($ligneAnimal['etat']);
            $animal->setRaceLibelle($ligneAnimal['race_libelle']);
            $animaux[] = $animal;
        }
        $habitat->setAnimaux($animaux);

        return $habitat;
    }
}
