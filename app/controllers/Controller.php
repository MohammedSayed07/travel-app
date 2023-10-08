<?php
namespace app\controllers;

use app\database\Database;

class Controller {
    public function index(): void
    {
        $data = Database::get();
        var_dump(explode(',', $data[1]['images']));
        exit();
        renderView('index', data: $data);
    }

    public function login(): void
    {
        renderView('login');
    }
}