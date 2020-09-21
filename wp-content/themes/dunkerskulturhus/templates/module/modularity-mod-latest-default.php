<?php if (isset($fields->view_as) && $fields->view_as == 'list') : ?>

    <div class="box box-panel">
        <h2 class="box-title"><?php echo $module->post_title; ?></h2>
        <ul>
            <?php
            foreach ($posts as $post) :
                $image = get_post_thumbnail_id($post->ID);
                $image = wp_get_attachment_url($image);
            ?>
                <li>
                    <a href="<?php echo get_permalink($post->ID); ?>">
                        <?php if ($fields->show_title) : ?>
                            <span class="link-item title"><?php echo apply_filters('the_title', $post->post_title); ?></span>
                        <?php endif; ?>

                        <?php if ($fields->show_date) : ?>
                        <time class="date text-sm text-dark-gray"><?php echo get_the_time('Y-m-d', $post->ID); ?></time>
                        <?php endif; ?>
                    </a>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>

<?php else : ?>

    <?php if (strlen(get_the_title($module->ID)) > 0) : ?>
    <div class="grid">
        <div class="grid-sm-12 text-center">
            <h2><?php echo get_the_title($module->ID); ?></h2>
        </div>
    </div>
    <?php endif; ?>

    <div class="grid">
    <?php
    foreach ($posts as $post) :
        $image = get_post_thumbnail_id($post->ID);
        $image = wp_get_attachment_url($image);
    ?>
    <div class="<?php echo (isset($fields->item_column_size) && !empty($fields->item_column_size)) ? $fields->item_column_size : 'grid-md-3' ?>">
        <a href="<?php echo get_permalink($post->ID); ?>" class="box box-news">
            <?php if ($image && $fields->show_picture) : ?>
            <img src="<?php echo $image; ?>" alt="<?php echo $post->post_title; ?>">
            <?php endif; ?>
            <div class="box-content">
                <?php if ($fields->show_title) : ?>
                <h5 class="link-item link-item-light"><?php echo apply_filters('the_title', $post->post_title); ?></h5>
                <?php endif; ?>

                <?php if ($fields->show_date) : ?>
                <p><?php echo get_the_time('Y-m-d H:i', $post->ID); ?></p>
                <?php endif; ?>

                <?php if ($fields->show_excerpt) : ?>
                <p><?php echo isset(get_extended($post->post_content)['main']) ? get_extended($post->post_content)['main'] : ''; ?></p>
                <?php endif; ?>
            </div>
        </a>
    </div>
    <?php endforeach; ?>
    </div>

<?php endif; ?>
