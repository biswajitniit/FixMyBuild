<!doctype html>
<html class="no-js" lang="en">
   <head>
      <meta charset="utf-8">
      <meta http-equiv="x-ua-compatible" content="ie=edge">
      <title>FixMyBuild | Set new password</title>
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
      {{-- <link rel="stylesheet" href="{{ asset('frontend/css/magnific-popup.css') }}"> --}}
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
               <a href="{{url('/')}}" class="float-right  link-color"><span class="bold m-1 ">Close</span> <i class="fa fa-times"></i></a>
            </header>
            <div class="auth-content">
               <div>
                <div class="row">
                    <div class="input-field col-md-12">
                        <h2 class="heading1 mb-2 text-left color-blue">Set New password</h2>
                        <p class="heading3 text-left">
                            <strong>Instruction:</strong>
                        </p>
                        <h6 id="pswd_length"><i class="fa fa-times text-danger"></i> 8-32 character</h6>
                        <h6 id="pswd_uppercase"><i class="fa fa-times text-danger"></i> One upper case</h6>
                        <h6 id="pswd_lowercase"><i class="fa fa-times text-danger"></i> One lower case</h6>
                        <h6 id="pswd_special"><i class="fa fa-times text-danger"></i> One special character</h6>
                        <h6 id="pswd_digit" class="mb-0"><i class="fa fa-times text-danger"></i> One numeric character</h6>
                    </div>
                </div>

                @if (Session::has('error'))
                        <div class="alert alert-danger" role="alert">
                        {{ Session::get('error') }}
                    </div>
                @endif

                <form action="{{ route('reset.password.post') }}" method="post" id="resetpswd">
                    @csrf
                    <input type="hidden" name="token" value="{{ $token }}">

                    <div class="row">
                        <div class="form-group col-md-12 mt-4 pw_">
                            <input type="text" id="email_address" class="form-control" name="email" placeholder="Email" required autofocus pattern="[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{1,63}$">
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-12 mt-4 pw_">
                            <input type="password" id="password" class="form-control" name="password" placeholder="Password" required>
                            <em onclick="tooglepassword($(this))">
                                <a href="#">
                                    {{-- <i class="fa fa-eye-slash" id="eye"></i> --}}
                                    <img class="eye-slash-icon" src="{{ asset('frontend/img/hide_password.svg') }}" alt="" >
                                    <img class="eye-icon d-none" src="{{ asset('frontend/img/show_password.svg') }}" alt="">
                                </a>
                            </em>
                        </div>
                    </div>

                    <div id="password-strength-status"></div>

                    <div class="row">
                        <div class="form-group col-md-12 mt-4 pw_">
                            <input type="password" id="password_confirmation" class="form-control" name="password_confirmation" placeholder="Retype password" required autofocus onkeyup="checkPasswordStrength_One();" onChange="Chkpassword_and_conpassword()">
                            <em onclick="tooglepasswordconfirm($(this))">
                                <a href="#">
                                    {{-- <i class="fa fa-eye-slash" id="eyeconfirm"></i> --}}
                                    <img class="eye-slash-icon" src="{{ asset('frontend/img/hide_password.svg') }}" alt="" >
                                    <img class="eye-icon d-none" src="{{ asset('frontend/img/show_password.svg') }}" alt="">
                                </a>
                            </em>
                        </div>
                    </div>
                    <div id="password-strength-status-one"></div>

                    <div class="row">
                        <div class="form-group col-md-12 mt-4 text-center forget_">
                            <button type="submit" class="btn btn-primary mb-3">Continue</button>
                        </div>
                    </div>

                </form>

               </div>
            </div>
            <p class="font-14px text-center mt-5">Copyright &copy; {{ date('Y' )}} Fix My Build Ltd. All Rights Reserved.</p>
         </section>
      </div>
      <!-- Bootstrap core JavaScript -->
      <script src="{{ asset('frontend/js/vendor/jquery-3.4.1.min.js') }}"></script>
      <script src="{{ asset('frontend/validatejs/jquery.validate.js') }}"></script>
      {{-- <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
      <script src="assets/js/particles.js"></script>
      <script src="assets/js/app.js"></script> --}}


      <script>
        // var input = document.querySelector("#phone");
        // window.intlTelInput(input, {
        //     separateDialCode: true,
        //     preferredCountries: ["gb"]
        // });

       // $(document).ready(function(){
       //     $("#userregistration").validationEngine();
       // });


       function Chkpassword_and_conpassword() {
            const password = document.querySelector('input[name=password]');
            const confirm = document.querySelector('input[name=password_confirmation]');
            if (confirm.value === password.value) {
                confirm.setCustomValidity('');
            } else {
                confirm.setCustomValidity('Passwords do not match');
            }
        }


    //    function tooglepassword(){
    //        var x = document.getElementById("password");
    //        if (x.type === "password") {
    //            x.type = "text";
    //            $("#eye").removeClass("fa fa-eye-slash");
    //            $("#eye").addClass("fa fa-eye");
    //        } else {
    //            x.type = "password";
    //            $("#eye").removeClass("fa fa-eye");
    //            $("#eye").addClass("fa fa-eye-slash");
    //        }
    //    }
        function tooglepassword(element){
            var x = document.getElementById("password");
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
    //    function tooglepasswordconfirm(){
    //        var x = document.getElementById("password_confirmation");
    //        if (x.type === "password") {
    //            x.type = "text";
    //            $("#eyeconfirm").removeClass("fa fa-eye-slash");
    //            $("#eyeconfirm").addClass("fa fa-eye");
    //        } else {
    //            x.type = "password";
    //            $("#eyeconfirm").removeClass("fa fa-eye");
    //            $("#eyeconfirm").addClass("fa fa-eye-slash");
    //        }
    //    }
        function tooglepasswordconfirm(element){
            var x = document.getElementById("password_confirmation");
            if (x.type === "password") {
                x.type = "text";
                // $("#eyeconfirm").removeClass("fa fa-eye-slash");
                // $("#eyeconfirm").addClass("fa fa-eye");
                $(element).find('.eye-icon').removeClass('d-none');
                $(element).find('.eye-slash-icon').addClass('d-none');
            } else {
                x.type = "password";
                // $("#eyeconfirm").removeClass("fa fa-eye");
                // $("#eyeconfirm").addClass("fa fa-eye-slash");
                $(element).find('.eye-icon').addClass('d-none');
                $(element).find('.eye-slash-icon').removeClass('d-none');
            }
        }

       function checkPasswordStrength() {
           var number = /([0-9])/;
           var alphabets = /([a-zA-Z])/;
           var special_characters = /([~,!,@,#,$,%,^,&,*,-,_,+,=,?,>,<])/;
           var password = $('#password').val().trim();
           if(password.length<6) {
               $('#password-strength-status').removeClass();
               $('#password-strength-status').addClass('weak-password');
               $('#password-strength-status').html("Weak (should be atleast 6 characters.)");
           } else {
               if(password.match(number) && password.match(alphabets) && password.match(special_characters)) {
                   $('#password-strength-status').removeClass();
                   $('#password-strength-status').addClass('strong-password');
                   $('#password-strength-status').html("Strong");
               }
               else {
                   $('#password-strength-status').removeClass();
                   $('#password-strength-status').addClass('medium-password');
                   $('#password-strength-status').html("Medium (should include alphabets, numbers and special characters.)");
               }
           }
       }

    //    function checkPasswordStrength_One(){
    //     var number = /([0-9])/;
    //        var alphabets = /([a-zA-Z])/;
    //        var special_characters = /([~,!,@,#,$,%,^,&,*,-,_,+,=,?,>,<])/;
    //        var password = $('#password_confirmation').val().trim();
    //        if(password.length<6) {
    //            $('#password-strength-status-one').removeClass();
    //            $('#password-strength-status-one').addClass('weak-password');
    //            $('#password-strength-status-one').html("Weak (should be atleast 6 characters.)");
    //        } else {
    //            if(password.match(number) && password.match(alphabets) && password.match(special_characters)) {
    //                $('#password-strength-status-one').removeClass();
    //                $('#password-strength-status-one').addClass('strong-password');
    //                $('#password-strength-status-one').html("Strong");
    //            }
    //            else {
    //                $('#password-strength-status-one').removeClass();
    //                $('#password-strength-status-one').addClass('medium-password');
    //                $('#password-strength-status-one').html("Medium (should include alphabets, numbers and special characters.)");
    //            }
    //        }
    //    }

        $('#password, #password_confirmation').on('input blur', function(){
            password_validation();
        });

        function password_validation(){
            let password = 'input[id=password]';
            let confirm_password = 'input[id=password_confirmation]';
            let pswd = $(password).val().trim();
            let confirm_pswd = $(confirm_password).val().trim();
            let invalid = '<i class="fa fa-times text-danger"></i>';
            let valid = '<i class="fa fa-check text-success"></i>';
            let is_valid = true;

            $(password).val(pswd);
            $(confirm_password).val(confirm_pswd);

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
            if(confirm_pswd !== pswd){
                is_valid = false;
            }

            return is_valid;
        }

        $(document).ready(function(){
            $("#resetpswd").validate({
                // Specify validation rules
                rules: {
                    email: {
                        required: true,
                    },
                    password: {
                        required: true,
                        rangelength: [8, 32],
                        includeUpperCase: true,
                        includeLowerCase: true,
                        includeSpecialCharacter: true,
                        includeDigit: true
                    },
                    password_confirmation: {
                        required: true,
                        equalTo: '#password'
                    }
                },
                messages: {
                    email: {
                        required: "Please enter your email address",
                    },
                    password: {
                        required: "Please enter your password",
                    },
                    password_confirmation: {
                        required: "Please re-enter your password for confirmation",
                    }
                }
            });
        });
    </script>

   </body>
</html>
