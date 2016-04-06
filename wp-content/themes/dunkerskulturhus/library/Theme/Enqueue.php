<?php

namespace Dunkers\Theme;

class Enqueue
{
    public function __construct()
    {
        // Enqueue scripts and styles
        add_action('wp_enqueue_scripts', array($this, 'style'));
        add_action('wp_enqueue_scripts', array($this, 'script'));
        add_action('wp_enqueue_scripts', array($this, 'font'));
    }

    /**
     * Enqueue styles
     * @return void
     */
    public function style()
    {
        if (is_404()) {
            wp_register_style('press-start-2p', 'https://fonts.googleapis.com/css?family=Press+Start+2P', '', '1.0.0');
            wp_enqueue_style('press-start-2p');
        }

        wp_register_style('hbg-prime', 'http://helsingborg-stad.github.io/styleguide-web-cdn/styleguide.dev/dist/css/hbg-prime.min.css', '', '1.0.0');
        wp_enqueue_style('hbg-prime');
        wp_enqueue_style('dunkers-css', get_stylesheet_directory_uri(). '/assets/dist/css/app.min.css', '', filemtime(get_stylesheet_directory() . '/assets/dist/css/app.min.css'));
    }

    /**
     * Enqueue scripts
     * @return void
     */
    public function script()
    {
        if (is_404()) {
            wp_register_script('pong', get_stylesheet_directory_uri(). '/assets/dist/js/Pong.js', '', '1.0.0', true);
            wp_enqueue_script('pong');
        }

        wp_enqueue_script('dunkers-js', get_stylesheet_directory_uri(). '/assets/dist/js/app.min.js', '', filemtime(get_stylesheet_directory() . '/assets/dist/js/app.min.js'), true);

        wp_register_script('hbg-prime', 'http://helsingborg-stad.github.io/styleguide-web-cdn/styleguide.dev/dist/js/hbg-prime.min.js', '', '1.0.0', true);
        wp_enqueue_script('hbg-prime');
    }

    /**
     * Enqueue fonts
     * @return void
     */
    public function font()
    {
        wp_enqueue_style('karbon-light', get_stylesheet_directory_uri(). '/assets/font/karbon/Karbon-Light.css', '', filemtime(get_stylesheet_directory() . '/assets/font/karbon/Karbon-Light.css'));
        wp_enqueue_style('karbon-semibold', get_stylesheet_directory_uri(). '/assets/font/karbon/Karbon-Semibold.css', '', filemtime(get_stylesheet_directory() . '/assets/font/karbon/Karbon-Semibold.css'));
    }
}
