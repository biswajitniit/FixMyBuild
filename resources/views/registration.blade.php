<!doctype html>
<html class="no-js" lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>FixMyBuild | Sign Up</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('frontend/img/favicon.ico') }}">

     <!-- CSS ========================= -->
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
    <link rel="stylesheet" href="https://cdn.tutorialjinni.com/intl-tel-input/17.0.8/css/intlTelInput.css"/>
    <link href="{{ asset('frontend/css/login-style.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/customcss/custom.css') }}" rel="stylesheet">
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
                 <p>Amet minim mollit non deserunt ullamco est sit aliqua dolor do amet sint.<br> Velit officia consequat duis enim velit mollit. Exercitation veniam consequat </p>
              </div>
           </div>
        </div>
    </section>
    <section class="content">
      <header>
        <a href="{{ url('/') }}" class="float-right  link-color"><span class="bold m-1 ">Close</span> <i class="fa fa-times"></i></a>
     </header>
      <div class="auth-content">
        <div>

          <div class='row  mb-5'>
            <div class='input-field col-md-12'>
              <h2 class="heading1 mb-2 text-center color-blue ">Create an Account </h2>
              <p  class="heading2">
                Already have an account?
                <span><a class="link-color" href="{{ url('login') }}">Sign in</a></span>
              </p>
            </div>
          </div>

            @if($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if(session()->has('message'))
                <div class="alert alert-success mt-15">
                    {{ session()->get('message') }}
                </div>
            @endif

            <form action="{{ route('user.save-user') }}" name="userregistration" id="userregistration" class="contact-form" method="POST">
                @csrf

                <div class="row">
                    <div class="form-group col-md-12">
                        <input type="text" name="name" id="name" class="form-control" placeholder="Full Name"  required value="{{old('name')}}"/>
                    </div>
                </div>

                <div class="form-group col-md-12 mt-4">
                    <input type="email" name="email" id="email" class="form-control" placeholder="Email" id="email" value="{{old('email')}}" required pattern="[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{1,63}$"/>
                </div>

                <div class="row">
                    <div class="form-group col-md-12 mt-4 pw_">
                        <input type="password" name="password" id="password" class="form-control" placeholder="Password*" onkeyup="checkPasswordStrength();" onChange="Chkpassword_and_conpassword()" required />
                        <em onclick="tooglepassword()">
                            <a href="#"><i class="fa fa-eye-slash" id="eye"></i></a>
                        </em>
                    </div>
                </div>

                <div id="password-strength-status"></div>

                <div class="row">
                    <div class="form-group col-md-12 mt-4 pw_">
                        <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" placeholder="Confirm Password*"  onkeyup="checkPasswordStrength_confirm();" onChange="Chkpassword_and_conpassword()" required/>
                        <em onclick="tooglepasswordconfirm()">
                            <a href="#"><i class="fa fa-eye-slash" id="eyeconfirm"></i></a>
                        </em>
                    </div>
                </div>

                <div id="password-strength-status-confirm"></div>

                <div class="form-group col-md-12 mt-4">
                    <input type="text" name="phone" class="form-control col-md-10" id="phone" placeholder="Phone"  value="{{old('phone')}}" required/>
                </div>

                <div class="form-check mt-4 pl-0 mb-2">
                    <label class="form-check-label">Are you a customer or tradesperson?</label>
                </div>
                <div class="form-group col-md-12 mt-4">
                <div class="form-check-inline">
                    <label class="form-check-label"> <input type="radio" name="customer_or_tradesperson" value="Customer" class="form-check-input mr-2"   @if(old('customer_or_tradesperson') == 'Customer') checked @endif name="optradio"  required/>Customer </label>
                </div>

                <div class="form-check-inline">
                    <label class="form-check-label"> <input type="radio" name="customer_or_tradesperson" value="Tradesperson" class="form-check-input mr-2" @if(old('customer_or_tradesperson') == 'Tradesperson') checked @endif name="optradio"  required/>Tradesperson </label>
                </div>
                </div>
                <div class="form-check mt-4">
                    <label class="form-check-label">
                        <input class="form-check-input" type="checkbox" id="terms_of_service" name="terms_of_service" value="1" @if(old('terms_of_service') == 1) checked @endif onclick="checkBox()" required/> I have read and agree to FixMyBuild's

                        <a href="{{ url('/terms-of-service') }}">Terms of Service</a> and <a href="{{ url('/privacy-policy') }}">Privacy Policy</a>.
                    </label>
                </div>

                <div class="row">
                    <div class="form-group col-md-12 mt-4">
                        <button type="submit" id="register" class="btn btn-primary" disabled>Register</button>
                    </div>
                </div>

            </form>


          <div class="row">
            <div class="form-group col-md-12 mt-5 text-center sign_with">
               <p>Or register with</p>
               <ul>
                  <li><a href="{{ route('google-auth') }}"><i class="fa fa-google"></i></a></li>
                  <li>
                     <a href="#">
                        <svg width="31" height="32" viewBox="0 0 31 32" xmlns="http://www.w3.org/2000/svg">
                           <path d="M0.212402 4.06183V27.6025L18.1206 31.3574V0.595734L0.212402 4.06183ZM9.23465 21.3069C3.54169 20.9397 4.12803 10.6781 9.36755 10.5966C14.9805 10.9676 14.4299 21.225 9.23465 21.3069ZM9.31672 12.6058C6.31752 12.814 6.4518 19.2392 9.27046 19.2907C12.2567 19.0983 12.0814 12.6557 9.31672 12.6058ZM21.172 16.6981C21.4424 16.8968 21.7681 16.6981 21.7681 16.6981C21.4434 16.8968 30.6379 10.7896 30.6379 10.7896V21.8488C30.6379 23.0526 29.8673 23.5575 29.0007 23.5575H19.2517L19.2523 15.3798L21.172 16.6981ZM19.2528 7.11781V13.135L21.3556 14.459C21.411 14.4752 21.5312 14.4763 21.5867 14.459L30.6367 8.35747C30.6367 7.63541 29.9631 7.11781 29.583 7.11781H19.2528Z" fill="black"/>
                        </svg>
                     </a>
                  </li>
                  <li><a href="#"><i class="fa fa-apple"></i></a></li>
               </ul>
            </div>
         </div>


        </div>
      </div>
      <p class="font-14px text-center mt-5">Copyright &copy; {{date('Y')}} FIX MY BUILD LTD. All Rights Reserved.</p>
    </section>

  </div>
  <!-- Bootstrap core JavaScript -->

  <script src="{{ asset('frontend/js/jquery.min.js') }}"></script>
  <script src="https://cdn.tutorialjinni.com/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>
  <script src="{{ asset('frontend/validatejs/jquery.validate.js') }}"></script>
  <script>

    $(document).ready(function(){
        $("#userregistration").validate({
            // Specify validation rules
            rules: {
                name: {
                    required: true,
                },
                email: {
                    required: true,
                },
                password: {
                    required: true,
                },
                password_confirmation: {
                    required: true,
                },
                phone: {
                    required: true,
                },
                customer_or_tradesperson: {
                    required: true,
                }
            },
            messages: {
                name: {
                    required: "Please enter full name",
                },
                email: {
                    required: "Please enter email address",
                },
                password: {
                    required: "Please enter password",
                },
                password_confirmation: {
                    required: "Please confirm password",
                },
                phone: {
                    required: "Please enter phone number",
                },
                customer_or_tradesperson: {
                    required: "Are you a customer or tradeperson?",
                },
            },

        });
    });

    $(document).ready(function(){
        $("#fullname").bind("keypress", function (event) {
            if (event.charCode!=0) {
                var regex = new RegExp("^[a-zA-Z ]+$");
                var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
                if (!regex.test(key)) {
                    event.preventDefault();
                    return false;
                }
            }
        });
    });

    function Chkpassword_and_conpassword() {
        const password = document.querySelector('input[name=password]');
        const confirm = document.querySelector('input[name=password_confirmation]');
        if (confirm.value === password.value) {
            confirm.setCustomValidity('');
        } else {
            confirm.setCustomValidity('Passwords do not match');
        }
    }



     var input = document.querySelector("#phone");
     window.intlTelInput(input, {
         separateDialCode: true,
         preferredCountries: ["gb"]
     });

    // $(document).ready(function(){
    //     $("#userregistration").validationEngine();
    // });

    function tooglepassword(){
        var x = document.getElementById("password");
        if (x.type === "password") {
            x.type = "text";
            $("#eye").removeClass("fa fa-eye-slash");
            $("#eye").addClass("fa fa-eye");
        } else {
            x.type = "password";
            $("#eye").removeClass("fa fa-eye");
            $("#eye").addClass("fa fa-eye-slash");
        }
    }
    function tooglepasswordconfirm(){
        var x = document.getElementById("password_confirmation");
        if (x.type === "password") {
            x.type = "text";
            $("#eyeconfirm").removeClass("fa fa-eye-slash");
            $("#eyeconfirm").addClass("fa fa-eye");
        } else {
            x.type = "password";
            $("#eyeconfirm").removeClass("fa fa-eye");
            $("#eyeconfirm").addClass("fa fa-eye-slash");
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

    function checkPasswordStrength_confirm() {
        var number = /([0-9])/;
        var alphabets = /([a-zA-Z])/;
        var special_characters = /([~,!,@,#,$,%,^,&,*,-,_,+,=,?,>,<])/;
        var password = $('#password_confirmation').val().trim();
        if(password.length<6) {
            $('#password-strength-status-confirm').removeClass();
            $('#password-strength-status-confirm').addClass('weak-password');
            $('#password-strength-status-confirm').html("Weak (should be atleast 6 characters.)");
        } else {
            if(password.match(number) && password.match(alphabets) && password.match(special_characters)) {
                $('#password-strength-status-confirm').removeClass();
                $('#password-strength-status-confirm').addClass('strong-password');
                $('#password-strength-status-confirm').html("Strong");
            }
            else {
                $('#password-strength-status-confirm').removeClass();
                $('#password-strength-status-confirm').addClass('medium-password');
                $('#password-strength-status-confirm').html("Medium (should include alphabets, numbers and special characters.)");
            }
        }
    }

    function checkBox() {
            const checkbox = document.getElementById("terms_of_service");
            const button  = document.getElementById("register");
            if (checkbox.checked == false) {
                button.disabled = true;
            }
            else{
                  button.disabled = false;
            }
    }
  </script>

</body>
</html>
