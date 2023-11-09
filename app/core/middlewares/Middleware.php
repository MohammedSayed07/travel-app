<?php

namespace app\core\middlewares;

class Middleware
{
    const MAP = [
      'auth' => Auth::class,
      'guest' => Guest::class
    ];
}