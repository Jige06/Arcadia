<?php

abstract class Controller
{
    // Affiche une vue en l'entourant automatiquement du header et du footer
    public function render($vue, $donnees = [])
    {
        // Transforme le tableau $donnees en variables utilisables directement dans la vue
        extract($donnees);

        require_once(__DIR__ . '/../views/layout/header.php');
        require_once(__DIR__ . "/../views/{$vue}.php");
        require_once(__DIR__ . '/../views/layout/footer.php');
    }

    // Redirige l'utilisateur vers une autre page et arrête le script
    public function redirect(string $url)
    {
        header('Location: ' . $url);
        die(); // Empêche toute exécution de code après la redirection
    }

    // Bloque l'accès à une page si l'utilisateur n'est pas connecté
    public function verifyConnexion($url = "/connexion")
    {
        if (!isset($_SESSION['id_user'])) {
            $this->redirect($url);
            return;
        }
    }

    // Indique si la requête actuelle est un envoi de formulaire (POST)
    public function isPost(): bool
    {
        return ($_SERVER['REQUEST_METHOD'] ?? 'GET') === 'POST';
    }

    // Récupère une donnée de formulaire en la nettoyant (espaces + caractères HTML dangereux)
    public function getPostData(string $key, $default = null)
    {
        if (!isset($_POST[$key])) {
            return $default;
        }

        return is_string($_POST[$key])
            ? htmlspecialchars(trim($_POST[$key]), ENT_QUOTES, 'UTF-8')
            : $_POST[$key];
    }

    // Crée (ou récupère) le jeton anti-CSRF de la session en cours
    public function generateCsrfToken(): string
    {
        if (empty($_SESSION['csrf_token'])) {
            $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
        }

        return $_SESSION['csrf_token'];
    }

    // Vérifie que le jeton reçu d'un formulaire correspond à celui de la session
    public function verifyCsrfToken(?string $token): bool
    {
        // hash_equals() protège contre les attaques basées sur le temps de comparaison
        return isset($_SESSION['csrf_token'])
            && $token !== null
            && hash_equals($_SESSION['csrf_token'], $token);
    }
}