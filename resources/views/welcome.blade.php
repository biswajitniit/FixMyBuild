<!doctype html>
<html class="no-js" lang="en">
   <head>
      <meta charset="utf-8">
      <meta http-equiv="x-ua-compatible" content="ie=edge">
      <title>FixMyBuild</title>
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
      <!--modernizr min js here-->
      <script src="{{ asset('frontend/js/vendor/modernizr-3.7.1.min.js') }}"></script>
   </head>
   <body>
      <!-- Main Wrapper Start -->
      <!--header area start-->
      <header class="header_area header_padding">
         <!--header middel start-->
         <div class="header_middle sticky-header">
            <div class="container-fluid pr-12">
               <div class="row align-items-center">
                  <div class="col-xl-4 col-lg-4 col-md-4">
                     <div class="middel_right">
                        <div class="middel_right_info">
                           <div class="header_wishlist">
                              <a href="about-us.html">About us</a>
                           </div>
                           <div class="header_sign_up">
                              <a href="contact-us.html">Contact us</a>
                           </div>
                           <div class="header_wishlist d-md-block d-lg-none">
                              <a href="{{ url('login') }}"><i class="fa fa-user"></i> Login</a>
                           </div>
                           <div class="header_sign_up d-md-block d-lg-none">
                              <a href="{{ url('user/registration') }}">Register</a>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="col-xl-4 col-lg-4 col-md-4 text-center">
                     <div class="logo">
                        <a href="index.html"><img src="{{ asset('frontend/img/logo/logo.png') }}" alt=""></a>
                     </div>
                  </div>
                  <div class="col-xl-4 col-lg-4 col-md-4 d-none d-lg-block">
                     <div class="middel_right">
                        <div class="middel_right_info">
                           <div class="header_wishlist">
                              <a href="{{ url('login') }}"><i class="fa fa-user"></i> Login</a>
                           </div>
                           <div class="reg_">
                              <a href="{{ url('user/registration') }}">Register</a>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <!--header middel end-->
      </header>
      <!--header area end-->
      <!--Banner area start-->
      <section class="banner-inner">
         <div class="container">
            <div class="row">
               <div class="col-md-6 col-sm-12 position-relative order-2 order-xl-1 order-lg-1 order-md-1 order-sm-2">
                  <div class="pt-lg-5 pt-sm-1 pb-4 text-middel h-100">
                     <h2 class="pt-md-3 pt-sm-1 font-64 font-weight-bold">Good quality work at sensible prices</h2>
                     <p>118 reputable builders registered on our platform so far.</p>
                     <div class="price-display mt-4">
                        <a class="btn mr-3" href="#">Start your project</a>
                        <a class="btn mr-3 cy-project" href="#">Continue your project</a>
                     </div>
                  </div>
               </div>
               <div class="col-md-6 col-sm-12 text-center order-1 order-xl-2 order-lg-2 order-md-2 order-sm-1">
                  <div class="img">
                     <img src="{{ asset('frontend/img/banner-img.png') }}" alt="" class="img-fluid">
                  </div>
               </div>
            </div>
         </div>
      </section>
      <!--THIS COURSE INCLUDES area end-->
      <!--footer area start-->
      <footer class="footer_widgets">
         <div class="container">
            <div class="footer_bottom">
               <div class="row copyright_area">
                  <div class="col-lg-6 col-md-6">
                     <ul>
                        <li><a href="#">Privacy Policy</a></li>
                        <li><a href="#">Terms</a></li>
                     </ul>
                  </div>
                  <div class="col-lg-6 col-md-6">
                     <p>Copyright © 2022 FixMyBuild. All Rights Reserved.</p>
                  </div>
               </div>
            </div>
         </div>
      </footer>
      <!--footer area end-->
      <!-- <script></script> -->
      <!-- JS
         ============================================ -->
      <!--jquery min js-->
      <script src="{{ asset('frontend/js/vendor/jquery-3.4.1.min.js') }}"></script>
      <!--bootstrap min js-->
      <script src="{{ asset('frontend/js/bootstrap.min.js') }}"></script>
      <!--owl carousel min js-->
      <script src="{{ asset('frontend/js/owl.carousel.min.js') }}"></script>
      <!--slick min js-->
      <script src="{{ asset('frontend/js/slick.min.js') }}"></script>
      <!--magnific popup min js-->
      <script src="{{ asset('frontend/js/jquery.magnific-popup.min.js') }}"></script>
      <!--jquery countdown min js-->
      <script src="{{ asset('frontend/js/jquery.countdown.js') }}"></script>
      <!--jquery ui min js-->
      <script src="{{ asset('frontend/js/jquery.ui.js') }}"></script>
      <!--jquery elevatezoom min js-->
      <script src="{{ asset('frontend/js/jquery.elevatezoom.js') }}"></script>
      <!--isotope packaged min js-->
      <script src="{{ asset('frontend/js/isotope.pkgd.min.js') }}"></script>
      <!-- Plugins JS -->
      <script src="{{ asset('frontend/js/plugins.js') }}"></script>
      <!-- Main JS -->
      <script src="{{ asset('frontend/js/main.js') }}"></script>
   </body>
</html>
