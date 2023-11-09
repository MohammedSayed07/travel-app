<?php

session_start();

use app\controllers\Controller;
use app\controllers\TripController;
use app\controllers\TripsApiController;
use app\controllers\UserController;

require_once "init.php";

$app->router->get(path:'/', callback: ['controller' => Controller::class, 'action' => 'index'])
            ->get(path:'/trips', callback: ['controller' => TripController::class, 'action' => 'index'])
            ->get(path: '/api/trips', callback: ['controller' => TripsApiController::class, 'action' => 'getTrips'])
            ->get(path: '/register', callback: ['controller' => UserController::class, 'action' => 'register'])
            ->post(path: '/register', callback: ['controller' => UserController::class, 'action' => 'store'])
            ->get(path: '/login',callback: ['controller' => UserController::class, 'action' => 'login'])
            ->post(path: '/login', callback: ['controller' => UserController::class, 'action' => 'session']);


$app->run();