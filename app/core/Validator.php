<?php

namespace app\core;

class Validator
{
    public static function isEmail(string $email)
    {
        return filter_var($email, FILTER_VALIDATE_EMAIL);
    }

    public static function string(string $text, int $min = 0, int $max = 255): bool
    {
        return strlen($text) > $min && strlen($text) < $max;

    }
}