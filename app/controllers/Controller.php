<?php
namespace app\controllers;

class Controller {
    public function index(): void
    {
        $data = ['cardOne', 'cardTwo'];
        renderView('index', data: $data);
    }

    public function login(): void
    {
        echo "hello";
    }
}