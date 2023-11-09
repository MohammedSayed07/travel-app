<?php

use JetBrains\PhpStorm\NoReturn;

#[NoReturn] function dd($whatever): void
{
    var_dump($whatever);
    exit();
}

function renderView(string $view, array $data = [], array $errors = [])
{
    extract($data);
    extract($errors);
    require_once MAIN_DIR."/views/{$view}.view.php";
}

function renderError(string $error): void
{
    require_once MAIN_DIR."/views/error.view.php";
}