<?php

namespace app\database;

use app\ErrorHandler;
use DateInterval;
use DateTime;
use Exception;
use PDO;
use PDOException;
use PDOStatement;

class Database
{
    public static PDO $connection;

    public static function makeConnection(array $config): void
    {
        try {
            $dsn = "mysql:dbname={$config['dbname']};host={$config['host']}";
            self::$connection = new PDO($dsn, $config['user'], $config['password'], [
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
            ]);
        } catch (PDOException $exception) {
            error_log($exception->getMessage());
            ErrorHandler::handleErrors(500);
            Throw $exception;
        }

    }

    /**
     * @param string|null $location
     * @return false|array
     */
    public static function get(array $filters): false|array
    {
        $currentDate = new DateTime();
        $currentDate->add(new DateInterval('P8D'));
        $formattedCurrentDate = $currentDate->format('Y-m-d');
        $query = "SELECT DISTINCT
                    trips.trip_id, 
                    trip_title, 
                    trip_details, 
                    trip_location, 
                    trip_price, 
                    no_of_available_trips, 
                    no_of_reserved_trips, 
                    trip_start_date, 
                    trip_end_date,
                    (
                        SELECT GROUP_CONCAT(images.image SEPARATOR ',')
                        FROM images
                        WHERE images.trip_id = trips.trip_id
                    ) AS images
                    FROM trips
                    LEFT JOIN images ON trips.trip_id = images.trip_id
                    WHERE trips.trip_end_date >= '{$formattedCurrentDate}'";

        $params = [];

        if (isset($filters['trip_location'])) {
            $query .= " AND trip_location LIKE ?";
            $params['location'] = '%' . str_replace('%', ' ', $filters['trip_location']) . '%';
        }

        if (isset($filters['min_price']) && isset($filters['max_price'])) {
            $query .= " AND trip_price BETWEEN ? AND ?";
            $params['min_price'] = $filters['min_price'];
            $params['max_price'] = $filters['max_price'];
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