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
(1, 5100.00, '2025-12-10'), -- Essence
(2, 4950.00, '2025-12-10'); -- Gasoil

INSERT INTO s3_motos (marque, modele, id_carburant) VALUES
('Yamaha', 'Crypton', 1),
('Yamaha', 'T-Max', 1),
('Honda', 'Wave 110', 1),
('Honda', 'Wave 125', 1),

('Honda', 'Scoopy', 1),
('Honda', 'Click 125', 1),

('Suzuki', 'Smash', 1),
('Suzuki', 'Raider 150', 1),

('Bajaj', 'Boxer 100', 1),
('Bajaj', 'Discover 125', 1);

INSERT INTO s3_consommation (id_moto, consommation, date_consommation) VALUES
-- 4 motos à 2 L / 100
(1, 2.0, '2025-01-01'),
(2, 2.0, '2025-01-01'),
(3, 2.0, '2025-01-01'),
(4, 2.0, '2025-01-01'),

-- 2 motos à 1.6 L / 100
(5, 1.6, '2025-01-01'),
(6, 1.6, '2025-01-01'),

-- 4 motos à 1.3 L / 100
(7, 1.3, '2025-01-01'),
(8, 1.3, '2025-01-01'),
(9, 1.3, '2025-01-01'),
(10,1.3, '2025-01-01');

INSERT INTO s3_entretien (id_moto, pourcentage, date_entretien) VALUES
-- 4 motos à 10 %
(1, 10.0, '2025-01-01'),
(2, 10.0, '2025-01-01'),
(3, 10.0, '2025-01-01'),
(4, 10.0, '2025-01-01'),

-- 2 motos à 15 %
(5, 15.0, '2025-01-01'),
(6, 15.0, '2025-01-01'),

-- 4 motos à 11.5 %
(7, 11.5, '2025-01-01'),
(8, 11.5, '2025-01-01'),
(9, 11.5, '2025-01-01'),
(10,11.5,'2025-01-01');

INSERT INTO s3_conducteurs (nom, prenom) VALUES
('Rakoto', 'Jean'),
('Rabe', 'Mamy'),
('Randria', 'Tiana'),
('Andry', 'Hery'),
('Rasoanaivo', 'Feno'),
('Razafy', 'Toky');

INSERT INTO s3_salaire (id_conducteur, pourcentage, date_salaire) VALUES
-- 2 chauffeurs à 15 %
(1, 15.0, '2025-01-01'),
(2, 15.0, '2025-01-01'),

-- 2 chauffeurs à 25 %
(3, 25.0, '2025-01-01'),
(4, 25.0, '2025-01-01'),

-- 2 chauffeurs à 19.5 %
(5, 19.5, '2025-01-01'),
(6, 19.5, '2025-01-01');


CREATE OR REPLACE VIEW v_course_details AS
SELECT
    c.id_course,
    cd.nom AS nom_conducteur,
    cd.prenom AS prenom_conducteur,

    (SELECT s.pourcentage
     FROM s3_salaire s
     WHERE s.id_conducteur = c.id_conducteur
       AND s.date_salaire <= c.date_course
     ORDER BY s.date_salaire DESC
     LIMIT 1) AS salaire,

    m.marque AS marque_moto,
    m.modele AS modele_moto,

    (SELECT cons.consommation
     FROM s3_consommation cons
     WHERE cons.id_moto = c.id_moto
       AND cons.date_consommation <= c.date_course
     ORDER BY cons.date_consommation DESC
     LIMIT 1) AS consommation,

    (SELECT pc.prix
     FROM s3_prix_carburant pc
     WHERE pc.id_carburant = m.id_carburant
       AND pc.date_carburant <= c.date_course
     ORDER BY pc.date_carburant DESC, pc.id_prix DESC
     LIMIT 1) AS prix_carburant,

    (SELECT e.pourcentage
     FROM s3_entretien e
     WHERE e.id_moto = c.id_moto
       AND e.date_entretien <= c.date_course
     ORDER BY e.date_entretien DESC
     LIMIT 1) AS entretien,

    c.prix_course,
    c.date_course,
    c.nb_kilometre
FROM s3_course c
JOIN s3_conducteurs cd ON c.id_conducteur = cd.id_conducteur
JOIN s3_motos m ON c.id_moto = m.id_moto;


CREATE OR REPLACE VIEW v_recette_journaliere AS
SELECT
    c.date_course,
    SUM(c.prix_course) AS recette_totale
FROM s3_course c
GROUP BY c.date_course;

CREATE OR REPLACE VIEW v_depense_journaliere AS
SELECT 
    v.date_course,
    SUM(
        ((v.consommation / 100) * v.prix_carburant * v.nb_kilometre) + 
        ((v.salaire / 100) * v.prix_course) + 
        ((v.entretien / 100) * v.prix_course)
    ) AS depense_totale
FROM v_course_details v
GROUP BY v.date_course;

CREATE OR REPLACE VIEW v_rapport_journalier AS
SELECT
    rj.date_course AS date,
    rj.recette_totale AS recette,
    dj.depense_totale AS depense,
    (rj.recette_totale - dj.depense_totale) AS benefice
FROM v_recette_journaliere rj
JOIN v_depense_journaliere dj ON rj.date_course = dj.date_course;

CREATE OR REPLACE VIEW v_conducteurs_disponibles AS
SELECT *
FROM s3_conducteurs
WHERE id_conducteur NOT IN (
    SELECT id_conducteur
    FROM s3_course
    WHERE heure_arrivee IS NULL
) AND id_conducteur IN (
    SELECT id_conducteur
    FROM s3_planning_moto
);
