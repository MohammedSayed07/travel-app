<?php

namespace app\controllers\api;

use app\models\Trip;
use app\ResponseCodes;

class TripsApiController
{
    public static function getTrips(): void
    {
        $data = Trip::all($_GET);

        http_response_code(ResponseCodes::SUCCESS);
        $jsonData = json_encode($data);
        header('Content-Type: application/json; charset=UTF-8');
        echo $jsonData;
    }
}