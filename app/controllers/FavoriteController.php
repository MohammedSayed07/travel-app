<?php

namespace app\controllers;

use app\core\Session;
use app\database\FavoritesDatabase;
use app\models\Trip;
use Exception;

class FavoriteController
{

    /**
     * @throws Exception
     */
    public function index(): void
    {
        $trips_id = [];
        if (Session::get('user') !== null) {
            $trips_id = FavoritesDatabase::getUserFavorites(Session::get('user')['user_id']);
        }

        $trips = [];

        if (!empty($trips_id)) {
            foreach($trips_id as $trip_id) {
                $trip = Trip::getTripById($trip_id);
                $trips[] = Trip::factory($trip);
            }
        }

        renderView('favorites/index', [
            'trips' => $trips
        ]);
    }

    public function delete(): void
    {
        $user_id = Session::get('user')['user_id'];
        $trip_id = $_POST['trip_id'];

        FavoritesDatabase::delete($user_id, $trip_id);

        redirect('favorites');
    }
}