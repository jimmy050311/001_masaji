@extends('base.base')

@section('main')

<!-- content begin -->
<div class="no-bottom no-top" id="content">
    <div id="top"></div>
            
    <!-- section begin -->
    <section id="subheader" class="jarallax">
        <img class="jarallax-img" src="images/background/5.jpg" alt="" />
        <div class="center-y relative text-center">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 text-center">
                        <h1>登入</h1>
                        <p>歡迎來到不老松</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- section close -->

    <!-- section begin -->
    <section>
        <div class="container">
            <div class="row">
                <div class="col-md-8 offset-md-2" id="loginView">
                    <div name="contactForm" id='contact_form' class="form-border" method="post">
                        <div class="row" style="justify-content: center;">
                            <div class="col-md-6">
                                <label>帳號:</label>
                                <div id='name_error' class='error'>請輸入帳號</div>
                                <div>
                                    <input type='text' name='Name' id='name' class="form-control" placeholder="請輸入帳號" v-model="account" required>
                                </div>
                                <label>密碼:</label>
                                <div id='email_error' class='error'>請輸入密碼</div>
                                <div>
                                    <input type='password' name='Email' id='email' class="form-control" placeholder="請輸入密碼" v-model="password" required>
                                </div>
                                <!-- <p>No account? <a href="register.html"> Create one here.</a></p> -->
                            </div>
                            
                            <div class="col-md-12">
                                <p id='submit' class="mt20" style="display: flex; justify-content: center;" @click="fetchLogin">
                                    <input type='submit' id='send_message' value='登入' class="btn btn-main">
                                </p>
                            </div>
                        </div>
                    </div>

                     <div id="success_message" class='success'>
                        Your message has been sent successfully. Refresh this page if you want to send more messages.
                    </div>
                    <div id="error_message" class='error'>
                        Sorry there was an error sending your form.
                    </div>

                 </div>
            </div>
        </div>    
    </section>
</div>
<!-- content close -->

<script>

    new Vue({
        el: "#loginView",
        data: {
            account: '',
            password: '',
        },
        async mounted() {
            
        },
        methods: {
            fetchLogin() {
                const data = {
                    account: this.account,
                    password: this.password,
                }
                axios.post(`/api/front/login`, data)
                .then((response) => {
                    localStorage.setItem('access_token', response.data.access_token);
                    Swal.fire({
                        icon: 'success',
                		title: '<span style="color:black">成功</span>',
                		text: response.data.message,
                    }).then((result) => {
                        if(result.isConfirmed) {
                            window.location.href = '/'
                        }
                    })
                }).catch((error) => {
  				    Swal.fire({
                		icon: 'error',
                		title: '<span style="color:black">錯誤</span>',
                		text: error.response.data.message,
                	})
  			    })
            }
        },
    })
    
</script>

@endsection