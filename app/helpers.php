<?php

use JetBrains\PhpStorm\NoReturn;

#[NoReturn] function dd($whatever): void
{
    echo '<pre>';
    var_dump($whatever);
    exit();
}

#[NoReturn] function redirect(string $location = ''): void
{
    header("Location: /$location");
    exit();
}

function renderView(string $view, array $data = [], array $errors = []): void
{
    extract($data);
    extract($errors);
    require_once MAIN_DIR."/views/{$view}.view.php";
}

function renderError(string $error): void
{
    require_once MAIN_DIR."/views/error.view.php";
}

function isUrl(string $url): bool
{
    $currentURL = filter_var(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), FILTER_SANITIZE_URL);
    return $currentURL === $url;
}
