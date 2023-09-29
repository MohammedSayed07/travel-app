<?php
namespace app\controllers;

class Controller {
    public function index(): void
    {
        $data = ['cardOne', 'cardTwo'];
        renderView('index', data: $data);
    }
}