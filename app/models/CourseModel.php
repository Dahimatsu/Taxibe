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

    public function getDatabase(): mixed
    {
        return $this->database;
    }

    public function setDatabase($database)
    {
        $this->database = $database;
    }

    public function getCourses() {
        $DBH = $this->getDatabase();

        $query = "SELECT c.id_course, c.date_course, c.lieu_depart, c.lieu_arrivee, c.heure_depart, c.heure_arrivee, c.nb_kilometre, c.prix_course,
                       m.marque, m.modele,
                       cd.nom, cd.prenom
                  FROM s3_course c
                  JOIN s3_motos m 
                  ON c.id_moto = m.id_moto 
                  JOIN s3_conducteurs cd 
                  ON c.id_conducteur = cd.id_conducteur
                  ORDER BY c.date_course DESC";

        try {
            $STH = $DBH->prepare($query);
            $STH->execute();
            return $STH->fetchAll();
        } catch (PDOException $e) {
            error_log($e->getMessage());
            throw $e;
        }
    }

    public function getCourse($id) {
        $DBH = $this->getDatabase();

        $query = "SELECT c.id_course, c.id_conducteur, c.id_moto, c.date_course, c.lieu_depart, c.lieu_arrivee, c.heure_depart, c.heure_arrivee, c.nb_kilometre, c.prix_course,
                       m.marque, m.modele,
                       cd.nom, cd.prenom
                  FROM s3_course c
                  JOIN s3_motos m 
                  ON c.id_moto = m.id_moto 
                  JOIN s3_conducteurs cd 
                  ON c.id_conducteur = cd.id_conducteur
                  WHERE c.id_course = ?";

        try {
            $STH = $DBH->prepare($query);
            $STH->execute([$id]);
            return $STH->fetch();
        } catch (PDOException $e) {
            error_log($e->getMessage());
            throw $e;
        }
    }

    public function getLastId() {
        $DBH = $this->getDatabase();

        $query = "SELECT MAX(id_course) AS last_id
                  FROM s3_course";

        try {
            $STH = $DBH->prepare($query);
            $STH->execute();
            $result = $STH->fetch();
            return $result['last_id'];
        } catch (PDOException $e) {
            error_log($e->getMessage());
            throw $e;
        }
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

        try {

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
            
        } catch (\Throwable $th) {
            error_log($th->getMessage());
            throw $th;
        }
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
    }

    public function updateCourse($id, $course) {
        $DBH = $this->getDatabase();

        $motoModel = new MotoModel($this->getDatabase());
        $idMoto = $motoModel->getidMotoByConducteur($course['id_conducteur']);

        $query = "UPDATE s3_course
                  SET id_conducteur = ?,
                      id_moto = ?,
                      date_course = ?,
                      lieu_depart = ?,
                      heure_depart = ?,
                      lieu_arrivee = ?,
                      nb_kilometre = ?,
                      prix_course = ?
                  WHERE id_course = ?";
        
        try {
            $STH = $DBH->prepare($query);
            $STH->execute([
                $course['id_conducteur'],
                $idMoto['id_moto'],
                $course['date_course'],
                $course['lieu_depart'],
                $course['heure_depart'],
                $course['lieu_arrivee'],
                $course['nb_kilometre'],
                $course['prix_course'],
                $id
            ]);
        } catch (PDOException $e) {
            error_log($e->getMessage());
            throw $e;
        }
        return null;
    }

    public function validerCourse($id) {
        $DBH = $this->getDatabase();

        $query = "UPDATE s3_course
                  SET heure_arrivee = CURRENT_TIME()
                  WHERE id_course = ?";
        
        try {
            $STH = $DBH->prepare($query);
            $STH->execute([$id]);
        } catch (PDOException $e) {
            error_log($e->getMessage());
            throw $e;
        }
        return null;
    }

    public function getRapport() {
        $DBH = $this->getDatabase();

        $query = "SELECT * 
                  FROM v_rapport_journalier
                  ORDER BY date DESC";

        try {
            $STH = $DBH->prepare($query);
            $STH->execute();
            return $STH->fetchAll();
        } catch (PDOException $e) {
            error_log($e->getMessage());
            throw $e;
        }
    }

    public function deleteAllCourses() {
        $DBH = $this->getDatabase();

        $query = "TRUNCATE TABLE s3_course";

        try {
            $STH = $DBH->prepare($query);
            $STH->execute();
        } catch (PDOException $e) {
            error_log($e->getMessage());
            throw $e;
        }
    }
}