<header id="site-header" class="header-casual">
    <nav class="navbar navbar-mainmenu">
        <div class="container">
            <div class="grid">
                <div class="grid-xs-12 <?php echo apply_filters('Municipio/header_grid_size','grid-md-12');; ?>">

                    <?php echo municipio_get_logotype(get_field('header_logotype', 'option'), get_field('logotype_tooltip', 'option')); ?>


                    <?php echo wp_nav_menu(array(
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
                        ));; ?>


                    <a href="#mobile-menu" data-target="#mobile-menu" class="<?php echo apply_filters('Municipio/mobile_menu_breakpoint','hidden-md hidden-lg');; ?> menu-trigger"><span class="menu-icon"></span></a>
                </div>
            </div>
        </div>
    </nav>

    <nav id="mobile-menu" class="nav-mobile-menu nav-toggle">
        <?php echo wp_nav_menu(array(
                'theme_location' => 'main-menu',
                'container' => false,
                'container_class' => 'menu-{menu-slug}-container',
                'container_id' => '',
                'menu_class' => 'nav-mobile',
                'menu_id' => '',
                'echo' => false,
                'before' => '',
                'after' => '',
                'link_before' => '',
                'link_after' => '',
                'items_wrap' => '<ul id="%1$s" class="%2$s">%3$s</ul>',
                'depth' => 0,
            ));; ?>

    </nav>
</header>

<?php if(is_front_page()): ?>
    <?php echo $__env->make('partials.hero', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php endif; ?>
