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
                        <h1>Login</h1>
                        <p>Welcome to Stradale Cafe</p>
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
                    <div name="contactForm" id='contact_form' class="form-border" method="post">
                        <div class="row" style="justify-content: center;">
                            <div class="col-md-6">
                                <label>account:</label>
                                <div id='name_error' class='error'>Please enter your name.</div>
                                <div>
                                    <input type='text' name='Name' id='name' class="form-control" placeholder="Your account" required>
                                </div>
                                <label>password:</label>
                                <div id='email_error' class='error'>Please enter your valid E-mail ID.</div>
                                <div>
                                    <input type='password' name='Email' id='email' class="form-control" placeholder="Your password" required>
                                </div>
                                <p>No account? <a href="register.html"> Create one here.</a></p>
                            </div>
                            
                            <div class="col-md-12">
                                <p id='submit' class="mt20" style="display: flex; justify-content: center;">
                                    <input type='submit' id='send_message' value='LOGIN' class="btn btn-main">
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

@endsection