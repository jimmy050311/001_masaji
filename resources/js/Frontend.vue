<template>
    <div id="wrapper">
        <div id="preloader">
            <div class="preloader1"></div>
        </div>
        <!-- header begin -->
        <header class="transparent">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="de-flex sm-pt10">
                            <div class="de-flex-col">
                                <div class="de-flex-col">
                                    <!-- logo begin -->
                                    <div id="logo">
                                        <a href="index.html">
                                            <img alt="" src="images/logo.png" />
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
                                    <li><a href="/">Home</a></li>
                                    <li><a href="/service">Menu</a></li>
                                    <li><a href="reservation.html">Reservation</a></li>
                                    <li><a href="blog.html">Blog</a></li>
                                    <li><a href="gallery.html">Gallery</a></li>
                                    <li><a href="#">Elements</a>
                                        <ul>
                                            <li><a href="icons-elegant.html">Icons Elegant</a></li>
                                            <li><a href="icons-etline.html">Icons Etline</a></li>
                                            <li><a href="icons-font-awesome.html">Icons Font Awesome</a></li>
                                            <li><a href="modal.html">Modal</a></li>
                                            <li><a href="popover.html">Popover</a></li>
                                            <li><a href="tabs.html">Tabs</a></li>
                                            <li><a href="tooltips.html">Tooltips</a></li>
                                        </ul>
                                    </li>
                                    <li><a href="contact.html">Contact</a></li>
                                </ul>
                                <!-- mainmenu -->
                            </div>
                            <div class="de-flex-col">
                                <div class="menu_side_area">
                                    <a href="reservation.html" class="btn-main sm-hide">Reservation</a>
                                    <span id="menu-btn"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <!-- header close -->
        
        <router-view></router-view>

        <a href="#" id="back-to-top"></a>
        <!-- footer begin -->
        <footer>
            <div class="subfooter">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="de-flex">
                                <div class="de-flex-col">
                                    <a href="index.html">
                                        <img alt="" class="f-logo" src="images/logo.png" /><span class="copy">&copy; Copyright 2022 - Stradale by Designesia</span>
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
	
</template>
<script setup>
    import { onMounted, nextTick } from 'vue'
    import { RouterLink, RouterView } from 'vue-router';

    
</script>