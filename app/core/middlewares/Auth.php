<?php

namespace app\core\middlewares;

class Auth
{
    public function handle(): void
    {
        if (!isset($_SESSION['user'])) {
            header('Location: /');
        }
    }
}