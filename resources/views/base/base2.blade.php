<!DOCTYPE html>
<html lang="">
@include('base.header')
@include('base.loading')
<body class="dark-scheme">
    <div id="wrapper">
        <div id="preloader">
            <div class="preloader1"></div>
        </div>
        
        @yield('main')

        <a href="#" id="back-to-top"></a>
        <!-- footer begin -->
    </div>
    
    @include('base.footer')
</body>
</html>