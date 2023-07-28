<!doctype html>
<html class="no-js" lang="en">
   <head>
      <meta charset="utf-8">
      <meta http-equiv="x-ua-compatible" content="ie=edge">
      <title>Set New Password</title>
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


   </head>
   <body>
      <div class="main-contain">
         <section  class="auth-sidebar">
            <div class="auth-sidebar-content p-4">
               <div id="particles-js">
                  <header class="logo"><a href="{{ url('/') }}"><img src="{{ asset('frontend/img/logo/logo.png') }}"  alt="Logo"></a></header>
                  <div class="artwork">
                     <h2>Welcome Back</h2>
                     <h4>Good quality work at sensible prices</h4>
                  </div>
               </div>
            </div>
         </section>
         <section class="content">
            <header>
               <a href="{{ url('/send-otp') }}" class="float-right  link-color"><span class="bold m-1 ">Close</span> <i class="fa fa-times"></i></a>
            </header>
            <div class="auth-content">
               <div>
                  <div class='row' id="message">
                     <div class='input-field col-md-12'>
                        <h2 class="heading1 mb-2 text-left color-blue">Set New password</h2>
                        <p  class="heading3 text-left">
                            <strong>Instruction:</strong>
                        </p>
                        <h6 id="pswd_length" class="invalid"> 8-32 character</h6>
                        <h6 id="pswd_uppercase" class="invalid"> One upper case</h6>
                        <h6 id="pswd_lowercase" class="invalid"> One lower case</h6>
                        <h6 id="pswd_special" class="invalid"> One special character</h6>
                        <h6 id="pswd_digit" class="invalid"> One numeric character</h6>
                     </div>
                  </div>
                  <form action="{{ route('reset.password-mobile-otp') }}" method="post" id="changePasswordForm">
                    @csrf
                    <input type="hidden" value="{{ $user_id }}" name='id'>
                    <div class="row">
                        <div class="form-group col-md-12 mt-4 pw_">
                            <input type="password" class="form-control" id="pswd" placeholder="Password" name="Password1">
                            {{-- <em onclick="tooglepassword1()">
                                <a href="#"><i class="fa fa-eye-slash" id="eye"></i></a>
                            </em> --}}
                            <em onclick="tooglepassword1($(this))">
                                <a href="#">
                                    <img class="eye-slash-icon" src="{{ asset('frontend/img/hide_password.svg') }}" alt="" >
                                    <img class="eye-icon d-none" src="{{ asset('frontend/img/show_password.svg') }}" alt="">
                                </a>
                            </em>
                        </div>
                     </div>
                     <div class="row">
                        <div class="form-group col-md-12 mt-4 pw_">
                            <input type="password" class="form-control" id="pswd2" placeholder="Retype password" name="Password2">
                            {{-- <em onclick="tooglepassword2()">
                                <a href="#"><i class="fa fa-eye-slash" id="eye1"></i></a>
                            </em> --}}
                            <em onclick="tooglepassword2($(this))">
                                <a href="#">
                                    <img class="eye-slash-icon" src="{{ asset('frontend/img/hide_password.svg') }}" alt="" >
                                    <img class="eye-icon d-none" src="{{ asset('frontend/img/show_password.svg') }}" alt="">
                                </a>
                            </em>
                        </div>
                     </div>

                     <div class="row">
                        <div class="form-group col-md-12 mt-4 text-center forget_">
                           <button type="submit" id="submit" class="btn btn-primary mb-3" disabled>Continue</button>
                        </div>
                     </div>
                  </form>

               </div>
            </div>
            <p class="font-14px text-center mt-5">Copyright © 2022 Fix My Build Ltd. All Rights Reserved.</p>
         </section>
      </div>
      <!-- Bootstrap core JavaScript -->
        <script src="{{ asset('frontend/js/jquery.min.js') }}"></script>
      <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
      <script src="assets/js/particles.js"></script>
      <script src="assets/js/app.js"></script>
      <script>

        $("input[id=pswd]").keyup(function(){
            password_validation();
        });
        $("input[id=pswd2]").keyup(function(){
            password_validation();
        });
      // for password validation
    function password_validation(){
            let password = 'input[id=pswd]';
            let conf_password = 'input[id=pswd2]';
            let pswd = $(password).val().trim();
            let c_pswd = $(conf_password).val().trim();
            let invalid = '<i class="fa fa-times" style="color:red;"></i>';
            let valid = '<i class="fa fa-check" style="color:green;"></i>';
            let is_valid = true;

            $(password).val(pswd);
            $(conf_password).val(c_pswd);

            // Validate Password Length
            if (pswd.length >= 8 && pswd.length <= 32) {
                $('#pswd_length i').remove();
                $('#pswd_length').prepend(valid);
            } else {
                $('#pswd_length i').remove();
                $('#pswd_length').prepend(invalid);
                is_valid = false;
            }

            // Validate Uppercase
            if ( pswd.match(/[A-Z]/) ) {
                $('#pswd_uppercase i').remove();
                $('#pswd_uppercase').prepend(valid);
            } else {
                $('#pswd_uppercase i').remove();
                $('#pswd_uppercase').prepend(invalid);
                is_valid = false;
            }

            // Validate Lowercase
            if(pswd.match(/[a-z]/)){
                $('#pswd_lowercase i').remove();
                $('#pswd_lowercase').prepend(valid);
            }else{
                $('#pswd_lowercase i').remove();
                $('#pswd_lowercase').prepend(invalid);
                is_valid = false;
            }

            // Validate Special Characters
            if(pswd.match(/([~,!,@,#,$,%,^,&,*,-,_,+,=,?,>,<])/)){
                $('#pswd_special i').remove();
                $('#pswd_special').prepend(valid);
            }else{
                $('#pswd_special i').remove();
                $('#pswd_special').prepend(invalid);
                is_valid = false;
            }

            // Validate Numbers
            if(pswd.match(/[0-9]/)){
                $('#pswd_digit i').remove();
                $('#pswd_digit').prepend(valid);
            }else{
                $('#pswd_digit i').remove();
                $('#pswd_digit').prepend(invalid);
                is_valid = false;
            }

            // Check if confirm password matches with new password
            if(c_pswd !== pswd){
                is_valid = false;
            }

            if(is_valid){
                $('#submit').attr('disabled', false);
            }else{
                $('#submit').prop('disabled', true);
            }
    }


    //   To see password
        //    function tooglepassword1(){
        //     var x = document.getElementById("pswd");
        //     if (x.type === "password") {
        //         x.type = "text";
        //         $("#eye").removeClass("fa fa-eye-slash");
        //         $("#eye").addClass("fa fa-eye");
        //     } else {
        //         x.type = "password";
        //         $("#eye").removeClass("fa fa-eye");
        //         $("#eye").addClass("fa fa-eye-slash");
        //     }
        // }

        // function tooglepassword2(){
        //     var x = document.getElementById("pswd2");
        //     if (x.type === "password") {
        //         x.type = "text";
        //         $("#eye1").removeClass("fa fa-eye-slash");
        //         $("#eye1").addClass("fa fa-eye");
        //     } else {
        //         x.type = "password";
        //         $("#eye1").removeClass("fa fa-eye");
        //         $("#eye1").addClass("fa fa-eye-slash");
        //     }
        // }

        function tooglepassword1(element){
            var x = document.getElementById("pswd");
            if (x.type === "password") {
                x.type = "text";
                $(element).find('.eye-icon').removeClass('d-none');
                $(element).find('.eye-slash-icon').addClass('d-none');
            } else {
                x.type = "password";
                $(element).find('.eye-icon').addClass('d-none');
                $(element).find('.eye-slash-icon').removeClass('d-none');
            }
        }

        function tooglepassword2(element){
            var x = document.getElementById("pswd2");
            if (x.type === "password") {
                x.type = "text";
                $(element).find('.eye-icon').removeClass('d-none');
                $(element).find('.eye-slash-icon').addClass('d-none');
            } else {
                x.type = "password";
                $(element).find('.eye-icon').addClass('d-none');
                $(element).find('.eye-slash-icon').removeClass('d-none');
            }
        }
      </script>
   </body>
</html>
