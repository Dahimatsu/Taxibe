<?php

use app\controllers\ConducteurController;
use app\controllers\MotoController;

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
        $motoController = new MotoController($app);
        $motos = $motoController->getMotos();

        $conducteurController = new ConducteurController($app);
        $conducteurs = $conducteurController->getConducteurs();

        $app->render('layout', ['page' => "accueil.php", 'motos' => $motos, 'conducteurs' => $conducteurs]);
    });

    $router->get('/conducteur', function () use ($app) {
        $conducteurController = new ConducteurController($app);
        $conducteurs = $conducteurController->getConducteurs();
        $app->render('layout', ['page' => "conducteur.php",'conducteurs' => $chauffeurs]);
    });

    $router->get('/course',function () use ($app) {
        $app->render('layout', ['page' => "course.php"]);
    });

}, [SecurityHeadersMiddleware::class]);