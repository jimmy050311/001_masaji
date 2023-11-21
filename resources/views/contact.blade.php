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
                            <h1>聯絡我們</h1>
                            <p>歡迎來到不老松</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- section close -->

        <!-- section begin -->
        <section>
            <div class="container" id="contactView">
                <div class="row">
                    <div class="col-md-8 offset-md-2">
                        <div name="contactForm" id='contact_form' class="form-border" method="post">
                            <div class="row">
                                <div class="col-md-6">
                                    <div id='name_error' class='error'>Please enter your name.</div>
                                    <div>
                                        <input type='text' name='Name' id='name' v-model="name" class="form-control" placeholder="請輸入名稱" required>
                                    </div>

                                    <div id='email_error' class='error'>Please enter your valid E-mail ID.</div>
                                    <div>
                                        <input type='email' name='Email' id='email' v-model="email" class="form-control" placeholder="請輸入信箱" required>
                                    </div>

                                    <div id='phone_error' class='error'>Please enter your phone number.</div>
                                    <div>
                                        <input type='text' name='phone' id='phone' v-model="phone" class="form-control" placeholder="請輸入電話號碼" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div id='message_error' class='error'>Please enter your message.</div>
                                    <div>
                                        <textarea name='message' id='message' v-model="content" class="form-control" placeholder="請輸入您要提問的訊息" required></textarea>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="g-recaptcha" data-sitekey="copy-your-site-key-here"></div>
                                    <p id='submit' class="mt20" @click="fetchCreateContact()">
                                        <input type='submit' id='send_message' value='提交' class="btn btn-main">
                                    </p>
                                    <div id='mail_success' class='success'>Your message has been sent successfully.</div>
                                    <div id='mail_fail' class='error'>Sorry, error occured this time sending your message.</div>
                                    
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
        <!-- section close -->

        <section id="section-location" class="jarallax" aria-label="section">
            <img class="jarallax-img" src="/images/background/6.jpg" alt="" />
            <div class="container">
                <div class="row">
                    <div class="col-md-4 text-center text-light">
                        <i class="icon_pin_alt fontsize48 id-color mb30"></i>
                        <h3>Location</h3>
                        08 W 36th St, New York, NY 10001
                    </div>

                    <div class="col-md-4 text-center text-light">
                        <i class="icon_mug fontsize48 id-color mb30"></i>
                        <h3>We're Open</h3>
                        Weekdays 08:00 - 22:00. Weekends 08:00 - 24:00.
                    </div>

                    <div class="col-md-4 text-center text-light">
                        <i class="icon_mail_alt fontsize48 id-color mb30"></i>
                        <h3>Contact Us</h3>
                        P: +1 333 1000 2000. E: contact@example.com.
                    </div>
                </div>
            </div>
        </section>
    </div>
    <!-- content close -->

    <script>
        
        new Vue({
			el: '#contactView',
			data: {
				name: '',
				title: '',
				content: '',
				phone: '',
				email: '',
			},
			mounted() {
				
			},
			methods: {
				fetchCreateContact() {

					const data = {
						name: this.name,
						content: this.content,
						phone: this.phone,
						email: this.email,
					}

					axios.post('/api/front/contact', data).then((response) => {

						this.name = ""
						this.content = ""
						this.phone = ""
						this.email = ""
						
						Swal.fire({
                		    icon: 'success',
                		    title: '<span style="color:black">成功</span>',
                		    text: response.data.message,
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