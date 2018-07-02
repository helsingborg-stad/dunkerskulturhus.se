<?php

    $attachmentId = get_post_thumbnail_id();
    $image = wp_get_attachment_image_src($attachmentId, array(1024, 575));
    if (isset($image[0])) {
        $image = $image[0];
    }

?>
<a href="{{ esc_url(add_query_arg('date', preg_replace('/\D/', '', $post->start_date), the_permalink())) }}" class="box box-event">
    @if ($image)
    <span class="box-image" style="background-image:url('{{ $image }}');">
        <img src="{{ $image }}" alt="{{ get_the_title() }}">
    </span>
    @endif

    <div class="event-information">
        <span class="event-date-start">
            {{ \Dunkers\Helper\Event::formatEventDate($post->start_date, $post->end_date) }}
        </span>
        <h3 class="event-title">{{ the_title() }}</h3>
    </div>
    <div class="event-lead">
        {!! preg_replace('#<a.*?>.*?</a>#i', '', get_the_content()) !!}
    </div>
    <span class="event-action btn btn-circle btn-green"><span>Läs mer</span></span>
</a>
