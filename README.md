# Arcadia — Application web du zoo

## Prérequis

- PHP 8.2+, avec les extensions `pdo_mysql` et `mongodb` activées
- MySQL
- MongoDB
- Composer
- Docker et Docker Compose (pour le déploiement conteneurisé)

## Installation en local (sans Docker)

1. Cloner le dépôt :
   ```bash
   git clone https://github.com/Jige06/Arcadia.git
   cd Arcadia
   ```

2. Installer les dépendances PHP :
   ```bash
   composer install
   ```

3. Copier le fichier d'environnement et l'adapter à votre configuration :
   ```bash
   cp .env.example .env
   ```

4. Créer la base de données MySQL, puis exécuter dans l'ordre :
   - `database/create_arcadia.sql` (création des tables)
   - `database/data.sql` (jeu de données de test)

5. Lancer MongoDB en local (`mongod`).

6. Configurer un virtual host (Apache/Laragon) pointant vers le dossier `public/`, avec le module `mod_rewrite` activé et `AllowOverride All`.

## Déploiement avec Docker

Aucune installation de PHP, MySQL ou MongoDB n'est nécessaire sur la machine hôte : tout est conteneurisé.

1. Cloner le dépôt (voir ci-dessus).

2. Lancer l'ensemble des services :
   ```bash
   docker compose up -d --build
   ```
   Cette commande construit l'image de l'application (`Dockerfile`), puis démarre 3 conteneurs :
   - `arcadia-app` : PHP/Apache, exposé sur le port `8080`
   - `arcadia-mysql` : MySQL, exposé sur le port `3307`
   - `arcadia-mongo` : MongoDB, exposé sur le port `27018`

3. Au tout premier démarrage, MySQL exécute automatiquement les scripts SQL présents dans `database/` (création des tables puis insertion des données de test), grâce au montage du dossier sur `/docker-entrypoint-initdb.d`.

4. L'application est accessible sur : **http://localhost:8080**

5. Pour arrêter les conteneurs :
   ```bash
   docker compose down
   ```
   Pour tout arrêter **et supprimer les données** (utile pour repartir d'une base vierge) :
   ```bash
   docker compose down -v
   ```

## Choix techniques

- Les identifiants de connexion (MySQL, MongoDB) sont fournis à l'application via des variables d'environnement. En local, elles sont lues depuis un fichier `.env` (non versionné). En Docker, elles sont directement injectées par `docker-compose.yml` et prennent la priorité sur `.env`, puisque les conteneurs communiquent entre eux par leur nom de service (`db`, `mongo`) et non par `localhost`.
- Le mot de passe MySQL est en clair dans `docker-compose.yml` à but de démonstration ; en production, il serait stocké dans un gestionnaire de secrets ou un fichier `.env` dédié non commité.