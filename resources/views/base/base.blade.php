<!DOCTYPE html>
<html lang="ko">
@include('base.header')
@include('base.loading')
<body class="dark-scheme">
    <div id="wrapper">
        <div id="preloader">
            <div class="preloader1"></div>
        </div>
        <!-- header begin -->
        <header class="transparent">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="de-flex sm-pt10" id="baseView">
                            <div class="de-flex-col">
                                <div class="de-flex-col">
                                    <!-- logo begin -->
                                    <div id="logo">
                                        <a href="/">
                                            <img alt="" src="/images/logo.png" />
                                        </a>
                                    </div>
                                    <!-- logo close -->
                                </div>
                                <div class="de-flex-col">
                                </div>
                            </div>
                            <div class="de-flex-col header-col-mid">
                                <!-- mainmenu -->
                                <ul id="mainmenu">
                                    <li><a href="/">首頁</a>
                                    </li>
                                    <li><a href="/service">商品服務</a>
                                    </li>
                                    <!-- <li><a href="reservation.html">Reservation</a></li> -->
                                    <li><a href="/news">最新消息</a></li>
                                    <li><a href="/gallery">相簿</a></li>
                                    <li><a href="/contact">聯絡我們</a></li>
                                </ul>
                                <!-- mainmenu -->
                            </div>
                            <div class="de-flex-col">
                                <div class="menu_side_area" v-if="access_token == null">
                                    <a href="/login" class="btn-main sm-hide">登入</a>
                                    <span id="menu-btn"></span>
                                </div>
                                <div class="menu_side_area" v-if="access_token != null">
                                    <a href="/member" class="btn-main sm-hide">會員中心</a>
                                    <span id="menu-btn"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <!-- header close -->
        
        @yield('main')

        <a href="#" id="back-to-top"></a>
        <!-- footer begin -->
        <footer>
            <div class="subfooter">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="de-flex">
                                <div class="de-flex-col">
                                    <a href="/">
                                        <img alt="" class="f-logo" src="/images/logo.png" /><span class="copy">&copy; Copyright 2022 - Stradale by Designesia</span>
                                    </a>
                                </div>
                                <div class="de-flex-col">
                                    <div class="social-icons">
                                        <a href="#"><i class="fa fa-facebook fa-lg"></i></a>
                                        <a href="#"><i class="fa fa-twitter fa-lg"></i></a>
                                        <a href="#"><i class="fa fa-linkedin fa-lg"></i></a>
                                        <a href="#"><i class="fa fa-pinterest fa-lg"></i></a>
                                        <a href="#"><i class="fa fa-rss fa-lg"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
        <!-- footer close -->
    </div>
    
    @include('base.footer')
</body>
</html>
<script>

    new Vue({
        el: '#baseView',
        data: {
            access_token: localStorage.getItem('access_token')
        }
    })

</script>