@extends('base.base')

@section('main')

    <!-- content begin -->
    <div class="no-bottom no-top" id="content">
        <div id="top"></div>
            
        <!-- section begin -->
        <section id="subheader" class="jarallax">
            <img class="jarallax-img" src="/images/background/6.jpg" alt="" />
            <div class="center-y relative text-center">
                <div class="container">
                    <div class="row">
                        <div class="col-md-8 offset-md-2 text-center">
                            <h2>@{{title}}</h2>
                            <p>@{{created_at}}</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- section close -->

        <!-- section begin -->
		<section id="section-main" aria-label="section-menu">
            <div class="container">
                <div class="row g-5">
                    <div class="col-md-8 offset-md-2">
                        <div class="de-post-read">
                                <div class="post-content">
                                    <div class="post-text" v-html="content">
                                        
                                    </div>
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
            el: '#content',
            data: {
                image: '',
                title: '',
                content: '',
                created_at: '',
            },
            async mounted() {
                const id = window.location.href.split('/')[4]
                this.fetchNews(id)
            },
            methods: {
                fetchNews(id) {
                    const data = {
                        params: {
                            status: 1
                        }
                    }
                    axios.get(`/api/front/news/`+id, data).then((response) => {
                        console.log(response.data.data)
                        this.image = response.data.data.image
                        this.title = response.data.data.title
                        this.content = response.data.data.content
                        this.created_at = response.data.data.created_at
                    })
                }
            },
            watch: {

            }
        })

    </script>
@endsection