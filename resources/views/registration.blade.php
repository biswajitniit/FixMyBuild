<!doctype html>
<html class="no-js" lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Sign Up</title>
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
            <header class="logo"><a href="index.html"><img src="{{ asset('frontend/img/logo/logo.png') }}"  alt="Logo"></a></header>
            <div class="artwork">
              <img src="{{ asset('frontend/img/log-reg-img.png') }}"  alt="">
               <h2>Welcome to</h2>
               <h4>Good quality work at sensible prices</h4>
               <p>Amet minim mollit non deserunt ullamco est sit aliqua dolor do amet sint. Velit officia consequat duis enim velit mollit. Exercitation veniam consequat </p>
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
                <input type="text" name="name" class="form-control" placeholder="Full Name" >
              </div>
            </div>

            <div class="form-group  col-md-12 mt-4">
                <input type="text" name="email" class="form-control" placeholder="Email" id="email" autocomplete="false" readonly onfocus="this.removeAttribute('readonly');" >
            </div>

            <div class="row">
              <div class="form-group col-md-12 mt-4 pw_">
                 <input type="password" name="password" class="form-control" placeholder="Password*">
                 <em><a href="#"><i class="fa fa-eye-slash"></i></a></em>
              </div>
           </div>
           <div class="row">
            <div class="form-group col-md-12 mt-4 pw_">
               <input type="password" name="password_confirmation" class="form-control"  placeholder="Confirm Password*">
               <em><a href="#"><i class="fa fa-eye"></i></a></em>
            </div>
         </div>


              <div class="form-group  col-md-12 mt-4">
                <input type="text" name="phone" class="form-control" placeholder="Phone">
              </div>
              <div class="form-check mt-4 pl-0 mb-2">
                <label class="form-check-label">Are you a customer or tradesperson?</label>
             </div>
             <div class="form-check-inline">
              <label class="form-check-label">
                <input type="radio" name="customer_or_tradesperson" value="Customer" class="form-check-input mr-2" checked name="optradio">Customer
              </label>
            </div>
            <div class="form-check-inline">
              <label class="form-check-label">
                <input type="radio" name="customer_or_tradesperson" value="Tradesperson" class="form-check-input mr-2" name="optradio">Tradesperson
              </label>
            </div>
              <div class="form-check mt-4">
                <label class="form-check-label">
                <input class="form-check-input" type="checkbox" name="terms_of_service" value="1"> I have read and agree to FixMyBuild’s <a href="#">Terms of Service</a>
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
      <p class="font-14px text-center mt-5">Copyright © 2022 FixMyBuild. All Rights Reserved.</p>
    </section>

  </div>
  <!-- Bootstrap core JavaScript -->
  <script src="{{ asset('frontend/js/vendor/jquery-3.4.1.min.js') }}"></script>
  <script src="{{ asset('frontend/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('frontend/js/particles.js') }}"></script>
  <script src="{{ asset('frontend/js/app.js') }}"></script>

</body>
</html>
