<aside class="menu-sidebar2">
    <div class="logo">
        <a href="#">
            <img src="admins/images/icon/logo-white.png" alt="Cool Admin" />
        </a>
    </div>
    <div class="menu-sidebar2__content js-scrollbar1">
        <div class="account2">
            <div class="image img-cir img-120">
                <img src="admins/images/icon/avatar-big-01.jpg" alt="John Doe" />
            </div>
            <h4 class="name">{{auth()->user()->name}}</h4>
            <a href="{{route('admin.logout')}}">Sign out</a>
        </div>
        @include('admin.includes.navbar')

    </div>
</aside>