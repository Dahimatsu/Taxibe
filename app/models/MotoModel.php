<?php

namespace App\Models;

use PDOException;

class MotoModel
{
    private $database;

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

    public function getMotos() {
        $DBH = $this->getDatabase();

        $query = "SELECT * 
                  FROM s3_motos";

        try {
            $STH = $DBH->prepare($query);
            $STH->execute();

            return $STH->fetchAll();
        } catch (PDOException $e) {
            error_log("Erreur : " . $e->getMessage());
            throw $e;
        }

        return null;
    }

    public function getMoto($id) {
        $DBH = $this->getDatabase();

        $query = "SELECT * 
                  FROM s3_motos 
                  WHERE idMoto = ?";

        try {
            $STH = $DBH->prepare($query);
            $STH->bindParam(1, $id);
            $STH->execute();
            return $STH->fetch();
        } catch (PDOException $e) {
            error_log("Erreur : " . $e->getMessage());
            throw $e;
        }
        return null;
    }
}