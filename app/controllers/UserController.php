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
        renderView('register', [
            'old' => Session::get('old') ?? []
        ], [
            'errors' => Session::get('errors') ?? []
        ]);
    }

    public function login(): void
    {
        renderView('login', [
            'old' => Session::get('old') ?? []
        ], [
            'errors' => Session::get('errors') ?? []
        ]);
    }

    public function store(): void
    {
        $email = $_POST['email'];
        $password = $_POST['password'];
        $form = new FormValidator();
        if (! $form->validate($email, $password)) {
            Session::flash('old', [
                'email' => $email
            ]);
            Session::flash('errors', $form->getErrors());
            redirect('register');
        }

        $user = UsersDatabase::find($email);

        if ($user) {
            $form->error('duplicateEmail', 'An Email is already used');
            Session::flash('errors', $form->getErrors());
            redirect('register');
        }

        UsersDatabase::store($email, $password);

        Session::put('user', [
            'user_id' => $user['user_id'],
            'email' => $email
        ]);

        redirect();
    }

    public function session(): void
    {
        $email = $_POST['email'];
        $password = $_POST['password'];

        $form = new FormValidator();

        if (! $form->validate($email, $password)) {
            Session::flash('old', [
                'email' => $email
            ]);
            Session::flash('errors', $form->getErrors());
            redirect('login');
        }

        $user = UsersDatabase::find($email);

        if (!$user || !password_verify($password, $user['password'])) {
            $form->error('noAccount', '* No matching account found for that email or password.');
            Session::flash('old', [
                'email' => $email
            ]);
            Session::flash('errors', $form->getErrors());
            redirect('login');
        }
        Session::put('user', [
            'user_id' => $user['user_id'],
            'email' => $user['email']
        ]);
        redirect();
    }

    public function logout(): void
    {
        Session::destroy();

        redirect();
    }
}