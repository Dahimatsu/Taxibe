<?php

use app\controllers\ConducteurController;
use app\controllers\MotoController;
use app\controllers\CourseController;

use app\middlewares\SecurityHeadersMiddleware;
use flight\Engine;
use flight\net\Router;

/** @var Engine $app */
/** @var Router $router */

if (empty($app) === true) {
    $app = Flight::app();
}

$router->group('', function (Router $router) use ($app) {

    $router->get('/', function () use ($app) {
        $app->render('layout', ['page' => "accueil.php"]);
    });

    $router->group('/course',function () use ($router, $app) {
        $router->get('/',function () use ($app) {
            $app->render('layout', ['page' => "course.php"]);
        });

        $router->get('/planning', function () use ($app) {
            $conducteurController = new ConducteurController($app);
            $conducteurs = $conducteurController->getConducteurs();

            $motoController = new MotoController($app);
            $motos = $motoController->getMotos();

            $courseController = new CourseController($app);
            $plannings = $courseController->getPlannings();
            $app->render('layout', ['page' => "planning.php", 'conducteurs' => $conducteurs, 'motos' => $motos, 'plannings' => $plannings]);
        });

        $router->get('/nouvelle',function () use ($app) {
            $conducteurController = new ConducteurController($app);
            $conducteurs = $conducteurController->getConducteurs();
    
            $app->render('layout', ['page' => "inserer-course.php", 'conducteurs' => $conducteurs]);
        });

        $router->get('/liste', function () use ($app) {
            $courseController = new CourseController($app);
            $courses = $courseController->getCourses();

            $app->render('layout', ['page' => "liste.php", 'courses' => $courses]);
        });

        $router->get('/detail/@id', function ($id) use ($app) {
            $courseController = new CourseController($app);
            $course = $courseController->getCourse($id);

            $app->render('layout', ['page' => "detail.php", 'course' => $course]);
        });

        $router->post('/inserer', function () use ($app) {
            $courseController = new CourseController($app);
            $courseController->insererCourse();
        });

        $router->get("/modifier/@id", function ($id) use ($app) {
            $courseController = new CourseController($app);
            $course = $courseController->getCourse($id);

            $conducteurController = new ConducteurController($app);
            $conducteurs = $conducteurController->getConducteurs();

            $motoController = new MotoController($app);
            $motos = $motoController->getMotos();

            $app->render('layout', ['page' => "modifier.php", 'course' => $course, 'motos' => $motos, 'conducteurs' => $conducteurs]);
        });

        $router->post("/update/@id", function($id) use ($app) {
            $courseController = new CourseController($app);
            $courseController->modifierCourse($id);
        }); 

        $router->get('/valider/@id', function ($id) use ($app) {
            $courseController = new CourseController($app);
            $courseController->validerCourse($id);
        });
    });

}, [SecurityHeadersMiddleware::class]);