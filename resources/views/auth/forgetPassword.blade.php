<!doctype html>
<html class="no-js" lang="en">
   <head>
      <meta charset="utf-8">
      <meta http-equiv="x-ua-compatible" content="ie=edge">
      <title>Forget Password</title>
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
               <a href="{{ route('login') }}" class="float-right  link-color"><span class="bold m-1 ">Close</span> <i class="fa fa-times"></i></a>
            </header>
            <div class="auth-content">
               <div>
                  <div class='row mb-3'>
                     <div class='input-field col-md-12'>
                        <h2 class="heading1 mb-2 text-left color-blue">Forgot password?</h2>
                        <p  class="heading3 text-left">
                           <strong> Choose how you want to login</strong>
                         </p>
                     </div>
                  </div>

                  @if (Session::has('message'))
                  <div class="alert alert-warning" role="alert">
                     {{ Session::get('message') }}
                  </div>
                  @endif

                  @if ($errors->has('email'))
                  <div class="alert alert-warning" role="alert">
                    {{ $errors->first('email') }}
                 </div>
                  @endif

                @if ($errors->has('phone'))
                    <div class="alert alert-warning" role="alert">
                        {{ $errors->first('phone') }}
                    </div>
                @endif

                  <form action="{{ route('forget.password.post') }}" method="post" class="fwrap">
                    @csrf
                     <div class="row">
                       <div class="card mb-2">
                          <div class="input-group">
                            <div class="col-md-10 col-10 p-4">
                                <label>Send an email to</label>
                                <input type="email" id="email_address" name="email" required class="form-control" placeholder="Email" pattern="[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{1,63}$" value="{{old('email')}}">

                            </div>
                            <div class="input-group-append col-md-2 p-0 fget_">
                              <span class="input-group-text">
                                <button type="submit"><i class="fa fa-long-arrow-right"></i></button>
                              </span>
                            </div>
                          </div>
                       </div>
                     </div>
                  </form>
                  <form action="{{ route('generateOtp') }}" method="post" class="fwrap">
                    @csrf
                    <div class="row">
                      <div class="card mt-3">
                         <div class="input-group">
                           <div class="col-md-10 col-10 p-4">
                               <label>Send a message to</label>
                               <input type="tel" required class="form-control" placeholder="Phone number" name="phone">

                           </div>
                           <div class="input-group-append col-md-2 p-0 fget_">
                             <span class="input-group-text">
                               <button type="submit"><i class="fa fa-long-arrow-right"></i></button>
                             </span>
                           </div>
                         </div>
                      </div>
                    </div>
                 </form>
               </div>
            </div>
            <p class="font-14px text-center mt-5">Copyright &copy; <?php echo date('Y') ?> Fix My Build Ltd. All Rights Reserved.</p>
         </section>
      </div>
      <!-- Bootstrap core JavaScript -->

      <script src="{{ asset('frontend/js/jquery.min.js') }}"></script>
      {{-- <script src="{{ asset('frontend/js/vendor/jquery-3.4.1.min.js') }}"></script> --}}
      {{-- <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
      <script src="assets/js/particles.js"></script>
      <script src="assets/js/app.js"></script> --}}
   </body>
</html>
