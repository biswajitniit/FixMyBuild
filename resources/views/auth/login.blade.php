<!doctype html>
<html class="no-js" lang="en">
   <head>
      <meta charset="utf-8">
      <meta http-equiv="x-ua-compatible" content="ie=edge">
      <title>Sign In</title>
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
                     <h2>Welcome Back</h2>
                     <h4>Good quality work at sensible prices</h4>
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
                        <h2 class="heading1 mb-2 text-center color-blue">Sign in</h2>
                        <p  class="heading2">
                           Not a member?
                           <span><a class="link-color" href="{{ url('user/registration') }}">Register Now</a></span>
                         </p>
                     </div>
                  </div>
                    @if (count($errors) > 0)
                        <div class="alert alert-danger">
                            <strong>Whoops! Something went wrong!</strong>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                  <form action="{{route('user.loginpost')}}" method="post" name="login">
                    @csrf
                     <div class="row">
                        <div class="form-group  col-md-12 mt-5">
                           <input type="email" name="email"  class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="John.abc@gmail.com" required >
                        </div>
                     </div>
                     <div class="row">
                        <div class="form-group col-md-12 mt-4 pw_">
                           <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Password*" required >
                           <em><a href="#"><i class="fa fa-eye-slash"></i></a></em>
                        </div>
                     </div>
                     <div class="form-check mt-3">
                        <label class="form-check-label">
                        <input class="form-check-input" type="checkbox" name="remember"> Remember me
                        </label>
                     </div>
                     <div class="row">
                        <div class="form-group col-md-12 mt-4 text-center forget_">
                           <button type="submit" class="btn btn-primary mb-3">Sign in</button>
                           <a href="forget-password.html">Forgot your password?</a>
                        </div>
                     </div>
                  </form>
                  <div class="row">
                    <div class="form-group col-md-12 mt-5 text-center sign_with">
                       <p>Or sign in with</p>
                       <ul>
                        <li><a href="#"><i class="fa fa-google"></i></a></li>
                        <li><a href="#"><svg width="31" height="32" viewBox="0 0 31 32" xmlns="http://www.w3.org/2000/svg">
                           <path d="M0.212402 4.06183V27.6025L18.1206 31.3574V0.595734L0.212402 4.06183ZM9.23465 21.3069C3.54169 20.9397 4.12803 10.6781 9.36755 10.5966C14.9805 10.9676 14.4299 21.225 9.23465 21.3069ZM9.31672 12.6058C6.31752 12.814 6.4518 19.2392 9.27046 19.2907C12.2567 19.0983 12.0814 12.6557 9.31672 12.6058ZM21.172 16.6981C21.4424 16.8968 21.7681 16.6981 21.7681 16.6981C21.4434 16.8968 30.6379 10.7896 30.6379 10.7896V21.8488C30.6379 23.0526 29.8673 23.5575 29.0007 23.5575H19.2517L19.2523 15.3798L21.172 16.6981ZM19.2528 7.11781V13.135L21.3556 14.459C21.411 14.4752 21.5312 14.4763 21.5867 14.459L30.6367 8.35747C30.6367 7.63541 29.9631 7.11781 29.583 7.11781H19.2528Z" fill="black"/>
                           </svg>
                           </a></li>
                        <li><a href="#"><i class="fa fa-apple"></i></a></li>
                       </ul>
                    </div>
                 </div>
               </div>
            </div>
            <p class="font-14px text-center mt-5">Copyright ?? 2022 FIX MY BUILD LTD. All Rights Reserved.</p>
         </section>
      </div>
      <!-- Bootstrap core JavaScript -->
      <script src="{{ asset('frontend/js/vendor/jquery-3.4.1.min.js') }}"></script>
      <script src="{{ asset('frontend/js/bootstrap.bundle.min.js') }}"></script>
      <script src="{{ asset('frontend/js/particles.js') }}"></script>
      <script src="{{ asset('frontend/js/app.js') }}"></script>
      <script>
        $( document ).ready(function() {
            $('input').attr('autocomplete','off');
        });
      </script>
   </body>
</html>
