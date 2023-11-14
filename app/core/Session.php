<?php

namespace app\core;

class Session
{
    public static function put(string $key ,mixed $value): void
    {
        $_SESSION[$key] = $value;
        session_regenerate_id(true);
    }

    public static function get(string $key, mixed $default = null): mixed
    {
        return $_SESSION['_flash'][$key] ?? $_SESSION[$key] ?? $default;
    }

    public static function flash($key, $value): void
    {
        $_SESSION['_flash'][$key] = $value;
    }

    public static function unflash(): void
    {
        unset($_SESSION['_flash']);
    }

    public static function flush(): void
    {
        $_SESSION = [];
    }

    public static function destroy(string $cookie = 'PHPSESSID'): void
    {
        Session::unflash();
        session_destroy();

        $params = session_get_cookie_params();
        setcookie($cookie, '', time() - 3600, $params['path'], $params['domain'], $params['secure'], $params['httponly']);
    }
}