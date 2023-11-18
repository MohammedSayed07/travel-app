<?php

namespace app\controllers;

use app\core\Session;
use app\database\FavoritesDatabase;
use app\ResponseCodes;

class FavoriteController
{
    public function store(): void
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
}