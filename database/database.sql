CREATE DATABASE taximoto;

USE taximoto;

-- 1.a Carburant
CREATE TABLE s3_carburant (
    id_carburant INT PRIMARY KEY AUTO_INCREMENT,
    type         VARCHAR(50)
);

-- 1.b Prix carburant
CREATE Table s3_prix_carburant (
    id_prix        INT PRIMARY KEY AUTO_INCREMENT,
    id_carburant   INT,
    prix           DECIMAL(10,2),
    date_carburant DATE,
    FOREIGN KEY (id_carburant) REFERENCES s3_carburant(id_carburant)
);

-- 2. Motos
CREATE TABLE s3_motos (
    id_moto      INT PRIMARY KEY AUTO_INCREMENT,
    marque       VARCHAR(50),
    modele       VARCHAR(50),
    id_carburant INT,
    FOREIGN KEY (id_carburant) REFERENCES s3_carburant(id_carburant)
);

-- 3. Conducteurs
CREATE TABLE s3_conducteurs (
    id_conducteur INT PRIMARY KEY AUTO_INCREMENT,
    nom           VARCHAR(50),
    prenom        VARCHAR(50)
);

-- 4. Course
CREATE TABLE s3_course (
    id_course     INT PRIMARY KEY AUTO_INCREMENT,
    id_moto       INT,
    id_conducteur INT,
    date_course   DATE,
    lieu_depart   VARCHAR(100),
    heure_depart  TIME,
    lieu_arrivee  VARCHAR(100),
    heure_arrivee TIME,
    nb_kilometre  DECIMAL(10,2),
    prix_course   DECIMAL(10,2),
    FOREIGN KEY (id_moto) REFERENCES s3_motos(id_moto),
    FOREIGN KEY (id_conducteur) REFERENCES s3_conducteurs(id_conducteur)
);

-- 5. Consommation
CREATE TABLE s3_consommation (
    id_consommation   INT PRIMARY KEY AUTO_INCREMENT,
    id_moto           INT,
    consommation      DECIMAL(10,2),
    kilometrage       DECIMAL(10,2) DEFAULT 100.0,
    date_consommation DATE,
    FOREIGN KEY (id_moto) REFERENCES s3_motos(id_moto)
);

-- 6. Salaire
CREATE TABLE s3_salaire (
    id_salaire    INT PRIMARY KEY AUTO_INCREMENT,
    id_conducteur INT,
    pourcentage   DECIMAL(10,2),
    date_salaire  DATE,
    FOREIGN KEY (id_conducteur) REFERENCES s3_conducteurs(id_conducteur)
);

-- 8. Entretien
CREATE TABLE s3_entretien (
    id_entretien   INT PRIMARY KEY AUTO_INCREMENT,
    id_moto        INT,
    pourcentage    DECIMAL(10,2),
    date_entretien DATE,
    FOREIGN KEY (id_moto) REFERENCES s3_motos(id_moto)
);

CREATE TABLE s3_planning_moto (
    id_planning_moto INT PRIMARY KEY AUTO_INCREMENT,
    id_moto          INT,
    id_conducteur    INT,
    date_planning    DATE,
    FOREIGN KEY (id_moto) REFERENCES s3_motos(id_moto),
    FOREIGN KEY (id_conducteur) REFERENCES s3_conducteurs(id_conducteur)
);

INSERT INTO s3_carburant (type) VALUES
('Essence'),
('Gasoil');

INSERT INTO s3_prix_carburant (id_carburant, prix, date_carburant) VALUES
(1, 5500.00, '2025-12-01'), -- Essence
(2, 5200.00, '2025-12-01'); -- Gasoil

INSERT INTO s3_motos (marque, modele, id_carburant) VALUES
('Yamaha', 'Crypton 110', 1),
('Honda', 'Wave 110', 1),
('TVS', 'HLX 125', 1);

INSERT INTO s3_conducteurs (nom, prenom) VALUES
('Rakoto', 'Jean'),
('Rabe', 'Mamy'),
('Andrianina', 'Tiana');

INSERT INTO s3_consommation (id_moto, consommation, kilometrage, date_consommation) VALUES
(1, 2.3, 100, '2025-12-01'),
(2, 2.5, 100, '2025-12-01'),
(3, 2.8, 100, '2025-12-01');

INSERT INTO s3_salaire (id_conducteur, pourcentage, date_salaire) VALUES
(1, 35.00, '2025-12-01'),
(2, 30.00, '2025-12-01'),
(3, 40.00, '2025-12-01');

INSERT INTO s3_entretien (id_moto, pourcentage, date_entretien) VALUES
(1, 10.00, '2025-12-01'),
(2, 8.00,  '2025-12-01'),
(3, 12.00, '2025-12-01');

INSERT INTO s3_course (
    id_moto, id_conducteur, date_course,
    lieu_depart, heure_depart,
    lieu_arrivee, heure_arrivee,
    nb_kilometre, prix_course
) VALUES
(1, 1, '2025-12-10', 'Andoharanofotsy', '08:15:00', 'Anosy', '08:35:00', 6.5, 7000.00),
(2, 2, '2025-12-10', 'Ambohibao', '09:00:00', 'Analakely', '09:30:00', 8.0, 9000.00),
(3, 3, '2025-12-10', 'Itaosy', '10:10:00', '67 Ha', '10:40:00', 9.2, 10000.00),
(1, 2, '2025-12-10', 'Ankorondrano', '14:00:00', 'Ivandry', '14:15:00', 3.5, 4000.00),
(2, 1, '2025-12-10', 'Analamahitsy', '16:20:00', 'Behoririka', '16:45:00', 5.0, 6000.00);

INSERT INTO s3_planning_moto (id_moto, id_conducteur, date_planning) VALUES
(1, 1, '2025-12-15'),
(2, 2, '2025-12-15'),
(3, 3, '2025-12-15'),

(1, 2, '2025-12-16'),
(2, 3, '2025-12-16'),
(3, 1, '2025-12-16'),

(1, 3, '2025-12-17'),
(2, 1, '2025-12-17'),
(3, 2, '2025-12-17');

