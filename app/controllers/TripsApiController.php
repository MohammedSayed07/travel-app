<?php

namespace app\controllers;

use app\controllers\api\TripsApi;
use app\database\Database;

class TripsApiController
{
    public function getTrips():void
    {
        if (isset($_GET['location'])) {
            TripsApi::getTrips($_GET['location']);
            return;
        }

        TripsApi::getTrips();
    }
}