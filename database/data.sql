SET NAMES utf8mb4;
-- Jeu de données de test pour Arcadia
-- À exécuter après create_arcadia.sql, sur une base vide

INSERT INTO ROLE (libelle) VALUES
('administrateur'),
('employe'),
('veterinaire');

INSERT INTO RACE (libelle) VALUES
('Lion'),
('Girafe'),
('Manchot'),
('Chimpanzé');

INSERT INTO HABITAT (nom, description, commentaire_habitat) VALUES
('Savane', 'Un vaste espace à ciel ouvert reproduisant les plaines africaines.', 'Habitat entièrement alimenté par des panneaux solaires.'),
('Jungle', 'Une serre tropicale humide et dense, peuplée de primates.', 'Système de récupération d''eau de pluie pour l''arrosage.'),
('Marais', 'Une zone humide dédiée aux espèces aquatiques et semi-aquatiques.', 'Filtration naturelle de l''eau par des plantes locales.');

-- Animaux : race_id et habitat_id référencent l'ordre d'insertion ci-dessus (1 à 4 pour RACE, 1 à 3 pour HABITAT)
INSERT INTO ANIMAL (prenom, etat, race_id, habitat_id) VALUES
('Simba', 'En bonne santé', 1, 1),
('Nala', 'En bonne santé', 1, 1),
('Gigi', 'Sous surveillance', 2, 1),
('Coco', 'En bonne santé', 4, 2),
('Kimbo', 'En bonne santé', 4, 2),
('Pingu', 'En bonne santé', 3, 3);

INSERT INTO IMAGE (chemin, habitat_id, animal_id) VALUES
('https://picsum.photos/seed/savane/500/350', 1, NULL),
('https://picsum.photos/seed/jungle/500/350', 2, NULL),
('https://picsum.photos/seed/marais/500/350', 3, NULL);

INSERT INTO SERVICE (nom, description) VALUES
('Restauration', 'Un espace snack proposant des produits locaux et de saison.'),
('Visite guidée des habitats', 'Une visite gratuite accompagnée d''un guide du zoo.'),
('Petit train', 'Un tour du zoo en petit train pour les visiteurs.');

INSERT INTO AVIS (pseudo, commentaire, is_visible) VALUES
('VisiteurCurieux', 'Superbe zoo, très respectueux des animaux !', TRUE),
('FamilleDupont', 'Les enfants ont adoré la savane.', TRUE),
('Anonyme', 'Un avis en attente de validation.', FALSE);