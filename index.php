<?php

use app\controllers\Controller;

require_once "init.php";

$app->router->get(path:'/', callback: [Controller::class, 'index'])
            ->get(path: '/login',callback: [Controller::class, 'login']);


$app->run();