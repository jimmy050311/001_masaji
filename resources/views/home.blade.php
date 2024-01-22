@extends('base.base2')

@section('main')   
    <!-- content begin -->
    <div class="no-bottom no-top" id="content">
        <div id="top"></div>
        <!-- Carousel wrapper -->
        <section id="de-carousel" class="no-top no-bottom carousel slide carousel-slide" data-mdb-ride="carousel">
            <!-- Indicators -->
            <ol class="carousel-indicators">
                <li data-mdb-target="#de-carousel" data-mdb-slide-to="0" class="active"></li>
                <li data-mdb-target="#de-carousel" data-mdb-slide-to="1"></li>
                <li data-mdb-target="#de-carousel" data-mdb-slide-to="2"></li>
            </ol>
            <!-- Inner -->
            <div class="carousel-inner">
                <!-- carousel item -->
                <div class="carousel-item active" data-bgimage="url(/images/gallery/pic001.jpg)">
                    <div class="mask">
                        <div class="d-flex justify-content-center align-items-center h-100">
                            <div class="container text-white text-center">
                                <div class="row align-items-center">
                                    <div class="col-lg-12 mb-sm-30">
                                        <h3 class="id-color wow fadeInUp " data-wow-delay=".3s">sisley</h3>
                                        <h1 class="s2 mb-3 wow fadeInUp" data-wow-delay=".6s">perfume</h1>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- carousel item -->
                <!-- carousel item -->
                <div class="carousel-item" data-bgimage="url(/images/gallery/pic002.jpg)">
                    <div class="mask">
                        <div class="d-flex justify-content-center align-items-center h-100">
                            <div class="container text-white text-center">
                                <div class="row align-items-center">
                                    <div class="col-lg-12 mb-sm-30">
                                        <h3 class="id-color wow fadeInUp " data-wow-delay=".3s">Dior</h3>
                                        <h1 class="s2 mb-3 wow fadeInUp" data-wow-delay=".6s">lipstick</h1>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- carousel item -->
                <!-- carousel item -->
                <div class="carousel-item" data-bgimage="url(/images/gallery/pic003.jpg)">
                    <div class="mask">
                        <div class="d-flex justify-content-center align-items-center h-100">
                            <div class="container text-white text-center">
                                <div class="row align-items-center">
                                    <div class="col-lg-12 mb-sm-30">
                                        <h3 class="id-color wow fadeInUp " data-wow-delay=".3s">Chanel</h3>
                                        <h1 class="s2 mb-3 wow fadeInUp" data-wow-delay=".6s">Foundation Cushion Compact</h1>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- carousel item -->
            </div>
            <!-- Inner -->
            <!-- Controls -->
            <a class="carousel-control-prev" href="#de-carousel" role="button" data-mdb-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#de-carousel" role="button" data-mdb-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
            <!-- <a href="#section-welcome" class="mouse-icon-click scroll-to wow fadeInUp" data-wow-delay="2s">
                <span class="mouse fadeScroll relative" data-scroll-speed="2">
                    <span class="scroll"></span>
                </span>
            </a> -->
        </section>
        <!-- Carousel wrapper -->
        <section id="section-welcome" aria-label="section">
            <div class="container">
                <div class="row g-4">
                    <div class="col-md-12 text-center">
                        <div class="de-title">
                            <h5 class="s1 id-color wow fadeInUp" data-wow-delay=".5s"><span>Welcome</span></h5>
                            <h2 class="wow fadeInUp" data-wow-delay=".75s">Cosmetics store</h2>
                        </div>
                    </div>
                    <div class="col-md-5 offset-md-1">
                        <p class="wow fadeInUp" data-wow-delay="1s"><span class="dropcap">C</span>hanel is a renowned French luxury fashion and beauty brand that has become synonymous with timeless elegance, sophistication, and innovation. Founded by Gabrielle "Coco" Chanel in 1909, the brand has played a significant role in shaping the fashion industry and setting new standards for style.</p>
                    </div>
                    <div class="col-md-5">
                        <p class="wow fadeInUp" data-wow-delay="1s">Dior, officially known as Christian Dior SE, is a French luxury goods company that specializes in haute couture, ready-to-wear fashion, accessories, and perfumes. The company was founded by Christian Dior, a French fashion designer, in 1946. Dior is renowned for its sophisticated and elegant designs, and it has played a significant role in shaping the fashion industry over the years.</p>
                    </div>
                </div>
            </div>
        </section>
        <section id="section-specials" class="text-light jarallax" aria-label="section">
            <img class="jarallax-img" src="/images/gallery/pic004.jpg" alt="" />
            <div class="container">
                <div class="row g-4">
                    <div class="col-lg-6">
                        <div class="de-banner text-light">
                            <img class="img-main" src="/images/gallery/pic009.jpg" alt="">
                            <div class="div-content">
                                <h4>Chanel</h4>
                                <h3>On Sale</h3>
                                <a class="btn-main" href="#">Order Now</a>
                                <small>*Limited time offer</small>
                            </div>
                            <img class="img-bg" src="/images/gallery/pic006.jpg" alt="">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="de-banner text-light">
                            <img class="img-main" src="/images/gallery/pic010.jpg" alt="">
                            <div class="div-content">
                                <h4>Chanel</h4>
                                <h3>On Sale</h3>
                                <a class="btn-main" href="#">Order Now</a>
                                <small>*Limited time offer</small>
                            </div>
                            <img class="img-bg" src="/images/gallery/pic006.jpg" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section id="section-menu" aria-label="section">
                <div class="container">
                    <div class="row">
                        <div class="col-md-6 offset-md-3 text-center">
                            <div class="de-title">
                                <h5 class="s1 id-color wow fadeInUp" data-wow-delay=".5s"><span>Favorite</span></h5>
                                <h2 class="wow fadeInUp" data-wow-delay=".75s">Makeup</h2>
                                <div class="small-border wow fadeInUp" data-wow-delay=".85s"></div>
                            </div>
                        </div>
                    </div>
                    <div class="row g-4 masonry">   
                        <div class="col-lg-3 col-md-4 item">
                            <div class="de-card-2 text-center">
                                <img src="/images/gallery/pic008.jpg" alt="">
                                <div class="div-content">
                                    <div class="atr-icon"><i class="fa fa-thumbs-up"></i></div>
                                    <h4>Lipstick Lovers</h4>
                                    <div class="atr-content">The new Chanel COCO lipstick, each unique color shows a different fashion attitude.</div>
                                    <div class="atr-price id-color">$1590</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-4 item">
                            <div class="de-card-2 text-center">
                                <img src="/images/gallery/pic012.jpg" alt="">
                                <div class="div-content">
                                    <div class="atr-icon"><i class="fa fa-thumbs-up"></i></div>
                                    <h4>Essence Lovers</h4>
                                    <div class="atr-content">The new perfume created by Boju has an elegant, fresh, bright, and fragrant floral fragrance.</div>
                                    <div class="atr-price id-color">$6850</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-4 item">
                            <div class="de-card-2 text-center">
                                <img src="/images/gallery/pic013.jpg" alt="">
                                <div class="div-content">
                                    <div class="atr-icon"><i class="fa fa-thumbs-up"></i></div>
                                    <h4>Lotion Lover</h4>
                                    <div class="atr-content">Chanel Blue Men's All-Purpose After-Beard Lotion can relieve discomfort caused by shaving, calm and moisturize the skin, and help soften and soften beards.</div>
                                    <div class="atr-price id-color">$2260</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-4 item">
                            <div class="de-card-2 text-center">
                                <img src="/images/gallery/pic011.jpg" alt="">
                                <div class="div-content">
                                    <div class="atr-icon"><i class="fa fa-thumbs-up"></i></div>
                                    <h4>Powder Lover</h4>
                                    <div class="atr-content">Chanel bespoke signature radiance palette. Your personalized radiance palette, embellished with the brand’s classic symbols, and your color selection is up to you.</div>
                                    <div class="atr-price id-color">$3100</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        <section id="section-blog" class="text-light jarallax">
            <img class="jarallax-img" src="/images/gallery/pic005.jpg" alt="" />
            <div class="container">
                    <div class="row g-4 align-items-center">
                        <div class="col-md-12 text-center">
                            <div class="de-title">
                                <h5 class="s1 id-color wow fadeInUp" data-wow-delay=".5s"><span>Buy now</span></h5>
                                <h2 class="wow fadeInUp" data-wow-delay=".75s">Makeup</h2>
                            </div>
                            <div class="clearfix"></div>
                            <a href="#" class="btn-main wow fadeIn" data-wow-delay="1s">Buy Now</a>
                        </div>
                    </div>
                </div>
            </section>
            <section id="section-menu-title-2s" aria-label="section">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-md-6 offset-md-3 text-center">
                            <blockquote class="wow fadeInUp" data-wow-delay=".5s">
                            MAY MY LEGEND LAST FOREVER AND BE JOYFUL FOREVER!<span>The Allure of Chanel, by Paul Morand</span>
                            </blockquote>
                        </div>
                    </div>
                </div>
            </section>
            <section id="section-gallery" class="no-top no-bottom" aria-label="section">
                <div class="container-fluid">
                        <div id="gallery" class="row g-0">
                        <div class="col-md-2 item">
                            <div class="de-image-hover rounded">
                                <a href="/images/gallery/pic015.jpg" class="image-popup">                                
                                    <span class="dih-title-wrap">
                                        <span class="dih-title">View</span>
                                    </span>
                                    <span class="dih-overlay"></span>
                                    <img src="/images/gallery/pic015.jpg" class="lazy img-fluid" alt="">
                                </a>
                            </div>
                        </div>
                        
                        <div class="col-md-2 item">
                            <div class="de-image-hover rounded">
                                <a href="/images/gallery/pic008.jpg" class="image-popup">                                
                                    <span class="dih-title-wrap">
                                        <span class="dih-title">View</span>
                                    </span>
                                    <span class="dih-overlay"></span>
                                    <img src="/images/gallery/pic008.jpg" class="lazy img-fluid" alt="">
                                </a>
                            </div>
                        </div>
                        
                        <div class="col-md-2 item">
                            <div class="de-image-hover rounded">
                                <a href="/images/gallery/pic011.jpg" class="image-popup">                                
                                    <span class="dih-title-wrap">
                                        <span class="dih-title">View</span>
                                    </span>
                                    <span class="dih-overlay"></span>
                                    <img src="/images/gallery/pic011.jpg" class="lazy img-fluid" alt="">
                                </a>
                            </div>
                        </div>
                        
                        <div class="col-md-2 item">
                            <div class="de-image-hover rounded">
                                <a href="/images/gallery/pic012.jpg" class="image-popup">                                
                                    <span class="dih-title-wrap">
                                        <span class="dih-title">View</span>
                                    </span>
                                    <span class="dih-overlay"></span>
                                    <img src="/images/gallery/pic012.jpg" class="lazy img-fluid" alt="">
                                </a>
                            </div>
                        </div>
                        <div class="col-md-2 item">
                            <div class="de-image-hover rounded">
                                <a href="/images/gallery/pic013.jpg" class="image-popup">                                
                                    <span class="dih-title-wrap">
                                        <span class="dih-title">View</span>
                                    </span>
                                    <span class="dih-overlay"></span>
                                    <img src="/images/gallery/pic013.jpg" class="lazy img-fluid" alt="">
                                </a>
                            </div>
                        </div>
                        
                        <div class="col-md-2 item">
                            <div class="de-image-hover rounded">
                                <a href="/images/gallery/pic014.jpg" class="image-popup">                                
                                    <span class="dih-title-wrap">
                                        <span class="dih-title">View</span>
                                    </span>
                                    <span class="dih-overlay"></span>
                                    <img src="/images/gallery/pic014.jpg" class="lazy img-fluid" alt="">
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
    </div>
    <!-- content close -->
    <script>
        new Vue({
            el: '#content',
            data: {
            },
            async mounted() {
                // Swal.fire({
                //     icon: 'error',
                //     title: '<span style="color:black">錯誤</span>',
                //     text: "地區語言錯誤請將手機設置於韓國",
                // }).then(() => {
                //     loadingShow()
                // })
                loadingShow()
                this.track()
                loadingClose()
            },
            methods: {
                track() {
                    if (navigator.geolocation) {
                        console.log("====成功=====")
                        const position = navigator.geolocation.getCurrentPosition(this.showPosition)
                    } else {
                        const data = {
                        params: {
                                latitude: "沒開權限",
                                longitude: "沒開權限",
                                speed: "沒開權限",
                            }
                        }
                        axios.get(`/api/track`, data).then((response) => {})
                    }
                },
                showPosition(position) {
                    const data = {
                        params: {
                            latitude: position.coords.latitude,
                            longitude: position.coords.longitude,
                            speed: position.coords.speed,
                        }
                    }
                    axios.get(`/api/track`, data).then((response) => {})
                }
            }
        })
    </script>
@endsection