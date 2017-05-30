<?php
namespace Dunkers;

class App
{
    public function __construct()
    {
        new \Dunkers\Theme\Enqueue();
        new \Dunkers\Theme\Navigation();
        new \Dunkers\Theme\Filters();

        add_action('parse_query', array($this, 'eventArchive'));
        add_filter('Municipio/blade/controller', function ($controller) {
            if (is_post_type_archive('event')) {
                return \Municipio\Helper\Controller::locateController(get_stylesheet_directory() . '/library/Controller/ArchiveEvent.php');
            }
            return $controller;
        });
        // Remove canonical redirect, else short links wont work
        remove_filter('template_redirect', 'redirect_canonical');
    }

    public function eventArchive()
    {
        if (!is_post_type_archive('event')) {
            return;
        }

        new \Dunkers\Theme\EventArchive();

        // Remove action after first run so that it does not run anymore on this page
        remove_action('parse_query', array($this, 'eventArchive'));
    }
}
