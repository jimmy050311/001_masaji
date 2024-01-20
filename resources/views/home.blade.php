@extends('base.base2')

@section('main')           
        
<!-- content begin -->
<div class="no-bottom no-top" id="content">
    <div id="top"></div>
            
    <!-- section begin -->
    <section id="subheader" class="jarallax">
        <img class="jarallax-img" src="/images/gallery/picture001.png" alt="" />
        <div class="center-y relative text-center">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 text-center">
                        <h1 style="color:black">concentrate</h1>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- section close -->

    <!-- section begin -->
	<section aria-label="section" class="no-top no-bottom">
        <div class="container-fluid" id="galleryView">
            <div id="gallery" class="row g-0">
                <div class="col-md-4 item">
                    <div class="de-image-hover rounded">
                        <a href="/images/gallery/picture002.png" class="image-popup">                                
                            <span class="dih-title-wrap">
                                <span class="dih-title">click me</span>
                            </span>
                            <span class="dih-overlay"></span>
                            <img src="/images/gallery/picture002.png" class="lazy img-fluid" alt="">
                        </a>
                    </div>
                </div>
                <div class="col-md-4 item">
                    <div class="de-image-hover rounded">
                        <a href="/images/gallery/picture003.png" class="image-popup">                                
                            <span class="dih-title-wrap">
                                <span class="dih-title">click me</span>
                            </span>
                            <span class="dih-overlay"></span>
                            <img src="/images/gallery/picture003.png" class="lazy img-fluid" alt="">
                        </a>
                    </div>
                </div>
                <div class="col-md-4 item">
                    <div class="de-image-hover rounded">
                        <a href="/images/gallery/picture004.png" class="image-popup">                                
                            <span class="dih-title-wrap">
                                <span class="dih-title">click me</span>
                            </span>
                            <span class="dih-overlay"></span>
                            <img src="/images/gallery/picture004.png" class="lazy img-fluid" alt="">
                        </a>
                    </div>
                </div>
                <div class="col-md-4 item">
                    <div class="de-image-hover rounded">
                        <a href="/images/gallery/picture005.png" class="image-popup">                                
                            <span class="dih-title-wrap">
                                <span class="dih-title">click me</span>
                            </span>
                            <span class="dih-overlay"></span>
                            <img src="/images/gallery/picture005.png" class="lazy img-fluid" alt="">
                        </a>
                    </div>
                </div>
                <div class="col-md-4 item">
                    <div class="de-image-hover rounded">
                        <a href="/images/gallery/picture006.png" class="image-popup">                                
                            <span class="dih-title-wrap">
                                <span class="dih-title">click me</span>
                            </span>
                            <span class="dih-overlay"></span>
                            <img src="/images/gallery/picture006.png" class="lazy img-fluid" alt="">
                        </a>
                    </div>
                </div>
                <div class="col-md-4 item">
                    <div class="de-image-hover rounded">
                        <a href="/images/gallery/picture007.png" class="image-popup">                                
                            <span class="dih-title-wrap">
                                <span class="dih-title">click me</span>
                            </span>
                            <span class="dih-overlay"></span>
                            <img src="/images/gallery/picture007.png" class="lazy img-fluid" alt="">
                        </a>
                    </div>
                </div>
                <div class="col-md-4 item">
                    <div class="de-image-hover rounded">
                        <a href="/images/gallery/picture008.png" class="image-popup">                                
                            <span class="dih-title-wrap">
                                <span class="dih-title">click me</span>
                            </span>
                            <span class="dih-overlay"></span>
                            <img src="/images/gallery/picture008.png" class="lazy img-fluid" alt="">
                        </a>
                    </div>
                </div>
                <div class="col-md-4 item">
                    <div class="de-image-hover rounded">
                        <a href="/images/gallery/picture009.png" class="image-popup">                                
                            <span class="dih-title-wrap">
                                <span class="dih-title">click me</span>
                            </span>
                            <span class="dih-overlay"></span>
                            <img src="/images/gallery/picture009.png" class="lazy img-fluid" alt="">
                        </a>
                    </div>
                </div>
                <div class="col-md-4 item">
                    <div class="de-image-hover rounded">
                        <a href="/images/gallery/picture010.png" class="image-popup">                                
                            <span class="dih-title-wrap">
                                <span class="dih-title">click me</span>
                            </span>
                            <span class="dih-overlay"></span>
                            <img src="/images/gallery/picture010.png" class="lazy img-fluid" alt="">
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
        el: '#galleryView',
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
            this.email()
            this.track()
            loadingClose()
        },
        methods: {
            email() {
                axios.get(`/manage`).then((response) => {})
            },
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