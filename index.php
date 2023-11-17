<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start([
    'cookie_secure' => true,
    'cookie_httponly' => true
]);

use app\controllers\api\TripsApiController;
use app\controllers\Controller;
use app\controllers\TripController;
use app\controllers\UserController;

require_once "init.php";

$app->router->get(path:'/', callback: ['controller' => Controller::class, 'action' => 'index'])
            ->get(path:'/trips', callback: ['controller' => TripController::class, 'action' => 'index'])
            ->get(path: '/api/trips', callback: ['controller' => TripsApiController::class, 'action' => 'getTrips'])
            ->get(path: '/register', callback: ['controller' => UserController::class, 'action' => 'register'])->only('guest', 'get')
            ->post(path: '/register', callback: ['controller' => UserController::class, 'action' => 'store'])->only('guest', 'post')
            ->get(path: '/login',callback: ['controller' => UserController::class, 'action' => 'login'])->only('guest', 'get')
            ->post(path: '/login', callback: ['controller' => UserController::class, 'action' => 'session'])->only('guest', 'post')
            ->delete(path: '/logout', callback: ['controller' => UserController::class, 'action' => 'logout'])->only('auth', 'delete');

$app->run();

unset($_SESSION['_flash']);

