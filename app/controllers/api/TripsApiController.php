<?php

namespace app\controllers\api;

use app\database\TripsDatabase;
use app\ResponseCodes;

class TripsApiController
{
    public static function getTrips(): void
    {
        $data = TripsDatabase::get($_GET);
        $trips = [];

        if (!empty($data)) {
            foreach($data as $trip) {
                $images = [];
                if ($trip['images'] != null) {
                    $images = explode(",", $trip['images']);
                    $trip['images'] = $images;
                }
                $trips[] = $trip;
            }
        }

        http_response_code(ResponseCodes::SUCCESS);
        $jsonData = json_encode($trips);
        header('Content-Type: application/json; charset=UTF-8');
        echo $jsonData;
    }
}