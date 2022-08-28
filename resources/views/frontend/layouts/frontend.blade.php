<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- The above 4 meta tags *must* come first in the head; any other head content must come *after* these tags -->

    <!-- Title  -->
    <title>World - Blog &amp; Magazine Template</title>
    <base href="{{asset('')}}">
    <!-- Favicon  -->
    <link rel="icon" href="frontends/img/core-img/favicon.ico">

    <!-- Style CSS -->
    <link rel="stylesheet" href="frontends/css/bootstrap.min.css">
    <link rel="stylesheet" href="frontends/css/animate.css">
    <link rel="stylesheet" href="frontends/css/owl.carousel.css">
    <link rel="stylesheet" href="frontends/css/magnific-popup.css">
    <link rel="stylesheet" href="frontends/css/font-awesome.min.css">
    <link rel="stylesheet" href="frontends/css/themify-icons.css">
    <link rel="stylesheet" href="frontends/style.css">
    @yield('more-css')
</head>

<body>
    <!-- Preloader Start -->
    <div id="preloader">
        <div class="preload-content">
            <div id="world-load"></div>
        </div>
    </div>
    <!-- Preloader End -->

    <!-- ***** Header Area Start ***** -->
    @include('frontend.includes.header')
    <!-- ***** Header Area End ***** -->

    <!-- ********** Hero Area Start ********** -->
    @include('frontend.includes.banner')
    <!-- ********** Hero Area End ********** -->

    <div class="main-content-wrapper section-padding-100">

        @yield('main')
      
    </div>

    <!-- ***** Footer Area Start ***** -->
    @include('frontend.includes.footer')

    <!-- ***** Footer Area End ***** -->
    <!-- jQuery (Necessary for All JavaScript Plugins) -->
    <script src="frontends/js/jquery/jquery-2.2.4.min.js"></script>
    <!-- Popper js -->
    <script src="frontends/js/popper.min.js"></script>
    <!-- Bootstrap js -->
    <script src="frontends/js/bootstrap.min.js"></script>
    <!-- Plugins js -->
    <script src="frontends/js/plugins.js"></script>
    <!-- Active js -->
    <script src="frontends/js/active.js"></script>
    @yield('more-js')

</body>

</html>