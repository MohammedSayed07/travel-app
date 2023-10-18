<?php

namespace app\controllers\api;

use app\database\Database;

class TripsApi
{
    public static function getTrips(?string $location = null): void
    {
        $data = Database::get($location);
        $trips = [];

        foreach($data as $trip) {
            $images = [];
            if ($trip['images'] != null) {
                $images = explode(",", $trip['images']);
            }

            $temp = [
                'id' => $trip['trip_id'],
                'title' => $trip['title'],
                'details' => $trip['details'],
                'location' => $trip['location'],
                'images' => $images
            ];

            $trips[] = $temp;
        }

        $jsonData = json_encode($trips);
        header('Content-Type: application/json');
        echo $jsonData;
    }
}