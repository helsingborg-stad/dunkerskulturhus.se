@extends('partials.header.default')

@section('header-body')
    <nav class="navbar navbar-mainmenu navbar-mainmenu--mega">
        <div class="container">
            <div class="grid">
                <div class="grid-xs-12 {!! apply_filters('Municipio/header_grid_size','grid-md-12'); !!} u-justify-content-start">

                    <span class="u-mr-auto">    
                        {!! municipio_get_logotype(get_field('header_logotype', 'option'), get_field('logotype_tooltip', 'option')) !!}
                    </span>

                    {{-- Translate --}}
                    <a href="?translate=true#translate" class="translate-icon-btn u-mr-2" aria-label="translate"><span data-tooltip="Translate"><i class="pricon pricon-globe"></i></span></a>

                    <a href="#mobile-menu" role="button" tabindex="0" data-target="#mobile-menu" class="menu-trigger"><span class="menu-trigger__label">Meny</span><span class="menu-trigger__close">Stäng</span><span class="menu-icon"></span></a>
                </div>
            </div>
        </div>
    </nav>

    @if (strlen($navigation['mobileMenu']) > 0)
        <nav id="mobile-menu" class="nav-mobile-menu nav-toggle mega-menu">
            <div class="container">
                @include('partials.mega-menu')
            </div>
        </nav>
    @endif
@stop
