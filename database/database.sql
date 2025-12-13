CREATE DATABASE taxibe OWNER "brandy-allan";

GRANT ALL PRIVILEGES ON DATABASE taxibe TO "brandy-allan";

CREATE TABLE chauffeur (
    id_chauffeur SERIAL PRIMARY KEY,
    nom VARCHAR(100),
    date_naissance DATE,
    date_embauche DATE,
    actif BOOLEAN
);

CREATE TABLE voiture (
    id_voiture SERIAL PRIMARY KEY,
    immatriculation VARCHAR(10),
    marque VARCHAR(20),
    modele VARCHAR(20),
    nb_place INTEGER,
    actif BOOLEAN
);

CREATE TABLE trajet (
    id_trajet SERIAL PRIMARY KEY,
    id_voiture INTEGER REFERENCES voiture(id_voiture),
    id_chauffeur INTEGER REFERENCES chauffeur(id_chauffeur),
    lieu_depart VARCHAR(100),
    lieu_arrivee VARCHAR(100),
    date_depart TIMESTAMP,
    date_arrivee TIMESTAMP,
    montant_recette NUMBER(10, 2),
    montant_carburant NUMBER(10,2),
    nb_kilometre INTEGER
);