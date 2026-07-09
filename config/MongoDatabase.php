<?php

class MongoDatabase
{
    private static $instance = null;
    private $client;
    private $dbName;

    private function __construct()
    {
        $host = $_ENV['MONGO_HOST'] ?? 'localhost';
        $port = $_ENV['MONGO_PORT'] ?? '27017';
        $this->dbName = $_ENV['MONGO_DB'] ?? 'arcadia_stats';

        $this->client = new \MongoDB\Client("mongodb://{$host}:{$port}");
    }

    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new MongoDatabase();
        }

        return self::$instance;
    }

    public function getDatabase()
    {
        return $this->client->selectDatabase($this->dbName);
    }

    private function __clone() {}
}