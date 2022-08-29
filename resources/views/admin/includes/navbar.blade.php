<nav class="navbar-sidebar2">
    <ul class="list-unstyled navbar__list">
        
        @foreach (Config::get('menu.admin') as $sidebar)

                @if(count(array_intersect($sidebar['permissions'], auth()->user()->permissions())) > 0 || empty($sidebar['permissions']))
                    
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
                            @if(count(array_intersect($item['permissions'], auth()->user()->permissions())) > 0)
                                <li>
                                    <a href="{{route($item['route'])}}">
                                        {{$item['title']}}</a>
                                </li>
                            @endif
                        @endforeach
                    </ul>
                    @endif
                </li>
                @endif
            
        @endforeach
    </ul>
</nav>