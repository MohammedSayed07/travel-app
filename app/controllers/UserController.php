<?php

namespace app\controllers;

use app\core\Validator;
use app\database\UsersDatabase;
use app\http\FormValidator;

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
        $form = new FormValidator();
        if (! $form->validate($_POST['email'], $_POST['password'])) {
            renderView('register', [], $form->getErrors());
            return;
        }

        $user = UsersDatabase::find($_POST['email']);

        if ($user) {
            $form->error('duplicateEmail', 'An Email is already used');
            renderView('register', [], $form->getErrors());
            return;
        }

        UsersDatabase::store($_POST['email'], $_POST['password']);

        makeSession($_POST['email']);

        header('Location: /');
    }

    public function session(): void
    {
        $form = new FormValidator();

        if (! $form->validate($_POST['email'], $_POST['password'])) {
            renderView('login', [], $form->getErrors());
            return;
        }

        $user = UsersDatabase::find($_POST['email']);

        if ($user && password_verify($_POST['password'], $user['password'])) {
            makeSession($user['email']);
            header('Location: /');
            return;
        }

        $form->error('noAccount', '* No matching account found for that email or password.');
        renderView('login', [], $form->getErrors());
    }

    public function logout(): void
    {
        $_SESSION = [];
        session_destroy();

        $params = session_get_cookie_params();
        setcookie('PHPSESSID', '', time() - 3600, $params['path'], $params['domain'], $params['secure'], $params['httponly']);

        header('Location: /');
    }
}