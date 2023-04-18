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
    <link rel="stylesheet" href="https://cdn.tutorialjinni.com/intl-tel-input/17.0.8/css/intlTelInput.css"/>
    <link href="{{ asset('frontend/css/login-style.css') }}" rel="stylesheet">


    <style>
        #password-strength-status {
            padding: 5px 10px;
            border-radius: 4px;
            margin-top: 5px;
        }

        .medium-password {
            background-color: #fd0;
        }

        .weak-password {
            background-color: #FBE1E1;
        }

        .strong-password {
            background-color: #D5F9D5;
        }
    </style>
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

          <div class='row'>
            <div class='input-field col-md-12'>
              <h2 class="heading1 mb-2 text-center color-blue ">Create an Account </h2>
              <p  class="heading2">
                Already have an account?
                <span><a class="link-color" href="{{ url('login') }}">Sign in</a></span>
              </p>
            </div>
          </div>

            @if($errors->any())
                <div class="alert alert-danger mt-15">
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


            <form action="{{ route('user.save-user') }}" name="userregistration" class="contact-form" method="POST">
             @csrf

            <div class="row">
              <div class="form-group  col-md-12 mt-5">
                <input type="text" name="name" class="form-control" placeholder="Full Name" required >
              </div>
            </div>

            <div class="form-group  col-md-12 mt-4">
                <input type="email" name="email" class="form-control" placeholder="Email" id="email" autocomplete="false" readonly onfocus="this.removeAttribute('readonly');" required>
            </div>

            <div class="row">
              <div class="form-group col-md-12 mt-4 pw_">
                 <input type="password" name="password" id="password" class="form-control" placeholder="Password*" onkeyup="checkPasswordStrength();" required>
                 <em onclick="tooglepassword()"><a href="#"><i class="fa fa-eye-slash" id="eye"></i></a></em>
              </div>
           </div>
           <div id="password-strength-status"></div>
            <div class="row">
                <div class="form-group col-md-12 mt-4 pw_">
                <input type="password" name="password_confirmation" id="password_confirmation"  class="form-control"  placeholder="Confirm Password*" required>
                <em onclick="tooglepasswordconfirm()"><a href="#"><i class="fa fa-eye-slash" id="eyeconfirm"></i></a></em>
                </div>
            </div>
              <div class="form-group  col-md-12 mt-4">
                <input type="text" name="phone" class="form-control col-md-10" id="phone" placeholder="Phone" required>
             </div>

              <div class="form-check mt-4 pl-0 mb-2">
                <label class="form-check-label">Are you a customer or tradesperson?</label>
             </div>
             <div class="form-check-inline">
              <label class="form-check-label">
                <input type="radio" name="customer_or_tradesperson" value="Customer" class="form-check-input mr-2" checked name="optradio" required>Customer
              </label>
            </div>
            <div class="form-check-inline">
              <label class="form-check-label">
                <input type="radio" name="customer_or_tradesperson" value="Tradesperson" class="form-check-input mr-2" name="optradio" required>Tradesperson
              </label>
            </div>
              <div class="form-check mt-4">
                <label class="form-check-label">
                <input class="form-check-input" type="checkbox" name="terms_of_service" value="1" required> I have read and agree to FixMyBuild’s <a href="#">Terms of Service</a>
                and <a href="#">Privacy Policy</a>.
                </label>
             </div>
            <div class="row">
              <div class="form-group col-md-12 mt-4">
            <button type="submit" class="btn btn-primary">Register</button>
          </div>
        </div>

          </form>



        </div>
      </div>
      <p class="font-14px text-center mt-5">Copyright &copy; {{date('Y')}} FIX MY BUILD LTD. All Rights Reserved.</p>
    </section>

  </div>
  <!-- Bootstrap core JavaScript -->
  {{-- <script src="{{ asset('frontend/js/vendor/jquery-3.4.1.min.js') }}"></script>
  <script src="{{ asset('frontend/js/bootstrap.bundle.min.js') }}"></script> --}}
  {{-- <script src="{{ asset('frontend/js/particles.js') }}"></script>
  <script src="{{ asset('frontend/js/app.js') }}"></script> --}}

  <script src="https://cdn.tutorialjinni.com/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>
  <script>
     var input = document.querySelector("#phone");
     window.intlTelInput(input, {
         separateDialCode: true,
        //  excludeCountries: ["gb"],
         preferredCountries: ["gb"]
     });
  </script>
  <script type="text/javascript">
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

  </script>


</body>
</html>
