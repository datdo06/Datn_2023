@section('header')
<header class="page-header" style="padding-bottom: 24px">
    <!-- RD Navbar-->
    <div class="rd-navbar-wrap">
        <nav class="rd-navbar rd-navbar-default-with-top-panel" data-layout="rd-navbar-fixed" data-sm-layout="rd-navbar-fixed" data-md-layout="rd-navbar-fullwidth" data-md-device-layout="rd-navbar-fixed" data-lg-layout="rd-navbar-fullwidth" data-lg-device-layout="rd-navbar-fullwidth" data-md-stick-up-offset="90px" data-lg-stick-up-offset="150px" data-stick-up="true" data-sm-stick-up="true" data-md-stick-up="true" data-lg-stick-up="true">
            <div class="rd-navbar-top-panel rd-navbar-collapse">
                <div class="rd-navbar-top-panel-inner">
                    <div class="left-side">
                        <div class="group"><span class="text-italic">Follow Us:</span>
                            <ul class="list-inline">
                                <li><a class="icon icon-sm icon-secondary-5 fa fa-instagram" href="#"></a></li>
                                <li><a class="icon icon-sm icon-secondary-5 fa fa-facebook" href="#"></a></li>
                                <li><a class="icon icon-sm icon-secondary-5 fa fa-twitter" href="#"></a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="center-side">
                        <!-- RD Navbar Brand-->
                        <div class="rd-navbar-brand fullwidth-brand"><a class="brand-name" href="index.html"><img src="site/images/logo-default-314x48.png" alt="" width="314" height="48"/></a></div>
                    </div>
                    <div class="right-side">
                        <!-- Contact Info-->
                        <div class="contact-info">
                            <div class="unit unit-middle unit-horizontal unit-spacing-xs">
                                <div class="unit__left"><span class="icon icon-primary text-middle mdi mdi-phone"></span></div>
                                <div class="unit__body"><a class="text-middle" href="tel:#">+1 (409) 987–5874</a></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="rd-navbar-inner">
                <!-- RD Navbar Panel-->
                <div class="rd-navbar-panel">
                    <!-- RD Navbar Toggle-->
                    <button class="rd-navbar-toggle" data-rd-navbar-toggle=".rd-navbar-nav-wrap"><span></span></button>
                    <!-- RD Navbar collapse toggle-->
                    <button class="rd-navbar-collapse-toggle" data-rd-navbar-toggle=".rd-navbar-collapse"><span></span></button>
                    <!-- RD Navbar Brand-->
                    <div class="rd-navbar-brand mobile-brand"><a class="brand-name" href="index.html"><img src="site/logo-default-314x48.png" alt="" width="314" height="48"/></a></div>
                </div>
                <div class="rd-navbar-aside-right">
                    <div class="rd-navbar-nav-wrap">
                        <div class="rd-navbar-nav-scroll-holder">
                            <ul class="rd-navbar-nav">
                                <li class="active"><a href="{{route('home')}}">Home</a>
                                </li>
                                <li><a href="{{route('about')}}">About Us</a>
                                </li>
                                <li><a href="{{route('contacts')}}">Contacts</a>
                                </li>
                                <li><a href="{{route('typography')}}">Typography</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </nav>
    </div>
</header>
@endsection
