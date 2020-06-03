<?php

namespace Dunkers\Theme;

class Navigation
{
    public function __construct()
    {
        $this->registerMenus();

        add_filter('nav_menu_css_class', array($this, 'setCurrentlyActiveItem'), 10, 3);

        add_action('loop_start', array($this, 'renderEventFilterMenu'));
        add_action('wp_head', array($this, 'hideResetFilter'));
    }

    public function hideResetFilter() {
        if(!isset($_GET['filter'])) {
            echo '<style>.unfilter {display: none !important;}</style>'; 
        }   
    }

    /**
     * Fixes urls in the event cateogy filter menu
     * @param  array  $attr Item attributes
     * @param  object $item Item object
     * @param  array  $args Arguments
     * @return array        Modified attributes
     */
    public function setCurrentlyActiveItem($classes, $item, $args)
    {
        if($args->theme_location == "main-menu") {
            return $classes; 
        }

        if (strpos($_SERVER["REQUEST_URI"], $item->url)) { 
            $classes[] = 'current-menu-item';
        }

        return $classes;
    }

    public function registerMenus()
    {
        register_nav_menus(array(
            'event-categories' => __('Evenemangskategorier', 'dunkers')
        ));
    }

    public function renderEventFilterMenu($query) {
        if(!$query->is_main_query()) {
          return; 
        }

        if(!is_post_type_archive('event')) {
            return; 
        }
  
        //Print menu
        wp_nav_menu(array(
          'menu' => 'event-categories',
          'menu_class' => 'navbar-event-categories'
        ));

        //Hide generator for frontend users. 
        if(is_user_logged_in()) {
            echo '<style>#archive-filter:before {color: #f00; content: "Syns endast för redaktörer. Använd listan för att skapa länkar till menyn.  "; }</style>'; 
        } else {
            echo '<style>#archive-filter {display: none;}</style>'; 
        }
  
    }
}
