<?php

namespace app\controllers;

use app\controllers\api\TripsApi;
use app\database\Database;

class TripsApiController
{
    public function getTrips():void
    {
        TripsApi::getTrips($_GET);
    }
}