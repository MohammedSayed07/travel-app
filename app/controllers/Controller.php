<?php
namespace app\controllers;

use app\database\DatabaseConnection;
use app\models\Trip;

class Controller {
    public function index(): void
    {
        renderView('index');
    }
}