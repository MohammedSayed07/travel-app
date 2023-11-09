<?php

namespace app\core\middlewares;

class Guest
{
    public function handle(): void
    {
        dd('guest');
    }
}