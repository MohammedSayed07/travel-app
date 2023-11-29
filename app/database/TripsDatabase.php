<?php

namespace app\database;

use DateInterval;
use DateTime;

class TripsDatabase
{
    /**
     * @param array $filters
     * @return false|array
     */
    public static function get(array $filters): false|array
    {
        $currentDate = new DateTime();
        $currentDate->add(new DateInterval('P8D'));
        $formattedCurrentDate = $currentDate->format('Y-m-d');
        $query = "SELECT trips.trip_id,
                    trip_title,
                    trip_details,
                    trip_location,
                    trip_price,
                    no_of_available_trips,
                    no_of_reserved_trips,
                    trip_start_date,
                    trip_end_date
                    ,
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

        $query .= " GROUP BY trips.trip_id";

        $query = DatabaseConnection::execute($query, $params);

        return $query->fetchAll();
    }

    public static function show(int $trip_id): array | bool
    {
        $query = "SELECT *, (
                        SELECT DISTINCT GROUP_CONCAT(images.image SEPARATOR ',')
                        FROM images
                        WHERE images.trip_id = trips.trip_id
                    ) AS images FROM trips WHERE trip_id = ?";


        $params = [
            'trip_id' => $trip_id
        ];

        return DatabaseConnection::execute($query, $params)->fetch();
    }
}