<?php

namespace app\database;

class FavoritesDatabase
{
    public static function getUserFavorites(int $userId)
    {

    }

    public static function store(int $userId, int $tripId): void
    {
        $query = "INSERT INTO favorites(user_id, trip_id) VALUES(?, ?)";

        $params = [
            'user_id' => $userId,
            'trip_id' => $tripId
        ];

        DatabaseConnection::execute($query, $params);
    }

    public static function delete(int $userId, int $tripId)
    {
        $query = "DELETE FROM favorites WHERE user_id = ? AND trip_id = ?";

        $params = [
            'user_id' => $userId,
            'trip_id' => $tripId
        ];

        DatabaseConnection::execute($query, $params);
    }
}