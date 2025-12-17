<?php

namespace App\Models;

use PDOException;

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

//    public function insertCourse($course) {
//        $DBH = $this->getDatabase();
//        $query = "INSERT INTO course
//                  "
//    }

}