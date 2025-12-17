<?php

namespace app\controllers;

use Flight\Engine;
use app\models\ConducteurModel;
use Flight;

class ConducteurController
{
    protected Engine $app;

    public function __construct(Engine $app)
    {
        $this->app = $app;
    }

    public function getConducteurs()
    {
        $conducteurModel = new ConducteurModel(Flight::db());
        return $conducteurModel->getConducteurs();
    }

    public function getConducteur($id)
    {
        $conducteurModel = new ConducteurModel(Flight::db());
        $conducteur = $conducteurModel->getConducteur($id);

        if ($conducteur != null) {
            return $conducteur;
        }

        return null;
    }
}