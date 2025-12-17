<?php

use app\controllers\ConducteurController;

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

    $router->get('/conducteur', function () use ($app) {
        $conducteurController = new ConducteurController($app);
        $conducteurs = $conducteurController->getConducteurs();
        $app->render('layout', ['page' => "conducteur.php",'conducteurs' => $chauffeurs]);
    });

}, [SecurityHeadersMiddleware::class]);