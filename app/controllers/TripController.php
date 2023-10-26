<?php

namespace app\controllers;

class TripController
{
    public function index(): void
    {
        renderView('trips/index');
    }

}