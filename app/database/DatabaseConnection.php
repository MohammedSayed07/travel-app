<?php

namespace app\database;

use app\ErrorHandler;
use DateInterval;
use DateTime;
use Exception;
use PDO;
use PDOException;
use PDOStatement;

class DatabaseConnection
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

    public static function execute(string $query, array $params = []): false|PDOStatement
    {
        $stmt = self::$connection->prepare($query);
        $stmt->execute(array_values($params));
        return $stmt;
    }
}