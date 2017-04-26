<?php

define('DUNKERS_PATH', get_stylesheet_directory() . '/');

//Include vendor files
if (file_exists(dirname(ABSPATH) . '/vendor/autoload.php')) {
    require_once dirname(ABSPATH) . '/vendor/autoload.php';
}

require_once DUNKERS_PATH . 'library/Vendor/Psr4ClassLoader.php';
$loader = new Dunkers\Vendor\Psr4ClassLoader();
$loader->addPrefix('Dunkers', DUNKERS_PATH . 'library');
$loader->addPrefix('Dunkers', DUNKERS_PATH . 'source/php/');
$loader->register();

new Dunkers\App();

/* Polyfill for new municipio view */
if (!function_exists('municipio_to_aspect_ratio')) {
    function municipio_to_aspect_ratio($ratio, $size)
    {
        if (count($ratio = explode(":", $ratio)) == 2) {
            $width  = round($size[0]);
            $height = round(($width / $ratio[0]) * $ratio[1]);
        }
        return array($width, $height);
    }
}
