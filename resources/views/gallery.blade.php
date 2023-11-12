@extends('base.base')

@section('main')     
    <!-- content begin -->
    <div class="no-bottom no-top" id="content">
        <div id="top"></div>
            
        <!-- section begin -->
        <section id="subheader" class="jarallax">
            <img class="jarallax-img" src="images/background/10.jpg" alt="" />
            <div class="center-y relative text-center">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12 text-center">
                            <h1>相簿</h1>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- section close -->

        <!-- section begin -->
		<section aria-label="section" class="no-top no-bottom">
            <div class="container-fluid">
                <div id="gallery" class="row g-0">

                    <div class="col-md-4 item">
                        <div class="de-image-hover rounded">
                            <a href="images/gallery/1.jpg" class="image-popup">                                
                                <span class="dih-title-wrap">
                                    <span class="dih-title">Gallery Title</span>
                                </span>
                                <span class="dih-overlay"></span>
                                <img src="images/gallery/1.jpg" class="lazy img-fluid" alt="">
                            </a>
                        </div>
                    </div>
                        
                    <div class="col-md-4 item">
                        <div class="de-image-hover rounded">
                            <a href="images/gallery/2.jpg" class="image-popup">                                
                                <span class="dih-title-wrap">
                                    <span class="dih-title">Gallery Title</span>
                                </span>
                                <span class="dih-overlay"></span>
                                <img src="images/gallery/2.jpg" class="lazy img-fluid" alt="">
                            </a>
                        </div>
                    </div>
                        
                    <div class="col-md-4 item">
                        <div class="de-image-hover rounded">
                            <a href="images/gallery/3.jpg" class="image-popup">                                
                                <span class="dih-title-wrap">
                                    <span class="dih-title">Gallery Title</span>
                                </span>
                                <span class="dih-overlay"></span>
                                <img src="images/gallery/3.jpg" class="lazy img-fluid" alt="">
                            </a>
                        </div>
                    </div>
                        
                    <div class="col-md-4 item">
                        <div class="de-image-hover rounded">
                            <a href="images/gallery/4.jpg" class="image-popup">                                
                                <span class="dih-title-wrap">
                                    <span class="dih-title">Gallery Title</span>
                                </span>
                                <span class="dih-overlay"></span>
                                <img src="images/gallery/4.jpg" class="lazy img-fluid" alt="">
                            </a>
                        </div>
                    </div>

                    <div class="col-md-4 item">
                        <div class="de-image-hover rounded">
                            <a href="images/gallery/5.jpg" class="image-popup">                                
                                <span class="dih-title-wrap">
                                    <span class="dih-title">Gallery Title</span>
                                </span>
                                <span class="dih-overlay"></span>
                                <img src="images/gallery/5.jpg" class="lazy img-fluid" alt="">
                            </a>
                        </div>
                    </div>
                        
                    <div class="col-md-4 item">
                        <div class="de-image-hover rounded">
                            <a href="images/gallery/6.jpg" class="image-popup">                                
                                <span class="dih-title-wrap">
                                    <span class="dih-title">Gallery Title</span>
                                </span>
                                <span class="dih-overlay"></span>
                                <img src="images/gallery/6.jpg" class="lazy img-fluid" alt="">
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <!-- content close -->
@endsection