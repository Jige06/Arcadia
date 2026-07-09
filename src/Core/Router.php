<?php

class Router
{
    // Stocke les routes enregistrées, organisées par méthode HTTP (GET/POST)
    private $routes = [];

    // Ajoute une route accessible en GET
    public function get($url, $action)
    {
        $this->routes['GET'][$url] = $action;
    }

    // Ajoute une route accessible en POST
    public function post($url, $action)
    {
        $this->routes['POST'][$url] = $action;
    }

    // Lit l'URL actuelle et appelle le bon controller
    public function dispatch()
    {
        $method = $_SERVER['REQUEST_METHOD'];
        $path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $path = rtrim($path, "/");
        if (empty($path)) $path = '/';

        try {
            if (!isset($this->routes[$method][$path])) {
                http_response_code(404);
                die("Page non trouvée");
            }
            $action = $this->routes[$method][$path];
            $nomController = $action[0];
            $nomMethode = $action[1];
            $controller = new $nomController();
            $controller->$nomMethode();
        } catch (\Throwable $th) {
            http_response_code(500);
            die("Erreur serveur : " . $th->getMessage());
        }
    }
}