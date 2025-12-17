CREATE DATABASE taximoto ;

USE taximoto;

-- 1.a Carburant
CREATE TABLE carburant (
    id_carburant INT PRIMARY KEY AUTO_INCREMENT,
    type         VARCHAR(50)
);

-- 1.b Prix carburant
CREATE Table prix_carburant (
    id_prix        INT PRIMARY KEY AUTO_INCREMENT,
    id_carburant   INT,
    prix           DECIMAL(10,2),
    date_carburant DATE,
    FOREIGN KEY (id_carburant) REFERENCES carburant(id_carburant)
);

-- 2. Motos
CREATE TABLE motos (
    id_moto      INT PRIMARY KEY AUTO_INCREMENT,
    marque       VARCHAR(50),
    modele       VARCHAR(50),
    id_carburant INT,
    FOREIGN KEY (id_carburant) REFERENCES carburant(id_carburant)
);

-- 3. Conducteurs
CREATE TABLE conducteurs (
    id_conducteur INT PRIMARY KEY AUTO_INCREMENT,
    nom           VARCHAR(50),
    prenom        VARCHAR(50)
);

-- 4. Course
CREATE TABLE course (
    id_course     INT PRIMARY KEY AUTO_INCREMENT,
    id_moto       VARCHAR(10),
    id_conducteur VARCHAR(10),
    date_course   DATE,
    lieu_depart   VARCHAR(100),
    heure_depart  TIME,
    lieu_arrivee  VARCHAR(100),
    heure_arrivee TIME,
    nb_kilometre  DECIMAL(10,2),
    prix_course   DECIMAL(10,2),
    FOREIGN KEY (id_moto) REFERENCES motos(id_moto),
    FOREIGN KEY (id_conducteur) REFERENCES conducteurs(id_conducteur)
);

-- 5. Consommation
CREATE TABLE consommation (
    id_consommation   INT PRIMARY KEY AUTO_INCREMENT,
    id_moto           INT,
    consommation      DECIMAL(10,2),
    kilometrage       DECIMAL(10,2) DEFAULT 100.0,
    date_consommation DATE,
    FOREIGN KEY (id_moto) REFERENCES motos(id_moto)
);

-- 6. Salaire
CREATE TABLE salaire (
    id_salaire    INT PRIMARY KEY AUTO_INCREMENT,
    id_conducteur INT,
    pourcentage   DECIMAL(10,2),
    date_salaire  DATE,
    FOREIGN KEY (id_conducteur) REFERENCES conducteurs(id_conducteur)
);

-- 8. Entretien
CREATE TABLE entretien (
    id_entretien   INT PRIMARY KEY AUTO_INCREMENT,
    id_moto        INT,
    pourcentage    DECIMAL(10,2),
    date_entretien DATE,
    FOREIGN KEY (id_moto) REFERENCES motos(id_moto)
);