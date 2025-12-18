<?php

use app\controllers\ConducteurController;
use app\controllers\MotoController;
use app\controllers\CourseController;
use app\controllers\CarburantController;

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

        $router->get('/planning-error', function () use ($app) {
            $conducteurController = new ConducteurController($app);
            $conducteurs = $conducteurController->getConducteurs();

            $motoController = new MotoController($app);
            $motos = $motoController->getMotos();

            $courseController = new CourseController($app);
            $plannings = $courseController->getPlannings();
            $app->render('layout', ['page' => "planning.php", 'conducteurs' => $conducteurs, 'motos' => $motos, 'plannings' => $plannings, 'message' => "Un conducteur ne peut pas changer de moto plus d'une fois par jour."]);
        });

        $router->post('/add-planning', function () use ($app) {

            $motoController = new MotoController($app);
            $motoController->insererPlanning();

        });

        $router->get('/nouvelle',function () use ($app) {
            $conducteurController = new ConducteurController($app);
            $conducteurs = $conducteurController->getConducteursDispo();
    
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

        $router->get('/insert-error', function () use ($app) {
            $courseController = new CourseController($app);
            $courses = $courseController->getCourses();

            $app->render('layout', ['page' => "liste.php", 'message' => "La course n'a pas pu être insérée. Veuillez réessayer.", 'courses' => $courses]);
        });

        $router->get('/conducteur-error', function () use ($app) {
            $courseController = new CourseController($app);
            $courses = $courseController->getCourses();

            $app->render('layout', ['page' => "liste.php", 'message' => "Aucun conducteur disponible pour le moment ou aucun conducteur dans le planning.", 'courses' => $courses]);
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

        $router->group('/delete', function () use ($router, $app) {
            $router->get('/', function () use ($app) {
                $app->render('layout', ['page' => "course.php", 'delete' => true]);
            });

            $router->post('/valider/', function () use ($app) {
                $courseController = new CourseController($app);
                $courseController->deleteAllCourse();
            });
        });

    });

    $router->get('/rapport', function () use ($app) {
        $courseController = new CourseController($app);
        $courses = $courseController->getRapport();

        $app->render('layout', ['page' => "rapport.php", 'coursesJour' => $courses]);
    });

    $router->group('/carburant', function () use ($router, $app) {
        $router->get('/', function () use ($app) {
            $carburantController = new CarburantController($app);
            $carburants = $carburantController->getCarburants();

            $app->render('layout', ['page' => "carburant.php", 'carburants' => $carburants]);
        });
        
        $router->post('/modifier', function () use ($app) {
            $carburantController = new CarburantController($app);
            $carburantController->modifyCarburant();
        });
    });

}, [SecurityHeadersMiddleware::class]);