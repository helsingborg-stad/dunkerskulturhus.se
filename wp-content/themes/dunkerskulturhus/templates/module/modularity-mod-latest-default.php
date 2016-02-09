<div class="grid">
<?php
foreach ($posts as $post) :
    $image = get_post_thumbnail_id($post->ID);
    $image = wp_get_attachment_url($image);
?>
<div class="grid-md-3">
    <a href="<?php echo get_permalink($post->ID); ?>" class="box box-news">
        <?php if ($image && $fields->show_picture) : ?>
        <img src="<?php echo $image; ?>">
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
