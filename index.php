<?php

use app\controllers\Controller;

require_once "init.php";

$app->router->get('/', [Controller::class, 'index']);

$app->run();