<?php

namespace app\core;

class Request
{
    /**
     * @return string
     */
    public function getMethod(): string
    {
        return strtolower($_SERVER['REQUEST_METHOD']);
    }

    /**
     * @return string
     */
    public function getPath(): string
    {
        $url = filter_var(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), FILTER_SANITIZE_URL);
        return (empty($url)) ? '/' : $url;
    }
}