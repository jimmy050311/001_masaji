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
            <div class="container">
                <div class="row">
                    <div class="col-md-8 offset-md-2">
                        <form name="contactForm" id='contact_form' class="form-border" method="post">
                            <div class="row">
                                <div class="col-md-6">
                                    <div id='name_error' class='error'>Please enter your name.</div>
                                    <div>
                                        <input type='text' name='Name' id='name' class="form-control" placeholder="請輸入名稱" required>
                                    </div>

                                    <div id='email_error' class='error'>Please enter your valid E-mail ID.</div>
                                    <div>
                                        <input type='email' name='Email' id='email' class="form-control" placeholder="請輸入信箱" required>
                                    </div>

                                    <div id='phone_error' class='error'>Please enter your phone number.</div>
                                    <div>
                                        <input type='text' name='phone' id='phone' class="form-control" placeholder="請輸入電話號碼" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div id='message_error' class='error'>Please enter your message.</div>
                                    <div>
                                        <textarea name='message' id='message' class="form-control" placeholder="請輸入您要提問的訊息" required></textarea>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="g-recaptcha" data-sitekey="copy-your-site-key-here"></div>
                                    <p id='submit' class="mt20">
                                        <input type='submit' id='send_message' value='提交' class="btn btn-main">
                                    </p>
                                    <div id='mail_success' class='success'>Your message has been sent successfully.</div>
                                    <div id='mail_fail' class='error'>Sorry, error occured this time sending your message.</div>
                                    
                                </div>
                            </div>
                        </form>

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
            <img class="jarallax-img" src="images/background/6.jpg" alt="" />
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

@endsection