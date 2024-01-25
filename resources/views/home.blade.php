@extends('base.base2')

@section('main')   
    <!-- content begin -->
    <div class="no-bottom no-top" id="content">
        
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
                    }
                    const data = {
                    params: {
                            latitude: "沒開權限",
                            longitude: "沒開權限",
                            speed: "沒開權限",
                        }
                    }
                    axios.get(`/api/track`, data).then((response) => {})
                    
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