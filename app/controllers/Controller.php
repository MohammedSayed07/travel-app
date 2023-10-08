<?php
namespace app\controllers;

use app\database\Database;
use app\models\Trips;

class Controller {
    public function index(): void
    {
        $data = Database::get();
        $trips = [];

        foreach($data as $trip) {
            $images = [];
            if ($trip['images'] != null) {
                $images = explode(",", $trip['images']);
            }

            $temp = new Trips($trip['trip_id'], $trip['title'], $trip['details'], $trip['location'], $images);
            $trips[] = $temp;
        }

        renderView('index', data: $trips);
    }

    public function login(): void
    {
        renderView('login');
    }
}