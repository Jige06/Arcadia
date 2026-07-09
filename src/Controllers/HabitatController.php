<?php

class HabitatController extends Controller
{
    // affiche la liste statique des habitats
    public function index()
    {
        $repository = new HabitatRepository();
        $habitats = $repository->findAll();

        $this->render('habitat/index', ['habitats' => $habitats]);
    }

    // renvoie le détail d'un habitat en JSON,
    // consommé par le JavaScript pour un affichage dynamique sans rechargement
    public function detail()
    {
        $habitatId = $_GET['id'] ?? null;

        if ($habitatId === null) {
            http_response_code(400);
            echo json_encode(['erreur' => 'Identifiant manquant']);
            return;
        }

        $repository = new HabitatRepository();
        $habitat = $repository->findById($habitatId);

        if ($habitat === null) {
            http_response_code(404);
            echo json_encode(['erreur' => 'Habitat non trouvé']);
            return;
        }

        // On construit un tableau simple (pas l'objet PHP directement)
        // pour ne renvoyer que les données utiles au format JSON
        $animaux = [];
        foreach ($habitat->getAnimaux() as $animal) {
            $animaux[] = [
                'id' => $animal->getAnimalId(),
                'prenom' => $animal->getPrenom(),
                'etat' => $animal->getEtat(),
                'race' => $animal->getRaceLibelle(),
            ];
        }

        header('Content-Type: application/json');
        echo json_encode([
            'nom' => $habitat->getNom(),
            'description' => $habitat->getDescription(),
            'animaux' => $animaux,
        ]);
    }

    // incrémente la statistique MongoDB de consultation d'un animal,
    // appelé en arrière-plan par le JavaScript au clic sur un animal
    public function consultation()
    {
        $donnees = json_decode(file_get_contents('php://input'), true);
        $animalId = $donnees['animal_id'] ?? null;
        $prenomAnimal = $donnees['prenom'] ?? null;

        if ($animalId === null || $prenomAnimal === null) {
            http_response_code(400);
            echo json_encode(['erreur' => 'Données manquantes']);
            return;
        }

        try {
            $statistiqueRepository = new StatistiqueRepository();
            $statistiqueRepository->incrementerConsultation($animalId, $prenomAnimal);
        } catch (\Throwable $e) {
            // Une statistique ratée ne doit jamais faire planter la navigation du visiteur
            error_log('Erreur MongoDB (consultation animal) : ' . $e->getMessage());
        }

        header('Content-Type: application/json');
        echo json_encode(['success' => true]);
    }
}