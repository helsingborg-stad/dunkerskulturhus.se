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
        if (is_numeric($image)) {
            $image = wp_get_attachment_image_src($image, 300, 300);
            $image = $image[0];
        }
    ?>
    <div class="<?php echo (isset($fields->item_column_size) && !empty($fields->item_column_size)) ? $fields->item_column_size : 'grid-md-3' ?>">
        <a href="<?php echo get_permalink($post->ID); ?>" class="box box-news">
            <span class="box-image" <?php if ($image) : ?>style="background-image:url('<?php echo $image; ?>');"<?php endif; ?>>
                <?php if ($image) : ?>
                    <img src="<?php echo $image; ?>" alt="<?php echo $post->post_title; ?>">
                <?php endif; ?>
            </span>

            <div class="box-content">
                <?php if ($fields->show_title) : ?>
                <h5 class="link-item link-item-light"><?php echo apply_filters('the_title', $post->post_title); ?></h5>
                <?php endif; ?>

                <?php if ($fields->show_date) : ?>
                    <p><?php echo \Municipio\Helper\Dt::toStringFormat(strtotime(get_field('event-date-start', $post->ID))); ?></p>
                <?php endif; ?>

                <?php if ($fields->show_excerpt) : ?>
                    <p><?php echo isset(get_extended($post->ID)['main']) ? get_extended($post->ID)['main'] : ''; ?></p>
                <?php endif; ?>
            </div>
        </a>
    </div>
    <?php endforeach; ?>
</div>
