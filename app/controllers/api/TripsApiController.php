<?php

namespace app\controllers\api;

use app\core\Session;
use app\database\FavoritesDatabase;
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

    public static function storeFavoriteTripToCurrentUser(): void
    {
        $data = json_decode(file_get_contents("php://input"), true);

        if (Session::get('user') !== null) {
            if (isset($data['trip_id'])) {
                $user_id = Session::get('user')['user_id'];
                $trip_id = $data['trip_id'];
                FavoritesDatabase::store($user_id, $trip_id);
                http_response_code(ResponseCodes::CREATED);
                $response = ['status' => 'success', 'message' => "Data Stored Successfully"];
            } else {
                http_response_code(ResponseCodes::BAD_REQUEST);
                $response = ['status' => 'failed', 'message' => 'DATA NOT PROVIDED'];
            }
        } else {
            http_response_code(ResponseCodes::INVALID_AUTH);
            $response = ['status' => 'failed', 'message' => 'USER IS NOT AUTHORIZED'];
        }

        $jsonData = json_encode($response);
        header('Content-Type: application/json; charset=UTF-8');
        echo $jsonData;
    }

    public static function deleteFavoriteTripFromCurrentUser(): void
    {
        if (Session::get('user') !== null) {
            if (isset($_GET['trip_id'])) {
                $user_id = Session::get('user')['user_id'];
                $trip_id = $_GET['trip_id'];
                FavoritesDatabase::delete($user_id, $trip_id);
                http_response_code(ResponseCodes::SUCCESS);
                $response = ['status' => 'success', 'message' => "Favorite has been deleted successfully, trip_id: $trip_id"];
            } else {
                http_response_code(ResponseCodes::BAD_REQUEST);
                $response = ['status' => 'failed', 'message' => 'DATA NOT PROVIDED'];
            }
        } else {
            http_response_code(ResponseCodes::INVALID_AUTH);
            $response = ['status' => 'failed', 'message' => 'USER IS NOT AUTHORIZED'];
        }
        $jsonData = json_encode($response);
        header('Content-Type: application/json; charset=UTF-8');
        echo $jsonData;
    }
}