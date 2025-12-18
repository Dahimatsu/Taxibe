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

    public function deleteAllCourses() {
        $courseModel = new CourseModel(Flight::db());
        $courseModel->deleteAllCourses();
        Flight::redirect('/course/liste');
    }
}