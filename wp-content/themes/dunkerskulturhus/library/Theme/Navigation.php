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
        add_action('Municipio/viewData', array($this, 'appendMegaMenuItems'), 10, 1);
    }

    /**
     * Builds up a two level deep menu tree with nested children from a flat menu array
     * This method should be implemented as a callback within array_reduce
     * @param  array  $menuTreeItems
     * @param  WP_Post $menuItem
     * @return array
     */
    public static function buildMenuTree($menuTreeItems, $menuItem)
    {
        // Top level items
        if ($menuItem->menu_item_parent === '0') {
            $menuTreeItems[] = $menuItem;
            return $menuTreeItems;
        }

        // Find childs parent
        $parentIndex = array_search($menuItem->menu_item_parent, array_column($menuTreeItems, 'ID'));
        
        //Append child item if parent exists in top level
        if ($parentIndex !== false && $menuTreeItems[$parentIndex] && is_array($menuTreeItems[$parentIndex]->children)) {
            $menuTreeItems[$parentIndex]->children[] = $menuItem;
        }

        return $menuTreeItems;
    }

    /**
     * Returns a two level deep menu array with nested children
     * @param  string  $themeLocationMenuSlug The slug used when regstering the menu with register_nav_menu()
     * @return array
     */
    public static function getMenuItems($themeLocationMenuSlug)
    {
        $registeredMenu = get_nav_menu_locations()[$themeLocationMenuSlug] ?: false;
        
        if (!$registeredMenu) {
            throw new \Exception('The menu does not exists: ' . $themeLocationMenuSlug);
        }

        // Get menu items as flat array & append css classes & other propeties
        $flatArray = array_map(function ($menuItem) use ($themeLocationMenuSlug) {
            $menuItem->children = array();
            $menuItem->classes[] = 'menu-item';
            $menuItem->classes[] = 'menu-item-' . $menuItem->ID;
            $menuItem->classes[] = 'menu-item-type-' . $menuItem->type;
            $menuItem->classes[] = 'menu-item-object-' . $menuItem->object;

            // Append css class if item is current page
            if (get_queried_object_id() === $menuItem->ID || \Dunkers\Helper\Url::getCurrentUrl() === $menuItem->url) {
                $menuItem->classes[] = 'current-menu-item is-current-page';
            }
            
            $menuItem->classes = apply_filters('Dunkers/Theme/Navigation::getmenuTreeItems:classes', array_filter($menuItem->classes), $menuItem, $themeLocationMenuSlug);
            $menuItem->classNames = implode(' ', $menuItem->classes);

            return $menuItem;
        }, wp_get_nav_menu_items(get_term($registeredMenu, 'nav_menu')));

        return array_reduce($flatArray, 'self::buildMenuTree', array());
    }

    /**
     * Send mega menu items to the view if mega menu is enabled
     * @param  array  $data
     * @return array
     */
    public function appendMegaMenuItems($data)
    {
        // Bail out early
        if (get_field('header_layout', 'options') !== 'dunkers-mega-menu') {
            return $data;
        }

        $data['megaMenuItems'] = self::getMenuItems('main-menu');

        return $data;
    }

    public function hideResetFilter()
    {
        if (!isset($_GET['filter'])) {
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
        if ($args->theme_location == "main-menu") {
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

    public function renderEventFilterMenu($query)
    {
        if (!$query->is_main_query()) {
            return;
        }

        if (!is_post_type_archive('event')) {
            return;
        }
  
        //Print menu
        wp_nav_menu(array(
          'menu' => 'event-categories',
          'menu_class' => 'navbar-event-categories'
        ));

        //Hide generator for frontend users.
        if (is_user_logged_in()) {
            echo '<style>#archive-filter:before {color: #f00; content: "Syns endast för redaktörer. Använd listan för att skapa länkar till menyn.  "; }</style>';
        } else {
            echo '<style>#archive-filter {display: none;}</style>';
        }
    }
}
