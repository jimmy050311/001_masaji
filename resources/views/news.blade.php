@extends('base.base')

@section('main')     
    <!-- content begin -->
    <div class="no-bottom no-top" id="content">
        <div id="top"></div>
            
        <!-- section begin -->
        <section id="subheader" class="jarallax">
            <img class="jarallax-img" src="/images/picture/picture_10.jpg" alt="" />
            <div class="center-y relative text-center">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12 text-center">
                            <h1>最新消息</h1>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- section close -->

        <!-- section begin -->
		<section id="section-main">
            <div class="container" id="newsView">
                <div class="row g-4">
                    <div class="col-lg-4 col-md-6" v-for="(item, index) in newsData">
                        <div class="d-items">
                           <div class="card-image-1 mod-b">
                               <a :href="/news/+item.id" class="d-text">
                                   <div class="d-inner">
                                        <span class="atr-date">@{{item.created_at}}</span>
                                        <h3>@{{item.title}}</h3>
                                        <p v-html="item.content"></p>
                                        <h5 class="d-tag">youngsong</h5>
                                    </div>
                               </a>
                               <img :src="item.image" class="img-fluid" alt="">
                           </div>
                        </div>
                    </div>

                    <div class="clearfix"></div>
                            
                    <nav aria-label="Page navigation example">
                      <ul class="pagination justify-content-center">
                        
                        <li class="page-item" v-if="currentPage > 1" @click="search(currentPage-1)"><a class="page-link">@{{currentPage - 1}}</a></li>
                        <li class="page-item active"><a class="page-link">@{{currentPage}}</a></li>
                        <li class="page-item" v-if="currentPage < dataPage" @click="search(currentPage+1)"><a class="page-link">@{{currentPage + 1}}</a></li>
                        
                      </ul>
                    </nav>
                </div>
             </div>
        </section>

    </div>
    <!-- content close -->

    <script>
        new Vue({
            el: '#newsView',
            data: {
                dataPage: 1,
                currentPage: 1,
                newsData: [],
            },
            async mounted() {
                this.fetchNews()
            },
            methods: {
                fetchNews() {
                    const data = {
                        params: {
                            status: 1,
                            paginate: 9,
                        }
                    }
                    axios.get(`/api/front/news?page=`+this.currentPage, data).then((response) => {
                        this.dataPage = response.data.dataPage
                        this.newsData = response.data.data
                    })
                },
                search(val) {
                    this.currentPage = val
                }
            },
            watch: {
                currentPage: function(val) {
                    this.currentPage = val
                    this.fetchNews()
                }
            }
        })

    </script>
@endsection