<?php

namespace app\core\middlewares;

class Guest
{
    public function handle(): void
    {
        if (isset($_SESSION['user'])) {
            header('Location: /');
        }
    }
}