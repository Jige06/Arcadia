<?php

session_start();

// Chargement des variables d'environnement
$env = parse_ini_file(__DIR__ . '/../.env', false, INI_SCANNER_RAW);
foreach ($env as $key => $value) {
    if (!isset($_ENV[$key])) {
        $_ENV[$key] = $value;
    }
}

// Autoloader maison : charge automatiquement la bonne classe selon son nom
spl_autoload_register(function ($class) {
    $chemins = [
        __DIR__ . '/../config/' . $class . '.php',
        __DIR__ . '/../src/Core/' . $class . '.php',
        __DIR__ . '/../src/Controllers/' . $class . '.php',
        __DIR__ . '/../src/Entities/' . $class . '.php',
        __DIR__ . '/../src/Repositories/' . $class . '.php',
    ];

    foreach ($chemins as $chemin) {
        if (file_exists($chemin)) {
            require_once $chemin;
            return;
        }
    }
});

$router = new Router();

// Déclaration des routes
$router->get('/', ['HomeController', 'index']);

$router->dispatch();