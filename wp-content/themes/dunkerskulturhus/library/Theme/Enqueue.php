<?php

namespace Dunkers\Theme;

use Dunkers\Helper\CacheBust as CacheBust;

class Enqueue
{
    public function __construct()
    {
        // Enqueue scripts and styles
        add_action('wp_enqueue_scripts', array($this, 'style'));
        add_action('wp_enqueue_scripts', array($this, 'font'));
        add_action('wp_enqueue_scripts', array($this, 'script'), 900);
    }

    /**
     * Enqueue styles
     * @return void
     */
    public function style()
    {
        wp_enqueue_style(
            'dunkers-css',
            get_stylesheet_directory_uri() .
                '/assets/dist/' .
                CacheBust::name('css/app.css'),
            array(),
            '',
        );

        if (is_404()) {
            wp_register_style('press-start-2p', 'https://fonts.googleapis.com/css?family=Press+Start+2P', '', '1.0.0');
            wp_enqueue_style('press-start-2p');
        }
    }

    /**
     * Enqueue scripts
     * @return void
     */
    public function script()
    {
        wp_enqueue_script(
            'dunkers-js',
            get_stylesheet_directory_uri() .
                '/assets/dist/' .
                CacheBust::name('js/app.js'),
            array(),
            '',
        );

        if (is_404()) {
            wp_register_script('pong', get_stylesheet_directory_uri(). '/assets/dist/js/Pong.js', '', '1.0.0', true);
            wp_enqueue_script('pong');
        }
    }

    /**
     * Enqueue fonts
     * @return void
     */
    public function font()
    {
        wp_enqueue_style(
            'karbon-light', 
            get_stylesheet_directory_uri(). '/assets/font/karbon/Karbon-Light.css', 
            '', filemtime(get_stylesheet_directory() . '/assets/font/karbon/Karbon-Light.css')
        );

        wp_enqueue_style(
            'karbon-semibold', 
            get_stylesheet_directory_uri(). '/assets/font/karbon/Karbon-Semibold.css', 
            '', filemtime(get_stylesheet_directory() . '/assets/font/karbon/Karbon-Semibold.css')
        );
    }
}