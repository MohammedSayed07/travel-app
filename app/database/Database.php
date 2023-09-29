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

    public static function get(string $table): false|array
    {
        $query = "SELECT * FROM $table";
        $query = self::execute($query);
        return $query->fetchAll();
    }

    private static function execute(string $query): false|PDOStatement
    {
        $stmt = self::$connection->prepare($query);
        $stmt->execute();
        return $stmt;
    }
}