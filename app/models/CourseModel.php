<?php

namespace App\Models;

use PDOException;
use app\models\MotoModel;

class CourseModel
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

    public function getCourses() {
        $DBH = $this->getDatabase();

        $query = "SELECT * 
                  FROM s3_courses";

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

    public function getCourse($id) {
        $DBH = $this->getDatabase();

        $query = "SELECT * 
                  FROM s3_courses 
                  WHERE id = ?";

        try {
            $STH = $DBH->prepare($query);
            $STH->bindParam(1, $id);
            $STH->execute();
            return $STH->fetch();
        } catch (PDOException $e) {
            error_log($e->getMessage());
            throw $e;
        }
        return null;
    }

    public function insertCourse($course) {
        $motoModeml = new MotoModel($this->getDatabase());
        $idMoto = $motoModeml->getidMotoByConducteur($course['id_conducteur']);

        $DBH = $this->getDatabase();

        $sql = "INSERT INTO s3_course (
                    id_moto,
                    id_conducteur,
                    date_course,
                    lieu_depart,
                    heure_depart,
                    lieu_arrivee,
                    nb_kilometre,
                    prix_course
                ) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

        $stmt = $DBH->prepare($sql);

        $stmt->execute([
                $idMoto['id_moto'],
                $course['id_conducteur'],
                $course['date_course'],
                $course['lieu_depart'],
                $course['heure_depart'],
                $course['lieu_arrivee'],
                $course['nb_kilometre'],
                $course['prix_course']
                ]);
    }

    public function getPlanning() {
        $DBH = $this->getDatabase();

        $query = "SELECT p.id_planning_moto id_planning, p.date_planning date_planning, m.marque marque, m.modele modele, c.prenom prenom, c.nom nom
                  FROM s3_planning_moto p
                  JOIN s3_motos m ON p.id_moto = m.id_moto
                  JOIN s3_conducteurs c ON p.id_conducteur = c.id_conducteur
                  ORDER BY p.date_planning DESC";

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

}