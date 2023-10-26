<?php

namespace app;

use Throwable;

class ErrorHandler
{
    public static function handleExceptions(Throwable $exception): void
    {
        http_response_code(500);

        echo json_encode([
            "code" => $exception->getCode(),
            "message" => $exception->getMessage(),
            "file" => $exception->getFile(),
            "line" => $exception->getLine()
        ]);
    }

    public static function handleErrors(int $code): void
    {
        http_response_code($code);
        switch ($code) {
            case 500:
                renderError("500 Internal Server Error");
                break;
            case 404:
                renderError("404 PAGE IS NOT FOUND");
                break;
            default:
                renderError("THERE IS AN ERROR LOADING THIS PAGE");
                break;
        }
    }


}