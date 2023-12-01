<?php

namespace app\models;

use app\database\UsersDatabase;

class User extends Model
{
    private int $id;
    private string $email;
    private string $password;

    public function __construct()
    {

    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): void
    {
        $this->password = $password;
    }

    public static function find($email): mixed
    {
        return UsersDatabase::find($email);
    }

    public static function store($email, $password): void
    {
        UsersDatabase::store($email, $password);
    }

    protected function dataMapper(): array
    {
        return [
            'user_id' => 'id',
            'user_email' => 'email',
            'user_password' => 'password'
        ];
    }

}