<?php

namespace app\database;

use PDO;

class FavoritesDatabase
{
    public static function getUserFavorites(int $userId): false|array
    {
        $query = "SELECT trip_id FROM favorites WHERE user_id = ?";
        $params = [
            'user_id' => $userId
        ];

        $result = DatabaseConnection::execute($query, $params)->fetchAll(PDO::FETCH_NUM);

        return array_map('intval', array_column($result, 0)) ;
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