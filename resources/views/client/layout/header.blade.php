<header id="header" class="header-v2">

    <!-- HEADER TOP -->
    <div class="header_top">
        <div class="container">
            <div class="header_left float-left">
                <span><i class="lotus-icon-cloud"></i> 24 °C</span>
                <span><i class="lotus-icon-location"></i> Việt Nam</span>
                <span><i class="lotus-icon-phone"></i> (+84) 987124921</span>
            </div>
            <div class="header_right float-right">

                @if(auth()->user())
                    <div class="dropdown currency">
                        <span>{{auth()->user()->name}}</span>
                        <ul>
                            @if( auth()->user()->role  == 'Customer')
                            <li></li>
                            @else
                            <li><a href="{{route('dashboard.index')}}">Quản lý</a></li>
                            @endif
                            @if( auth()->user()->role  == 'Customer')
                            <li><a href="{{route('userProfile', ['id'=>auth()->user()->id])}}">Hồ sơ</a></li>
                            @endif
                            <li><a href="{{route('order', ['user'=>auth()->user()->id])}}">Lịch sử</a></li>
                            <li>
                                <form action="{{route('logout')}}" method="POST" id="logout">
                                    @csrf
                                    <a onclick="document.getElementById('logout').submit();">Đăng Xuất</a>
                                </form>
                            </li>
                        </ul>
                    </div>
                @else
                    <span class="login-register">
                            <a href="{{route('login')}}">Đăng nhập</a>
                            <a href="{{route('register')}}">Đăng ký?</a>
                        </span>
                @endif

            </div>
        </div>
    </div>
    <!-- END / HEADER TOP -->

    <!-- HEADER LOGO & MENU -->
    <div class="header_content" id="header_content">

        <div class="container">
            <!-- HEADER LOGO -->
            <div class="header_logo">
                <a href="{{ route('home') }}"><img style="width: 150px" src="{{ asset('img/logo/sip.png') }}" alt=""></a>
            </div>
            <!-- END / HEADER LOGO -->

            <!-- HEADER MENU -->
            <nav class="header_menu" style="float: left; padding-left: 60px;">
                <ul class="menu">
                    <li class="current-menu-item">
                        <a href="{{ route('home') }}">Trang chủ </a>
                    </li>
                    <li>
                        <a href="{{ route('event') }}">Sự Kiện </a>
                    </li>
                    <li>
                        <a href="{{ route('gallery') }}">Triển Lãm </a>
                    </li>
                    <li><a href="{{ route('about') }}">Thông Tin</a></li>
                    <li><a href="{{ route('contact') }}">Liên Hệ</a></li>
                    <li><a href="{{ route('term') }}">Điều khoản và điều kiện</a></li>
                </ul>
            </nav>
            <!-- END / HEADER MENU -->

            <!-- MENU BAR -->
            <span class="menu-bars">
                        <span></span>
                    </span>
            <!-- END / MENU BAR -->

        </div>
    </div>
    <!-- END / HEADER LOGO & MENU -->

</header>
