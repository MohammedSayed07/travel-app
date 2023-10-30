<?php

use app\core\Application;
use app\database\Database;

require_once 'vendor/autoload.php';
require_once 'app/helpers.php';
const MAIN_DIR = __DIR__;

$config = require 'config.php';

$app = new Application();

Database::makeConnection($config['db']);

