-- Base de données Arcadia (zoo)
-- Ordre de création : tables sans dépendances d'abord, puis tables avec clés étrangères

CREATE TABLE ROLE (
    role_id INT AUTO_INCREMENT,
    libelle VARCHAR(50) NOT NULL,
    PRIMARY KEY (role_id)
);

CREATE TABLE UTILISATEUR (
    id_utilisateur INT AUTO_INCREMENT,
    email VARCHAR(100) NOT NULL,
    password VARCHAR(255) NOT NULL,
    nom VARCHAR(50) NOT NULL,
    prenom VARCHAR(50) NOT NULL,
    role_id INT NOT NULL,
    PRIMARY KEY (id_utilisateur),
    UNIQUE (email),
    FOREIGN KEY (role_id) REFERENCES ROLE(role_id)
);

CREATE TABLE RACE (
    race_id INT AUTO_INCREMENT,
    libelle VARCHAR(50) NOT NULL,
    PRIMARY KEY (race_id)
);

CREATE TABLE HABITAT (
    habitat_id INT AUTO_INCREMENT,
    nom VARCHAR(50) NOT NULL,
    description VARCHAR(255) NOT NULL,
    commentaire_habitat VARCHAR(255),
    PRIMARY KEY (habitat_id)
);

CREATE TABLE ANIMAL (
    animal_id INT AUTO_INCREMENT,
    prenom VARCHAR(50) NOT NULL,
    etat VARCHAR(50) NOT NULL,
    race_id INT NOT NULL,
    habitat_id INT NOT NULL,
    PRIMARY KEY (animal_id),
    FOREIGN KEY (race_id) REFERENCES RACE(race_id),
    FOREIGN KEY (habitat_id) REFERENCES HABITAT(habitat_id)
);

CREATE TABLE IMAGE (
    image_id INT AUTO_INCREMENT,
    chemin VARCHAR(255) NOT NULL,
    habitat_id INT,
    animal_id INT,
    PRIMARY KEY (image_id),
    FOREIGN KEY (habitat_id) REFERENCES HABITAT(habitat_id),
    FOREIGN KEY (animal_id) REFERENCES ANIMAL(animal_id)
);

CREATE TABLE RAPPORT_VETERINAIRE (
    rapport_veterinaire_id INT AUTO_INCREMENT,
    date_passage DATE NOT NULL,
    nourriture VARCHAR(100) NOT NULL,
    grammage INT NOT NULL,
    detail VARCHAR(255),
    animal_id INT NOT NULL,
    id_utilisateur INT NOT NULL,
    PRIMARY KEY (rapport_veterinaire_id),
    FOREIGN KEY (animal_id) REFERENCES ANIMAL(animal_id),
    FOREIGN KEY (id_utilisateur) REFERENCES UTILISATEUR(id_utilisateur)
);

CREATE TABLE SERVICE (
    service_id INT AUTO_INCREMENT,
    nom VARCHAR(50) NOT NULL,
    description VARCHAR(255) NOT NULL,
    PRIMARY KEY (service_id)
);

CREATE TABLE AVIS (
    avis_id INT AUTO_INCREMENT,
    pseudo VARCHAR(50) NOT NULL,
    commentaire VARCHAR(255) NOT NULL,
    is_visible BOOLEAN NOT NULL DEFAULT FALSE,
    PRIMARY KEY (avis_id)
);