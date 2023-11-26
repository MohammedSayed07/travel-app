<?php

namespace app\controllers;

use app\database\TripsDatabase;
use DateTime;

class TripController
{
    public function index(): void
    {
        renderView('trips/index');
    }


    public function show(): void
    {
        if (!is_numeric($_GET['trip_id']))
        {
            redirect('trips');
        }

        $trip = TripsDatabase::show($_GET['trip_id']);

        if (!$trip) {
            redirect('trips');
        }

        $currentDate = new DateTime();
        $tripEndDate = new DateTime($trip['trip_end_date']);

        if ($currentDate > $tripEndDate) {
            redirect('trips');
        }

        $tripEndDate->modify('-8 day');

        $days = 0;

        if (((int)$tripEndDate->format('d') >= (int)$currentDate->format('d')) &&
            ((int)$tripEndDate->format('m') + 1 === (int)$currentDate->format('m')) &&
            ((int)$tripEndDate->format('y') === (int)$currentDate->format('y'))) {

            $days = (int)$tripEndDate->format('d') - (int)$currentDate->format('d');

        }

        $trip['images'] = explode(',', $trip['images']);

        renderView('trips/show', [
            'trip' => $trip,
            'days' => $days,
            'reservationEnd' => $tripEndDate->format('Y-m-d')
        ]);
    }
}