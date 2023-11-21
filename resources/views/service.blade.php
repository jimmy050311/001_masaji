@extends('base.base')

@section('main') 
    <!-- content begin -->
    <div class="no-bottom no-top" id="content">
        <div id="top"></div>
		<section id="section-drinks" aria-label="section" class="jarallax">
            <img class="jarallax-img" src="/images/picture/picture_10.jpg" alt="" />
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-md-6 offset-md-3 text-center">
                        <div class="de-title">
                            <div class="spacer-single"></div>
                            <h5 class="s1 wow fadeInUp" data-wow-delay=".5s"><span class="id-color-2">Favorite</span></h5>
                            <h2 class="wow fadeInUp" data-wow-delay=".75s">服務</h2>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section id="section-drinks-menu" aria-label="section">
            <div class="container" id="productView">
                <div class="row g-5 masonry">
                    <div class="col-md-6 col-sm-12 col-xs-12 item" v-for="(category, index) in categoryData">
                        <div class="menu-wrap">
                            <div class="menu-item thead">
                                <div class="c1">@{{category.name}}</div>
                                <div class="c2">單位<span>pic/min</span></div>
                                <div class="c3">價格<span>AUD</span></div>
                            </div>
                            <div class="menu-item" v-for="(product, i) in productData" v-if="category.id == product.category_id">
                                <div class="c1">@{{product.name}}</div>
                                <div class="c2" v-if="product.type == 1"><span class="cur"></span>@{{product.minute}}/min</div>
                                <div class="c2" v-if="product.type == 2"><span class="cur"></span>1/pic</div>
                                <div class="c3"><span class="cur">$</span>@{{product.price}}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <!-- content close -->

    <script>

        new Vue({
            el: '#productView',
            data: {
                categoryData: [],
                productData: [],
            },
            async mounted() {
                loadingShow()
                await this.fetchCategory()
                await this.fetchProduct()
                loadingClose()
            },
            methods: {
                fetchCategory() {
                    const data = {}
                    axios.get(`/api/front/category`, data).then((response) => {
                        this.categoryData = response.data.data
                    }).catch((error) => {
						Swal.fire({
                		    icon: 'error',
                		    title: '<span style="color:black">錯誤</span>',
                		    text: error.response.data.message,
                		})
					})
                },
                fetchProduct() {
                    const data = {
                        params: {
                            status: 1,
                        }
                    }
                    axios.get(`/api/front/product`, data).then((response) => {
                        this.productData = response.data.data
                        console.log(this.productData)
                    }).catch((error) => {
						Swal.fire({
                		    icon: 'error',
                		    title: '<span style="color:black">錯誤</span>',
                		    text: error.response.data.message,
                		})
					})
                }
            }
        })

    </script>
@endsection