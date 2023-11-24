<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from landing.engotheme.com/html/lotus/demo/index-2.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 30 Sep 2023 01:21:02 GMT -->
<head>
    <meta charset="utf-8">
    <!-- TITLE -->
    <title>King The Land</title>

    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="format-detection" content="telephone=no">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <link rel="shortcut icon" href="{{ asset('img/logo/sip.png') }}"/>

    <!-- GOOGLE FONT -->
    <link href="https://fonts.googleapis.com/css?family=Hind:400,300,500,600%7cMontserrat:400,700" rel='stylesheet' type='text/css'>
    <!-- CSS LIBRARY -->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/lib/font-awesome.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/lib/font-lotusicon.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/lib/bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/lib/owl.carousel.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/lib/jquery-ui.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/lib/magnific-popup.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/lib/settings.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/lib/bootstrap-select.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/helper.css') }}">

    <!-- MAIN STYLE -->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}">

    <!--[if lt IE 9]>
    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <script src="http://css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js"></script>
    <![endif]-->
</head>

<!--[if IE 7]> <body class="ie7 lt-ie8 lt-ie9 lt-ie10"> <![endif]-->
<!--[if IE 8]> <body class="ie8 lt-ie9 lt-ie10"> <![endif]-->
<!--[if IE 9]> <body class="ie9 lt-ie10"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--> <body> <!--<![endif]-->


<!-- PRELOADER -->
<div id="preloader">
    <span class="preloader-dot"></span>
</div>
<!-- END / PRELOADER -->

<!-- PAGE WRAP -->
<div id="page-wrap">

    <!-- HEADER -->
    @include('client.layout.header')
    <!-- END / HEADER -->

    @yield('content')

    <!-- FOOTER -->
    @include('client.layout.footer')
    <!-- END / FOOTER -->

</div>
<!-- END / PAGE WRAP -->


<!-- LOAD JQUERY -->
<script data-cfasync="false" src="{{ asset('js/email-decode.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/lib/jquery-1.11.0.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/lib/jquery-ui.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/lib/bootstrap.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/lib/bootstrap-select.js') }}"></script>
<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&amp;signed_in=true"></script>
<script type="text/javascript" src="{{ asset('js/lib/isotope.pkgd.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/lib/jquery.themepunch.revolution.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/lib/jquery.themepunch.tools.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/lib/owl.carousel.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/lib/jquery.appear.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/lib/jquery.countTo.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/lib/jquery.countdown.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/lib/jquery.parallax-1.1.3.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/lib/jquery.magnific-popup.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/lib/SmoothScroll.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/scripts.js') }}"></script>
</body>

<!-- Mirrored from landing.engotheme.com/html/lotus/demo/index-2.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 30 Sep 2023 01:21:03 GMT -->
</html>
