<?php

namespace App\Models;

use PDOException;

class ConducteurModel {

    private $database;

    public function __construct($database) {
        $this->setDatabase($database);
    }

    public function getDatabase(): mixed
    {
        return $this->database;
    }

    public function setDatabase($database)
    {
        $this->database = $database;
    }

    public function getConducteurs()
    {
        $DBH = $this->getDatabase();

        $query = "SELECT * 
                  FROM s3_conducteurs";

        try {
            $STH = $DBH->prepare($query);
            $STH->execute();

            return $STH->fetchAll();
        } catch (PDOException $e) {
            error_log($e->getMessage());
            throw $e;
        }

    }

    public function getConducteur($id)
    {
        $DBH = $this->getDatabase();

        $query = "SELECT * 
                  FROM s3_conducteurs 
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