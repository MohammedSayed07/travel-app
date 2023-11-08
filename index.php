<?php

use app\controllers\Controller;
use app\controllers\TripController;
use app\controllers\TripsApiController;

require_once "init.php";

$app->router->get(path:'/', callback: ['controller' => Controller::class, 'action' => 'index'])
            ->get(path: '/login',callback: ['controller' => Controller::class, 'action' => 'login'])->only('guest', 'get')
            ->get(path:'/trips', callback: ['controller' => TripController::class, 'action' => 'index'])
            ->get(path: '/api/trips', callback: ['controller' => TripsApiController::class, 'action' => 'getTrips']);

dd($app->router->routes);

$app->run();