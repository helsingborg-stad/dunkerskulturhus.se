<?php

namespace Dunkers\Helper;

class Url
{

    /**
     * Returns current URL without query strings
     * @return string
     */
    public static function getCurrentUrl()
    {
        return (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
    }
}
