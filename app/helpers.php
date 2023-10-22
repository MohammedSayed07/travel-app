<?php

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