@if($extensions and count($extensions) > 0)
    <li class="menu-header">{{ $name }}</li>
    @foreach ($extensions as $extension)
        @php($items = config($extension->getLowerName() . '.elements.admin_menu', []))
        @foreach ($items as $menu)
            @if(isset($menu['type']) && $menu['type'] === 'dropdown')
                <li class="dropdown {{ nav_active($extension->getLowerName(), dropdown: true) }}">
                    <a href="#" class="nav-link has-dropdown" data-toggle="dropdown">
                        {!! $menu['icon'] !!}
                        <span>{{ __($menu['name']) }}</span>
                    </a>
                    <ul class="dropdown-menu">
                        @foreach($menu['items'] as $item)
                            <li>
                                <a class="nav-link {{ nav_active($item['href'], href: true) }}"
                                   href="{{ $item['href'] }}">
                                    {{ __($item['name']) }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </li>
            @else
                <li>
                    <a class="nav-link {{ nav_active($extension->getLowerName(), true) }}"
                       style="{{ $menu['style'] ?? '' }}"
                       href="{{ $menu['href'] }}">
                        {!! $menu['icon'] !!}
                        <span>{!! __($menu['name']) !!}</span>
                    </a>
                </li>
            @endif
        @endforeach
    @endforeach
@endif
