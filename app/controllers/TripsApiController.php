<?php

namespace app\controllers;

use app\controllers\api\TripsApi;
use app\database\DatabaseConnection;

class TripsApiController
{
    public function getTrips():void
    {
        TripsApi::getTrips($_GET);
    }
}