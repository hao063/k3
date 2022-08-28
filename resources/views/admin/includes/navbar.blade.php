<nav class="navbar-sidebar2">
    <ul class="list-unstyled navbar__list">
        
        @foreach (Config::get('menu.admin') as $sidebar)
        <li class="has-sub">
            <a class="js-arrow" href="{{$sidebar['route'] != '#' ? route($sidebar['route']) : $sidebar['route']}}">
                <i class="fas fa-tachometer-alt"></i>{{$sidebar['title']}}
                @if($sidebar['childs']  !=  null)
                <span class="arrow">
                    <i class="fas fa-angle-down"></i>
                </span>
                @endif
            </a>
            @if($sidebar['childs']  !=  null)
            <ul class="list-unstyled navbar__sub-list js-sub-list">
                @foreach ($sidebar['childs'] as $item)
                <li>
                    <a href="{{route($item['route'])}}">
                        {{$item['title']}}</a>
                </li>
                @endforeach
            </ul>
            @endif
        </li>
        @endforeach
    </ul>
</nav>