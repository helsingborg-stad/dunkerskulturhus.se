<?php

    $attachmentId = get_post_thumbnail_id();
    $image = wp_get_attachment_image_src($attachmentId, array(1024, 575));
    if (isset($image[0])) {
        $image = $image[0];
    }

?>
<a href="{{ the_permalink() }}" class="box box-event">
    @if ($image)
    <span class="box-image" style="background-image:url('{{ $image }}');">
        <img src="{{ $image }}" alt="{{ get_the_title() }}">
    </span>
    @endif

    <div class="event-information">
        <span class="event-date-start">
            <time datetime="{{ date('Y-m-d H:i', strtotime(get_field('event-date-start'))) }}">{{ date('Y-m-d \k\l\. H:i', strtotime(get_field('event-date-start'))) }}</time>
            @if ($post->occations_count > 1)
            <em style="font-style:italic;">(och {{ $post->occations_count }} andra tillfällen)</em>
            @endif

            @if ($post->occations_count == 1)
            <em style="font-style:italic;">(och {{ $post->occations_count }} annat tillfälle)</em>
            @endif
        </span>
        <h3 class="event-title">{{ the_title() }}</h3>
    </div>
    <div class="event-lead">
        {!! preg_replace('#<a.*?>.*?</a>#i', '', get_the_content()) !!}
    </div>
    <span class="event-action btn btn-circle btn-green"><span>Läs mer</span></span>
</a>
