<?php

namespace app\controllers\api;

use app\core\Session;
use app\database\FavoritesDatabase;
use app\database\TripsDatabase;
use app\ResponseCodes;

class TripsApiController
{
    public static function getTrips(): void
    {
        $data = TripsDatabase::get($_GET);
        $trips = [];

        if (Session::get('user')) {
            $favorites = FavoritesDatabase::getUserFavorites(Session::get('user')['user_id']);
            if (!empty($data)) {
                foreach($data as $trip) {
                    $images = [];
                    if ($trip['images'] != null) {
                        $images = explode(",", $trip['images']);
                        $trip['images'] = $images;
                    }
                    $trip['isFavorite'] = in_array($trip['trip_id'], $favorites);
                    $trips[] = $trip;
                }
            }
        } else {
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
        }

        http_response_code(ResponseCodes::SUCCESS);
        $jsonData = json_encode($trips);
        header('Content-Type: application/json; charset=UTF-8');
        echo $jsonData;
    }
}