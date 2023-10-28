<?php

namespace app\controllers\api;

use app\database\Database;
use PDOException;

class TripsApi
{
    public static function getTrips(?string $location = null): void
    {

        $data = Database::get($location);
        $trips = [];

        if (!empty($data)) {
            foreach($data as $trip) {
                $images = [];
                if ($trip['images'] != null) {
                    $images = explode(",", $trip['images']);
                }


                $temp = [
                    'id' => $trip['trip_id'],
                    'title' => $trip['trip_title'],
                    'details' => $trip['trip_details'],
                    'location' => $trip['trip_location'],
                    'price' => $trip['trip_price'],
                    'available' => $trip['no_of_available_trips'],
                    'reserved' => $trip['no_of_reserved_trips'],
                    'startDate' => $trip['trip_start_date'],
                    'endDate' => $trip['trip_end_date'],
                    'images' => $images
                ];

                $trips[] = $temp;
            }
        }

        $jsonData = json_encode($trips);
        header('Content-Type: application/json; charset=UTF-8');
        echo $jsonData;
    }
}