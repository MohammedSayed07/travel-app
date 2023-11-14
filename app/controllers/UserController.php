<?php

namespace app\controllers;

use app\core\Session;
use app\core\Validator;
use app\database\UsersDatabase;
use app\http\FormValidator;

class UserController
{
    public function register(): void
    {
        renderView('register', [], [
            'errors' => Session::get('errors') ?? []
        ]);
    }

    public function login(): void
    {
        renderView('login', [], [
            'errors' => Session::get('errors') ?? []
        ]);
    }
    public function store(): void
    {
        $form = new FormValidator();
        if (! $form->validate($_POST['email'], $_POST['password'])) {
            Session::flash('errors', $form->getErrors());
            redirect('register');
        }

        $user = UsersDatabase::find($_POST['email']);

        if ($user) {
            $form->error('duplicateEmail', 'An Email is already used');
            Session::flash('errors', $form->getErrors());
            redirect('register');
        }

        UsersDatabase::store($_POST['email'], $_POST['password']);

        Session::put('user', ['email' => $_POST['email']]);

        redirect();
    }

    public function session(): void
    {
        $form = new FormValidator();

        if (! $form->validate($_POST['email'], $_POST['password'])) {
            Session::flash('errors', $form->getErrors());
            redirect('login');
        }

        $user = UsersDatabase::find($_POST['email']);

        if (!$user || !password_verify($_POST['password'], $user['password'])) {
            $form->error('noAccount', '* No matching account found for that email or password.');
            Session::flash('errors', $form->getErrors());
            redirect('login');
        }
        Session::put('user', ['email' => $user['email']]);
        redirect();
    }

    public function logout(): void
    {
        Session::destroy();

        redirect();
    }
}