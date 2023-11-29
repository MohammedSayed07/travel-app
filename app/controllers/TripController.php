<?php

namespace app\controllers;

use app\models\Trip;
use app\core\DateUtils;
use Exception;

class TripController
{
    public function index(): void
    {
        renderView('trips/index');
    }

    /**
     * @return void
     * @throws Exception
     */
    public function show(): void
    {
        $tripId = filter_input(INPUT_GET, 'trip_id', FILTER_VALIDATE_INT);

        if ($tripId === false || $tripId === null) {
            redirect('trips');
        }

        $tripData = Trip::getTripById($tripId);

        if (!$tripData) {
            redirect('trips');
        }

        $tripModel = Trip::factory($tripData);


        if (DateUtils::isOutdated($tripModel->getEndDate())) {
            redirect('trips');
        }

        renderView('trips/show', [
            'trip' => $tripModel
        ]);
    }
}