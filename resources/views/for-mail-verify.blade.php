<!doctype html>
<html class="no-js" lang="en">
   <head>
      <meta charset="utf-8">
      <meta http-equiv="x-ua-compatible" content="ie=edge">
      <title>FixMyBuild | Sign In</title>
      <meta name="description" content="">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <!-- Favicon -->
      <link rel="shortcut icon" type="image/x-icon" href="{{ asset('frontend/img/favicon.ico') }}">
      <!-- CSS
         ========================= -->
      <!--bootstrap min css-->
      <link rel="stylesheet" href="{{ asset('frontend/css/bootstrap.min.css') }}">
      <!--owl carousel min css-->
      <link rel="stylesheet" href="{{ asset('frontend/css/owl.carousel.min.css') }}">
      <!--slick min css-->
      <link rel="stylesheet" href="{{ asset('frontend/css/slick.css') }}">
      <!--magnific popup min css-->
      <link rel="stylesheet" href="{{ asset('frontend/css/magnific-popup.css') }}">
      <!--font awesome css-->
      <link rel="stylesheet" href="{{ asset('frontend/css/font.awesome.css') }}">
      <!--ionicons min css-->
      <link rel="stylesheet" href="{{ asset('frontend/css/ionicons.min.css') }}">
      <!--animate css-->
      <link rel="stylesheet" href="{{ asset('frontend/css/animate.css') }}">
      <!--jquery ui min css-->
      <link rel="stylesheet" href="{{ asset('frontend/css/jquery-ui.min.css') }}">
      <!--slinky menu css-->
      <link rel="stylesheet" href="{{ asset('frontend/css/slinky.menu.css') }}">
      <!-- Plugins CSS -->
      <link rel="stylesheet" href="{{ asset('frontend/css/plugins.css') }}">
      <!-- Main Style CSS -->
      <link rel="stylesheet" href="{{ asset('frontend/css/style.css') }}">
      <!-- Custom styles for this template -->
      <link href="{{ asset('frontend/css/login-style.css') }}" rel="stylesheet">
      <link href="{{ asset('frontend/customcss/custom.css') }}" rel="stylesheet">
   </head>
   <body>
    <div class="main-contain">
        <section  class="auth-sidebar">
            <div class="auth-sidebar-content p-4">
               <div id="particles-js">
                  <header class="logo"><a href="{{ route('home') }}"><img src="{{ asset('frontend/img/logo/logo.png') }}"  alt="Logo"></a></header>
                  <div class="artwork">
                     <h2>Welcome Back</h2>
                     <h4>Good quality work at sensible prices</h4>
                  </div>
               </div>
            </div>
        </section>

        <section class="content">
            <header>
               <a href="{{ route('home') }}" class="float-right  link-color"><span class="bold m-1 ">Close</span> <i class="fa fa-times"></i></a>
            </header>

            <div class="auth-content">
                <div id="success-message-container" class="mt-5"></div>

                <div>
                    <div class='row mb-3'>
                        <div class='input-field col-md-12'>
                            <h2 class="heading1 mb-2 text-center color-blue">Thank you for registering a user account</h2>
                        </div>
                    </div>

                    {{-- @if(session()->has('message'))
                        <div class="alert alert-success mt-15">
                            {{ session()->get('message') }}
                        </div>
                    @endif --}}

                    <div class="row mb-2">
                        <p class="mail_confirmation">
                            We have sent an email to verify your email address.
                        </p>
                        <p class="mail_confirmation">
                            Please click on the link within the email to be able to accept estimates on our website.
                        </p>
                        <p class="mail_confirmation">
                            If you haven't received the email, we advise checking your Spam/Junk email folders before requesting to re-send the email below.
                        </p>
                    </div>

                    <div class="row">
                        <button type="button" id="verify_mail" class="btn btn-primary mt-5">Resend email</button>
                    </div>
                </div>
            </div>
            <p class="font-14px text-center mt-5">Copyright &copy; <?php echo date('Y') ?> Fix My Build Ltd. All Rights Reserved.</p>
        </section>
    </div>
      <!-- Bootstrap core JavaScript -->
      <script src="{{ asset('frontend/js/vendor/jquery-3.4.1.min.js') }}"></script>
      <script src="{{ asset('frontend/validatejs/jquery.validate.js') }}"></script>
      {{-- <script src="{{ asset('frontend/js/bootstrap.bundle.min.js') }}"></script>
      <script src="{{ asset('frontend/js/particles.js') }}"></script>
      <script src="{{ asset('frontend/js/app.js') }}"></script> --}}
      <script>
        $("#verify_mail").click(function(){
            $.ajax({
                url: "{{ route('verify-your-mail-send')}}",
                data: {'_token': "{{ csrf_token() }}"},
                method: 'POST',
                success: function(data){
                    // $("#success-message-container").appendTo("body").show();
                    let html = `
                    <div class="blue-font-color bg-white white_box px-0">
                        <div class="row justify-content-center">
                            <div class="col-md-1">
                                <span>
                                <img src="{{ asset('frontend/img/material-symbols.svg') }}" class="material_icon">
                                </span>
                            </div>
                            <div class="col-md-11">
                                <p class="before_approved_trader mb-0"><b>We have resent the email to your email address.</b></p>
                            </div>
                        </div>
                    </div>`;
                    $('#success-message-container').html(html);
                }
            });
        });
      </script>
   </body>
</html>
