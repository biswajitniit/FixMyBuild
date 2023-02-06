<!doctype html>
<html class="no-js" lang="en">
   <head>
      <meta charset="utf-8">
      <meta http-equiv="x-ua-compatible" content="ie=edge">
      <title>FixMyBuild</title>
      <meta name="description" content="">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta name="csrf-token" content="{{ csrf_token() }}">
      <!-- Favicon -->
      <!-- <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.ico"> -->
      <!-- CSS
         ========================= -->
      <!--bootstrap min css-->
      <link rel="stylesheet" href="{{ asset('frontend/css/bootstrap.min.css') }}">
      <!--owl carousel min css-->
      <link rel="stylesheet" href="{{ asset('frontend/css/owl.carousel.min.css') }}">
      <!--slick min css-->
      <link rel="stylesheet" href="{{ asset('frontend/css/slick.css') }}">
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
      <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">

      <!--modernizr min js here-->
      <script src="{{ asset('frontend/js/vendor/modernizr-3.7.1.min.js') }}"></script>

   </head>
   <body class="inner_body">
      <!-- Main Wrapper Start -->
      <!--header area start-->
      <header class="header_area header_padding">
         <!--header middel start-->
         <div class="header_middle">
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
                              @if (Auth::check())
                              <a href="#" class="alert">
                                 <svg width="27" height="29" viewBox="0 0 27 29" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M17.8749 25.7083C17.8751 26.4442 17.5972 27.1529 17.0969 27.6925C16.5965 28.232 15.9108 28.5625 15.177 28.6177L14.9582 28.625H12.0416C11.3057 28.6252 10.597 28.3473 10.0574 27.847C9.51788 27.3466 9.18738 26.6608 9.13219 25.9271L9.1249 25.7083H17.8749ZM13.4999 0.916656C16.1467 0.916613 18.6901 1.94463 20.5936 3.78385C22.497 5.62307 23.6117 8.1297 23.7024 10.775L23.7082 11.125V16.6142L26.3653 21.9283C26.4813 22.1602 26.5393 22.4167 26.5345 22.6759C26.5296 22.9351 26.462 23.1893 26.3374 23.4167C26.2128 23.644 26.035 23.8378 25.8191 23.9814C25.6033 24.125 25.3559 24.2142 25.098 24.2412L24.9303 24.25H2.06948C1.81014 24.2501 1.55464 24.1873 1.32489 24.067C1.09514 23.9467 0.897974 23.7724 0.750301 23.5593C0.602628 23.3461 0.508845 23.1002 0.476991 22.8429C0.445136 22.5855 0.476159 22.3242 0.567401 22.0814L0.634485 21.9283L3.29157 16.6142V11.125C3.29157 8.41757 4.36709 5.82104 6.28152 3.90661C8.19595 1.99217 10.7925 0.916656 13.4999 0.916656ZM13.4999 3.83332C11.6209 3.83343 9.81446 4.5589 8.45731 5.85845C7.10016 7.158 6.29708 8.93129 6.21553 10.8085L6.20823 11.125V16.6142C6.20825 16.9758 6.141 17.3344 6.0099 17.6714L5.90053 17.9194L4.19428 21.3333H22.807L21.1007 17.9179C20.9389 17.5946 20.8385 17.244 20.8047 16.8839L20.7916 16.6142V11.125C20.7916 9.19112 20.0233 7.33646 18.6559 5.969C17.2884 4.60155 15.4338 3.83332 13.4999 3.83332Z" fill="#061A48"/>
                                 </svg>
                                 <div class="badge">10</div>
                              </a>
                              @else
                              <a href="{{ route('login') }}"><i class="fa fa-user"></i> Login</a>
                              @endif
                           </div>
                           <div class="header_sign_up d-md-block d-lg-none">
                                @if (Auth::check())
                                    <div class="dropdown">
                                        <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown">
                                        <img src="{{ asset('frontend/img/user_.png') }}" alt="">
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-right">
                                            <li><a class="dropdown-item" href="#">Jenny Wilson<em>Customer</em></a></li>
                                            <li>
                                            <hr class="dropdown-divider">
                                            </hr>
                                            </li>
                                            <li><a class="dropdown-item" href="#">My profile</a></li>
                                            <li><a class="dropdown-item" href="{{ route('customer.newproject') }}">New project</a></li>
                                            <li><a class="dropdown-item" href="{{ route('logout') }}">Logout</a></li>
                                        </ul>
                                    </div>
                              @else
                                    <a href="{{ route('user.registration') }}">Register</a>
                              @endif
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="col-xl-4 col-lg-4 col-md-4 text-center">
                     <div class="logo">
                        <a href="{{ url('/') }}"><img src="{{ asset('frontend/img/logo/logo.png') }}" alt=""></a>
                     </div>
                  </div>
                  <div class="col-xl-4 col-lg-4 col-md-4 d-none d-lg-block">
                     <div class="middel_right">
                        <div class="middel_right_info">
                            <div class="header_wishlist">
                              @if (Auth::check())
                                <a href="#" class="alert">
                                    <svg width="27" height="29" viewBox="0 0 27 29" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M17.8749 25.7083C17.8751 26.4442 17.5972 27.1529 17.0969 27.6925C16.5965 28.232 15.9108 28.5625 15.177 28.6177L14.9582 28.625H12.0416C11.3057 28.6252 10.597 28.3473 10.0574 27.847C9.51788 27.3466 9.18738 26.6608 9.13219 25.9271L9.1249 25.7083H17.8749ZM13.4999 0.916656C16.1467 0.916613 18.6901 1.94463 20.5936 3.78385C22.497 5.62307 23.6117 8.1297 23.7024 10.775L23.7082 11.125V16.6142L26.3653 21.9283C26.4813 22.1602 26.5393 22.4167 26.5345 22.6759C26.5296 22.9351 26.462 23.1893 26.3374 23.4167C26.2128 23.644 26.035 23.8378 25.8191 23.9814C25.6033 24.125 25.3559 24.2142 25.098 24.2412L24.9303 24.25H2.06948C1.81014 24.2501 1.55464 24.1873 1.32489 24.067C1.09514 23.9467 0.897974 23.7724 0.750301 23.5593C0.602628 23.3461 0.508845 23.1002 0.476991 22.8429C0.445136 22.5855 0.476159 22.3242 0.567401 22.0814L0.634485 21.9283L3.29157 16.6142V11.125C3.29157 8.41757 4.36709 5.82104 6.28152 3.90661C8.19595 1.99217 10.7925 0.916656 13.4999 0.916656ZM13.4999 3.83332C11.6209 3.83343 9.81446 4.5589 8.45731 5.85845C7.10016 7.158 6.29708 8.93129 6.21553 10.8085L6.20823 11.125V16.6142C6.20825 16.9758 6.141 17.3344 6.0099 17.6714L5.90053 17.9194L4.19428 21.3333H22.807L21.1007 17.9179C20.9389 17.5946 20.8385 17.244 20.8047 16.8839L20.7916 16.6142V11.125C20.7916 9.19112 20.0233 7.33646 18.6559 5.969C17.2884 4.60155 15.4338 3.83332 13.4999 3.83332Z" fill="#061A48"/>
                                    </svg>
                                    <div class="badge">10</div>
                                </a>
                              @else
                                <a href="{{ route('login') }}"><i class="fa fa-user"></i> Login</a>
                              @endif
                           </div>
                           <div class="reg_">
                                @if (Auth::check())
                                    <div class="dropdown">
                                        <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown">
                                        <img src="{{ asset('frontend/img/user_.png') }}" alt="">
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-right">
                                            <li><a class="dropdown-item" href="#">{{ Auth::user()->name }}<em>{{ Auth::user()->customer_or_tradesperson }}</em></a></li>
                                            <li>
                                            <hr class="dropdown-divider">
                                            </hr>
                                            </li>
                                            <li><a class="dropdown-item" href="#">My profile</a></li>
                                            <li><a class="dropdown-item" href="{{ route('customer.newproject') }}">New project</a></li>
                                            <li><a class="dropdown-item" href="{{ route('logout') }}">Logout</a></li>
                                        </ul>
                                    </div>
                                @else
                                    <a href="{{ route('user.registration') }}">Register</a>
                                @endif
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

      @yield('content')

        <!--footer area start-->
        <footer class="footer_widgets">
            <div class="container">
                <div class="footer_bottom">
                    <div class="row copyright_area">
                        <div class="col-lg-6 col-md-6">
                        <ul>
                            <li><a href="#">Privacy policy</a></li>
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
        <!--popper min js-->
        <script src="{{ asset('frontend/js/popper.js') }}"></script>
        <!--bootstrap min js-->
        <script src="{{ asset('frontend/js/bootstrap.min.js') }}"></script>
        <!--bootstrap bundle js-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
        <!--owl carousel min js-->
        <script src="{{ asset('frontend/js/owl.carousel.min.js') }}"></script>
        <!--slick min js-->
        <script src="{{ asset('frontend/js/slick.min.js') }}"></script>
        <!--jquery ui min js-->
        <script src="{{ asset('frontend/js/jquery.ui.js') }}"></script>
        <!-- Plugins JS -->
        <script src="{{ asset('frontend/js/plugins.js') }}"></script>
        <!-- Main JS -->
        <script src="{{ asset('frontend/js/main.js') }}"></script>
        <!-- Video JS -->
        <script src="{{ asset('frontend/js/video.js') }}"></script>\
         <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
         <script>
         tinymce.init({
            selector: 'textarea#editor',
            menubar: false
          });
        
          tinymce.init({
            selector: 'textarea#editor1',
            menubar: false
          });
          </script>
        @stack('scripts')

    </body>
</html>
