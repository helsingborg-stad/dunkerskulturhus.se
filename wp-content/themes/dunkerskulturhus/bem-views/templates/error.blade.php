@extends('templates.master')
@section('header')
@stop
@section('footer')
@stop
@section('layout')
<div class="container">
            <div class="grid grid--columns">
                <div class="grid-md-5 logo u-mt-0">
                    <a class="no-link" href="{{get_home_url()}}">
                    <em>Dunkers</em>Kulturhus
                    </a>
                </div>
                <div class="grid-md-7 text-right-md text-right-lg">
                    <div class="pong-error-message">
                        <em>404</em>
                        {{ get_field('404_error_message', 'option') ? get_field('404_error_message', 'option') : 'The page could not be found' }}
                        <ul class="actions u-flex u-flex-column u-align-items-start@xs u-align-items-start@sm u-align-items-end">
                            @if (is_array(get_field('404_display', 'option')) && in_array('search', get_field('404_display', 'option')))
                            <li class="u-mt-2">
                                <a rel="nofollow" href="{{ home_url() }}?s={{ $keyword }}">{{ sprintf(get_field('404_display', 'option') ? get_field('404_search_link_text', 'option') : 'Search "%s"', $keyword) }}</a>
                            </li>
                            @endif

                            @if (is_array(get_field('404_display', 'option')) && in_array('home', get_field('404_display', 'option')))
                            <li class="u-mt-2"><a href="{{ home_url() }}">{{ get_field('404_home_link_text', 'option') ? get_field('404_home_link_text', 'option') : 'Go to home' }}</a></li>
                            @endif
                        </ul>
                    </div>
                </div>
            </div>

        </div>
                @yield('content')
@stop
