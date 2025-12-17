<?php

namespace App\Models;

use PDOException;

class ConducteurModel {

    private $database;
    private $id;
    private $nom;
    private $prenom;

    public function __construct($database) {
        $this->setDatabase($database);
    }

    public function getDatabase()
    {
        return $this->database;
    }

    public function setDatabase($database)
    {
        $this->database = $database;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getNom()
    {
        return $this->nom;
    }

    public function setNom($nom)
    {
        $this->nom = $nom;
    }

    public function getPrenom()
    {
        return $this->prenom;
    }

    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;
    }

    public function getConducteurs()
    {
        $DBH = $this->getDatabase();

        $query = "SELECT * 
                  FROM conducteurs";

        try {
            $STH = $DBH->prepare($query);
            $STH->execute();

            return $STH->fetchAll();
        } catch (PDOException $e) {
            error_log($e->getMessage());
            throw $e;
        }

        return null;
    }

    public function getConducteur($id)
    {
        $DBH = $this->getDatabase();

        $query = "SELECT * 
                  FROM conducteurs 
                  WHERE id_conducteur = ?";

        try {
            $STH = $DBH->prepare($query);
            $STH->bindParam(1,$id);
            $STH->execute();

            return $STH->fetch();
        } catch (PDOException $e) {
            error_log($e->getMessage());
            throw $e;
        }
    }
}