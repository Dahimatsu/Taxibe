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
        Flight::redirect('/');
    }

    public function getPlannings()
    {
        $courseModel = new CourseModel(Flight::db());
        return $courseModel->getPlanning();
    }
}