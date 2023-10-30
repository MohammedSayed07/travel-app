<?php
namespace app\controllers;

use app\database\DatabaseConnection;
use app\models\Trips;

class Controller {
    public function index(): void
    {
        renderView('index');
    }

    public function login(): void
    {
        renderView('login');
    }
}