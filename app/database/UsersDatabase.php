<?php

namespace app\database;

class UsersDatabase
{
    public static function find(string $email): mixed
    {
        $query = "SELECT * FROM users WHERE user_email = ?";

        $user = DatabaseConnection::execute($query, ['email' => $email]);

        return $user->fetch();
    }

    public static function store(string $email, string $password): void
    {
        $query = "INSERT INTO users(user_email, user_password) VALUES(?, ?)";
        $params = [
            'email' => $email,
            'password' => password_hash($password, PASSWORD_BCRYPT)
        ];

        DatabaseConnection::execute($query, $params);
    }
}
