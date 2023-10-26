<?php

use app\controllers\Controller;
use app\controllers\TripController;
use app\controllers\TripsApiController;

require_once "init.php";

$app->router->get(path:'/', callback: [Controller::class, 'index'])
            ->get(path: '/login',callback: [Controller::class, 'login'])
            ->get(path:'/trips', callback: [TripController::class, 'index'])
            ->get(path: '/api/trips', callback: [TripsApiController::class, 'getTrips']);


$app->run();