<?php

class Database
{
    // Unique instance de la classe (Singleton) : null tant qu'aucune connexion n'existe
    private static $instance = null;
    private $pdo;

    // Constructeur privé : personne ne peut faire "new Database()" en dehors de la classe
    private function __construct()
    {
        $host = $_ENV['DB_HOST'];
        $dbname = $_ENV['DB_NAME'];
        $user = $_ENV['DB_USER'];
        $password = $_ENV['DB_PASSWORD'];

        try {
            $this->pdo = new PDO(
                "mysql:host=$host;dbname=$dbname;charset=utf8",
                $user,
                $password,
                [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
                ]
            );
        } catch (PDOException $e) {
            die("Erreur de connexion: " . $e->getMessage());
        }
    }

    // Renvoie toujours la même instance : la crée seulement au premier appel
    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new Database();
        }

        return self::$instance;
    }

    // Donne accès à la connexion PDO pour que les repositories puissent l'utiliser
    public function getConnection()
    {
        return $this->pdo;
    }

    // Empêche de dupliquer l'instance avec clone (obligatoire pour un vrai Singleton)
    private function __clone() {}
}