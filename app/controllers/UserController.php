<?php

namespace app\controllers;

use app\core\Validator;
use app\database\UsersDatabase;

class UserController
{
    public function register(): void
    {
        renderView('register');
    }

    public function login(): void
    {
        renderView('login');
    }
    public function store(): void
    {
        $errors = [];

        if (!Validator::isEmail($_POST['email'])) {
            $errors['email'] = '* Email must be valid';
        }

        if (!Validator::string($_POST['password'], 7, 255)) {
            $errors['password'] = '* Password must be more than 7 letters';
        }

        if (!empty($errors)) {
            renderView('register', [], $errors);
            return;
        }

        $user = UsersDatabase::find($_POST['email']);

        if ($user) {
            header('Location: /login');
            return;
        }

        UsersDatabase::store($_POST['email'], $_POST['password']);

        $_SESSION['user'] = ['email' => $_POST['email']];

        header('Location: /');
    }
}