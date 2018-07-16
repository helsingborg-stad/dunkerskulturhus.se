@extends('templates.error')

@section('content')

<div class="container hidden-xs hidden-sm">
    <div class="grid grid--columns">
        <div class="grid-sm-12">
            <div id="pong-game" class="u-mb-4"></div>
            <div class="pong-controls">
                Använd piltangenterna (<img src="{{ get_stylesheet_directory_uri() }}/assets/dist/images/arrow-up.svg" alt="upp" height="15">,<img src="{{ get_stylesheet_directory_uri() }}/assets/dist/images/arrow-down.svg" alt="upp" height="15">) för att styra.
            </div>
        </div>
    </div>
</div>

@stop
