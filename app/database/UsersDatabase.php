<?php

namespace app\database;

class UsersDatabase
{
    public static function find(string $email)
    {
        $query = "SELECT * FROM users WHERE email = ?";

        $user = DatabaseConnection::execute($query, ['email' => $email]);

        return $user->fetch();
    }

    public static function store(string $email, string $password): void
    {
        $query = "INSERT INTO users(email, password) VALUES(?, ?)";
        $params = [
            'email' => $email,
            'password' => password_hash($password, PASSWORD_BCRYPT)
        ];

        DatabaseConnection::execute($query, $params);
    }
}
