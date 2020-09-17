@extends('partials.header.default')

@section('header-body')
    <nav class="navbar navbar-mainmenu navbar-mainmenu--mega">
        <div class="container">
            <div class="grid">
                <div class="grid-xs-12 {!! apply_filters('Municipio/header_grid_size','grid-md-12'); !!}">

                    {!! municipio_get_logotype(get_field('header_logotype', 'option'), get_field('logotype_tooltip', 'option')) !!}

                    {{-- {!! $navigation['mainMenu'] !!} --}}
                    <a href="#mobile-menu" data-target="#mobile-menu" class="menu-trigger"><span class="menu-trigger__label">Meny</span> <span class="menu-icon"></span></a>
                </div>
            </div>
        </div>
    </nav>

    @if (strlen($navigation['mobileMenu']) > 0)
        <nav id="mobile-menu" class="nav-mobile-menu nav-toggle mega-menu">
            <div class="container u-p-0">
                @include('partials.mega-menu')
            </div>
        </nav>
    @endif
@stop
