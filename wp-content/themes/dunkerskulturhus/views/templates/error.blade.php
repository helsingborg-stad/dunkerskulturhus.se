<!DOCTYPE html>
<html class="no-js" <?php language_attributes(); ?>>
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=EDGE">

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ get_bloginfo('name') }}</title>

    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="pubdate" content="{{ the_time('d M Y') }}">
    <meta name="moddate" content="{{ the_modified_time('d M Y') }}">



    <meta name="google-translate-customization" content="10edc883cb199c91-cbfc59690263b16d-gf15574b8983c6459-12">

    <link rel="icon" href="{{ get_template_directory_uri() }}/assets/images/icons/favicon.ico" type="image/x-icon">

    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="{{ get_template_directory_uri() }}/assets/images/icons/apple-touch-icon-144x144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="{{ get_template_directory_uri() }}/assets/images/icons/apple-touch-icon-114x114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="{{ get_template_directory_uri() }}/assets/images/icons/apple-touch-icon-72x72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="{{ get_template_directory_uri() }}/assets/images/icons/apple-touch-icon-precomposed.png">

    <script>
        var ajaxurl = '{!! admin_url('admin-ajax.php') !!}';
    </script>

    <!--[if lt IE 9]>
    <script type="text/javascript">
        document.createElement('header');
        document.createElement('nav');
        document.createElement('section');
        document.createElement('article');
        document.createElement('aside');
        document.createElement('footer');
        document.createElement('hgroup');
    </script>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <![endif]-->

    {!! wp_head() !!}
</head>
<body {!! body_class() !!}>
    <!--[if lt IE 9]>
        <div class="notice info browserupgrade">
            <div class="container"><div class="grid-table grid-va-middle">
                <div class="grid-col-icon">
                    <i class="fa fa-plug"></i>
                </div>
                <div class="grid-sm-12">
                Du använder en gammal webbläsare. För att hemsidan ska fungera så bra som möjligt bör du byta till en modernare webbläsare. På <a href="http://browsehappy.com">browsehappy.com</a> kan du få hjälp att hitta en ny modern webbläsare.
                </div>
            </div></div>
        </div>
    <![endif]-->

    <div id="wrapper">
        @include('partials.stripe')

        <div class="container">
            <div class="grid">
                <div class="grid-md-5 logo">
                    <em>Dunkers</em>Kulturhus
                </div>
                <div class="grid-md-7 text-right-md text-right-lg">
                    <div class="pong-error-message">
                        <em>404</em>
                        {{ get_field('404_error_message', 'option') ? get_field('404_error_message', 'option') : 'The page could not be found' }}
                        <ul class="actions">
                            @if (is_array(get_field('404_display', 'option')) && in_array('search', get_field('404_display', 'option')))
                            <li>
                                <a rel="nofollow" href="{{ home_url() }}?s={{ $keyword }}">{{ sprintf(get_field('404_display', 'option') ? get_field('404_search_link_text', 'option') : 'Search "%s"', $keyword) }}</a>
                            </li>
                            @endif

                            @if (is_array(get_field('404_display', 'option')) && in_array('home', get_field('404_display', 'option')))
                            <li><a href="{{ home_url() }}">{{ get_field('404_home_link_text', 'option') ? get_field('404_home_link_text', 'option') : 'Go to home' }}</a></li>
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        @yield('content')
     </div>

    {!! wp_footer() !!}

</body>
</html>
