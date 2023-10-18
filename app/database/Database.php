<?php

namespace app\database;

use Exception;
use PDO;
use PDOException;
use PDOStatement;

class Database
{
    public static PDO $connection;

    public static function makeConnection(array $config): PDOException|PDO|Exception
    {
        $dsn = "mysql:dbname={$config['dbname']};host={$config['host']}";
        try {
            self::$connection = new PDO($dsn, $config['user'], $config['password'], [
               PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
            ]);
            return self::$connection;
        } catch (PDOException $exception) {
            return $exception;
        }
    }

    public static function get(?string $location = null): false|array
    {
        $query = "SELECT DISTINCT trips.trip_id, title, details, location,
                    (
                        SELECT GROUP_CONCAT(images.image SEPARATOR ',')
                        FROM images
                        WHERE images.trip_id = trips.trip_id
                    ) AS images
                    FROM trips
                    LEFT JOIN images ON trips.trip_id = images.trip_id";
        $params = [];

        if ($location !== null) {
            $query .= " WHERE location LIKE ?";
            $params['location'] = '%' . $location . '%';
        }

        $query = self::execute($query, $params);
        return $query->fetchAll();
    }

    private static function execute(string $query, array $params = []): false|PDOStatement
    {
        $stmt = self::$connection->prepare($query);
        $stmt->execute(array_values($params));
        return $stmt;
    }
}