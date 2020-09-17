<form class="search u-mb-6" method="get" action="/">
    <label for="searchkeyword-mobile" class="sr-only">{{ get_field('search_label_text', 'option') ? get_field('search_label_text', 'option') : 'Search' }}</label>

    <div class="input-group">
        <input id="searchkeyword-mobile" autocomplete="off" class="form-control" type="search" name="s" placeholder="<?php echo get_field('search_placeholder_text', 'option') ? get_field('search_placeholder_text', 'option') : __('What are you looking for?', 'municipio'); ?>" value="<?php echo (!empty(get_search_query())) ? get_search_query() : ''; ?>">
        <span class="input-group-addon-btn">
            <input type="submit" class="btn btn-primary" value="{{ get_field('search_button_text', 'option') ? get_field('search_button_text', 'option') : 'Search' }}">
        </span>
    </div>
</form>

{{-- Mega menu --}}
@if (!empty($megaMenuItems))
    <ul class="mega-menu__list grid">
        @foreach($megaMenuItems as $item)
            <li id="mega-menu-item-{{$item->ID}}" class="mega-menu__item mega-menu__item--parent grid-xs-12 grid-md-6 grid-lg-4 u-mb-6 {{$item->classNames}}">
                <a href="{{$item->url}}">{{$item->title}} <i class="pricon pricon-angle-right"></i></a>
                
                {{-- Children --}}
                @if (!empty($item->children))
                    <ul class="mega-menu__sublist u-mt-3">
                        @foreach($item->children as $child)
                            <li id="mega-menu-item-{{$item->ID}}" class="mega-menu__item mega-menu__item--child {{$child->classNames}}">
                                <a href="{{$child->url}}">{{$child->title}}</a>
                            </li>
                        @endforeach
                    </ul>
                @endif
            </li>
        @endforeach
    </ul>
@endif
