<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="au theme template">
    <meta name="author" content="Hau Nguyen">
    <meta name="keywords" content="au theme template">

    <!-- Title Page-->
    <title>Dashboard 2</title>
    <base href="{{asset('')}}">
    <!-- Fontfaces CSS-->
    @include('admin.includes.add-css')

</head>

<body class="animsition">
    <div class="page-wrapper">
        <!-- MENU SIDEBAR-->
        @include('admin.includes.sidebar')
        <!-- END MENU SIDEBAR-->

        <!-- PAGE CONTAINER-->
        <div class="page-container2">
            <!-- HEADER DESKTOP-->
            @include('admin.includes.header')
            <!-- END HEADER DESKTOP-->
            <section class="statistic m-t-50" style="padding: 40px 10px;">
                @yield('main-admin')
            </section>

            @include('admin.includes.footer')
            <!-- END PAGE CONTAINER-->
        </div>

    </div>

    @include('admin.includes.add-js')
</body>

</html>
<!-- end document-->
