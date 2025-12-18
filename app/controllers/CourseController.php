<?php

namespace app\controllers;

use Flight\Engine;
use app\models\CourseModel;
use Flight;

class CourseController
{
    protected Engine $app;

    public function __construct(Engine $app)
    {
        $this->app = $app;
    }

    public function insererCourse()
    {
        $data = Flight::request()->data;
        $courseModel = new CourseModel(Flight::db());
        $courseModel->insertCourse($data);
        $id = $courseModel->getLastId();
        if($id === null){
            Flight::redirect('/course/insert-error');
        }
        Flight::redirect('/course/detail/' . $id);
    }

    public function modifierCourse($id)
    {
        $data = Flight::request()->data;
        $courseModel = new CourseModel(Flight::db());
        $courseModel->updateCourse($id, $data);
        Flight::redirect('/course/detail/' . $id);
    }

    public function getPlannings()
    {
        $courseModel = new CourseModel(Flight::db());
        return $courseModel->getPlanning();
    }

    public function getCourses()
    {
        $courseModel = new CourseModel(Flight::db());
        return $courseModel->getCourses();
    }

    public function getCourse($id)
    {
        $courseModel = new CourseModel(Flight::db());
        return $courseModel->getCourse($id);
    }

    public function validerCourse($id)
    {
        $courseModel = new CourseModel(Flight::db());
        $courseModel->validerCourse($id);
        Flight::redirect('/course/detail/' . $id);
    }

    public function getRapport()
    {
        $courseModel = new CourseModel(Flight::db());
        return $courseModel->getRapport();
    }

    public function getRapportFiltrer()
    {
        $dateDebut = Flight::request()->data->date_debut;
        $dateFin = Flight::request()->data->date_fin;
        $courseModel = new CourseModel(Flight::db());
        return $courseModel->getRapportFiltrer($dateDebut, $dateFin);
    }

    public function verifyMotDePasse() {
        $motDePasse = Flight::request()->data;
        if ($motDePasse['password'] === '1234') {
            return true;
        }
        return false;   
    }

    public function deleteAllCourses() {
        $courseModel = new CourseModel(Flight::db());
        $courseModel->deleteAllCourses();
        Flight::redirect('/course/liste');
    }
}