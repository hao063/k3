<div class="collapse navbar-collapse" id="worldNav">
    <ul class="navbar-nav ml-auto">
        <li class="nav-item active">
            <a class="nav-link" href="/">Home <span class="sr-only">(current)</span></a>
        </li>
        @if(Auth::check())
            <li class="nav-item">
                <a class="nav-link" href="{{route('logout.frontend')}}">Logout ({{Auth::user()->name}})</a>
            </li>
        @else
            <li class="nav-item">
                <a class="nav-link" href="{{route('login.frontend')}}">Login</a>
            </li>
        @endif
    </ul>
    <!-- Search Form  -->
    <div id="search-wrapper">
        <form action="#">
            <input type="text" id="search" placeholder="Search something...">
            <div id="close-icon"></div>
            <input class="d-none" type="submit" value="">
        </form>
    </div>
</div>