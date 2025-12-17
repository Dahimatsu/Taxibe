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

        $conducteurController = new ConducteurController($app);
        $conducteurs = $conducteurController->getConducteurs();

        $app->render('layout', ['page' => "accueil.php", 'conducteurs' => $conducteurs]);
    });

    $router->get('/planning-moto', function () use ($app) {
        $conducteurController = new ConducteurController($app);
        $conducteurs = $conducteurController->getConducteurs();

        $motoController = new MotoController($app);
        $motos = $motoController->getMotos();

        $courseController = new CourseController($app);
        $plannings = $courseController->getPlannings();
        $app->render('layout', ['page' => "planning.php",'conducteurs' => $conducteurs, 'motos' => $motos, 'plannings' => $plannings]);
    });

    $router->get('/course',function () use ($app) {
        $app->render('layout', ['page' => "course.php"]);
    });

    $router->post('/inserer-course',function () use ($app) {
        $courseController = new CourseController($app);
        $courseController->insererCourse();
    });

}, [SecurityHeadersMiddleware::class]);