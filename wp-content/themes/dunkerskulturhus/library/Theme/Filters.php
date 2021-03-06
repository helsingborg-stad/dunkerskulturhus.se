<?php

namespace Dunkers\Theme;

class Filters
{
    public function __construct()
    {

        //Add filter
        add_action('Municipio/mobile_menu_breakpoint', array($this, 'mobileMenuBreakpoint'));
        add_action('Municipio/desktop_menu_breakpoint', array($this, 'desktopMenuBreakpoint'));
        add_action('Municipio/header_grid_size', array($this, 'headerGridSize'));

        // Search
        add_filter('Municipio/search_result/date', array($this, 'eventDate'), 10, 2);

        //Remove base-theme filters
        add_filter('Modularity/slider/image', array($this, 'overrideSliderImageSize'), 500);

        add_filter('Modularity/Module/Classes', function ($classes, $moduleType, $sidebarArgs) {
            if ($key = array_search('box-filled', $classes)) {
                unset($classes[$key]);
                $classes[] = 'box-panel';
            }
            return $classes;
        }, 100, 3);

        // Titles
        add_filter('the_title', array($this, 'theTitle'), 1);
        add_filter('wp_title', array($this, 'wpTitle'), 1);

        // Sidebar WpWidget module
        add_filter('Modularity/Module/WpWidget/before', array($this, 'wpWidgetBefore'), 11, 3);

        //Body classes (removing material design, this is flat)
        add_filter('body_class', array($this, 'wpAddBodyClass'));

        //Child theme header option
        add_filter('acf/load_field/name=header_layout', array($this, 'addDunkersLayoutOption'));

        //Header class (can maybe be removed)
        add_filter('Views/Partials/Header/HeaderClass', array($this, 'addHeaderClass'));

        //Main layout columns
        add_filter('Municipio/Controller/BaseController/Layout', array($this, 'setMainLayout'), 11, 3);
    }

    public function setMainLayout($classes, $sidebarLeft, $sidebarRight)
    {
        if ($sidebarRight) {
            $classes['content'] = 'grid-xs-12 grid-md-8';
            $classes['sidebarRight'] = 'grid-xs-12 grid-md-4 hidden-md';
        } else {
            $classes['content'] = 'grid-xs-12 grid-md-12';
        }

        return $classes;
    }

    public function addHeaderClass($class)
    {
        $class .= ' header-casual';

        return $class;
    }

    public function addDunkersLayoutOption($field)
    {
        if (get_field('theme_mode', 'options') >= 2) {
            $field['choices']['dunkers'] = 'Dunkers (Child theme template)';
            $field['choices']['dunkers-mega-menu'] = 'Dunkers Mega Menu (Child theme template)';
        }

        return $field;
    }

    /**
     * Remove material design with class
     * @return array
     */
    public function wpAddBodyClass($classes)
    {
        if (is_array($classes)) {
            $classes[] = "material-no-radius";
            $classes[] = "material-no-shadow";
        }
        return $classes;
    }

    public function wpWidgetBefore($before, $sidebarArgs, $module)
    {
        if (get_field('mod_standard_widget_type', $module->ID) == 'WP_Widget_Search') {
            return '<div>';
        }

        // Box panel in content area and content area bottom
        if (in_array($sidebarArgs['id'], array('content-area', 'content-area-bottom')) && !is_front_page()) {
            $before = '<div class="box box-panel box-panel-secondary">';
        }

        // Sidebar boxes (should be filled)
        if (in_array($sidebarArgs['id'], array('left-sidebar-bottom', 'left-sidebar', 'right-sidebar'))) {
            $before = '<div class="box box-panel">';
        }

        return $before;
    }

    public function wpTitle($title)
    {
        return str_replace(array('{', '}', '&#8211;', '-'), '', $title);
    }

    public function theTitle($title)
    {
        if (!in_the_loop()) {
            $title = str_replace(array('{', '}', '-'), '', $title);
            return $title;
        }

        $title = preg_replace('/(.*)?[-](.*)?/', '<strong>$1</strong> $2', $title);
        $title = preg_replace('/{(.*)?}/', '<strong>$1</strong>', $title);

        return trim($title);
    }

    public function eventDate($date, $post)
    {
        if ($post->post_type != 'event') {
            return $date;
        }

        $date = date('Y-m-d \k\l\. H:i', strtotime(get_field('event-date-start', $post->ID)));

        return $date;
    }

    /**
     * Unregister built in image sizes. Use modularity
     * @return void
     */
    public function overrideSliderImageSize($size)
    {
        if (is_array($size) && array_pop($size) == 1250) {
            return array(1920, 576);
        }
        return $size;
    }

    /**
     * Show mobile menu in all but large size.
     * @return void
     */
    public function mobileMenuBreakpoint($classes)
    {
        return "hidden-lg hidden-xl hidden-xxl";
    }

    /**
     * Show mobile menu in all but large size.
     * @return void
     */
    public function desktopMenuBreakpoint($classes)
    {
        return "hidden-xs hidden-sm hidden-md";
    }

    /**
     * Width of header, make room for mobile menu in medium
     * @return void
     */
    public function headerGridSize($classes)
    {
        return "grid-lg-12";
    }
}
