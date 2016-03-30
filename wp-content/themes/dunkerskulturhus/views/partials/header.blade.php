<header id="site-header" class="site-header header-casual">
    <div class="search-top {!! apply_filters('Municipio/desktop_menu_breakpoint','hidden-sm'); !!}" id="search">
        <div class="container">
            <div class="grid">
                <div class="grid-sm-12">
                    {{ get_search_form() }}
                </div>
            </div>
        </div>
    </div>

    <nav class="navbar navbar-mainmenu">
        <div class="container">
            <div class="grid">
                <div class="grid-xs-12 {!! apply_filters('Municipio/header_grid_size','grid-md-12'); !!}">

                    {!! municipio_get_logotype(get_field('header_logotype', 'option'), get_field('logotype_tooltip', 'option')) !!}

                    @if (get_field('nav_primary_enable', 'option') === true)
                        @if (get_field('nav_primary_type', 'option') === 'wp')
                            {!!
                                wp_nav_menu(array(
                                    'theme_location' => 'main-menu',
                                    'container' => false,
                                    'container_class' => 'menu-{menu-slug}-container',
                                    'container_id' => '',
                                    'menu_class' => 'nav nav-horizontal ' . apply_filters('Municipio/desktop_menu_breakpoint', 'hidden-xs hidden-sm'),
                                    'menu_id' => 'main-menu',
                                    'echo' => false,
                                    'before' => '',
                                    'after' => '',
                                    'link_before' => '',
                                    'link_after' => '',
                                    'items_wrap' => '<ul id="%1$s" class="%2$s">%3$s</ul>',
                                    'depth' => 1,
                                ));
                            !!}
                        @endif

                        {{-- Automatically generated navigation --}}
                        @if (get_field('nav_primary_type', 'option') === 'auto')
                            <?php
                            $menu = new \Municipio\Helper\NavigationTree(array(
                                'include_top_level' => true,
                                'render' => get_field('nav_primary_render', 'option'),
                                'depth' => get_field('nav_primary_depth', 'option')
                            ));

                            if (isset($menu) && $menu->itemCount() > 0) :
                            ?>
                            <nav>
                                <ul class="nav nav-horizontal <?php echo apply_filters('Municipio/desktop_menu_breakpoint', 'hidden-xs hidden-sm'); ?>">
                                    <?php echo $menu->render(); ?>
                                </ul>
                            </nav>
                            <?php endif; ?>
                        @endif

                        <a href="#mobile-menu" data-target="#mobile-menu" class="{!! apply_filters('Municipio/mobile_menu_breakpoint','hidden-md hidden-lg'); !!} menu-trigger"><span class="menu-icon"></span></a>
                    @endif
                </div>
            </div>
        </div>
    </nav>

    @if (get_field('nav_primary_enable', 'option') === true)
        <nav id="mobile-menu" class="nav-mobile-menu nav-toggle {!! apply_filters('Municipio/mobile_menu_breakpoint','hidden-md hidden-lg'); !!}">
            @include('partials.mobile-menu')
        </nav>
    @endif
</header>

@include('partials.hero')
