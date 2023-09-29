<?php

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

return [
    'db' => [
        'dbname' => $_ENV['DB_NAME'],
        'host' => $_ENV['DB_HOST'],
        'user' => $_ENV['DB_USER'],
        'password'=> $_ENV['DB_PASSWORD']
    ]
];