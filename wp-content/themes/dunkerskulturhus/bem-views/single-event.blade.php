@extends('templates.single')

@section('before-layout')
    @if ($singleHeroImage)
        <div class="hero o-overlay hidden-xs hidden-sm" style="background-image:url('{{ $singleHeroImage }}');">
            <span class="text-block">{{ the_title() }}<br>{{ \Municipio\Helper\Dt::toStringFormat(strtotime($occasion['start_date'])) }}</span>
        </div>
    @endif
@stop

@section('above')
@stop

@section('sidebar-left')
@stop

@section('content')
@include('components.dynamic-sidebar', ['id' => 'content-area-top'])

@while(have_posts())
    {!! the_post() !!}

    @include('partials.article')
@endwhile
@include('components.dynamic-sidebar', ['id' => 'content-area'])
@stop

@section('sidebar-right')
    <div style="max-width: 300px;">
        @if (is_string(get_field('booking_link')) && get_field('booking_link'))
        <a href="{{ get_field('booking_link') }}" target="_blank" class="btn btn-green btn-block btn-lg">Köp biljetter</a>
        @endif

        <div class="box box-filled">
            <div class="box-content">
                <p>
                    <strong>Evenemanget äger rum:</strong><br>
                    Den {{ \Municipio\Helper\Dt::toStringFormat(strtotime($occasion['start_date'])) }}
                </p>
            </div>
        </div>

        @if (isset($occations) && count($occations) > 0)
            <div class="box box-filled">
                <div class="box-content">
                    <p>
                        <strong>{{ the_title() }}</strong> kan även ses på följande datum:
                    </p>
                    <p>
                        <ul>
                            @foreach ($occations as $eventOccation)
                                <li>
                                    <a class="link-item link-item-light" href="{{ esc_url(add_query_arg('date', preg_replace('/\D/', '', $eventOccation->start_date), the_permalink())) }}">{{ \Municipio\Helper\Dt::dateWithTime(strtotime($eventOccation->start_date)) }}</a>
                                </li>
                            @endforeach
                        </ul>
                    </p>
                </div>
            </div>
        @endif

        @include('components.dynamic-sidebar', ['id' => 'right-sidebar'])
    </div>
@stop

