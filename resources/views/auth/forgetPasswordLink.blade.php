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
               <a href="{{url('/')}}" class="float-right  link-color"><span class="bold m-1 ">Close</span> <i class="fa fa-times"></i></a>
            </header>
            <div class="auth-content">
               <div>
                <div class="row">
                    <div class="input-field col-md-12">
                        <h2 class="heading1 mb-2 text-left color-blue">Set New password</h2>
                        {{-- <p class="heading3 text-left">
                            <strong>Instruction:</strong>
                        </p>
                        <h6><i class="fa fa-check"></i> 8-32 character</h6>
                        <h6><i class="fa fa-check"></i> One upper case</h6>
                        <h6><i class="fa fa-check"></i> One lower case</h6>
                        <h6><i class="fa fa-times"></i> One special character</h6>
                        <h6><i class="fa fa-circle"></i> One numeric character</h6> --}}
                    </div>
                </div>

                <form action="{{ route('reset.password.post') }}" method="post">
                    @csrf
                    <input type="hidden" name="token" value="{{ $token }}">

                    <div class="row">
                        <div class="form-group col-md-12 mt-4 pw_">
                            <input type="text" id="email_address" class="form-control" name="email" placeholder="Email"  required autofocus>
                            @if ($errors->has('email'))
                                <span class="text-danger">{{ $errors->first('email') }}</span>
                            @endif
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-12 mt-4 pw_">
                            <input type="password" id="password" class="form-control" name="password" placeholder="Password" required autofocus>
                            <em>
                                <a href="#"><i class="fa fa-eye-slash"></i></a>
                            </em>

                            @if ($errors->has('password'))
                                <span class="text-danger">{{ $errors->first('password') }}</span>
                            @endif


                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-12 mt-4 pw_">
                            <input type="password" id="password-confirm" class="form-control" name="password_confirmation" placeholder="Retype password" required autofocus>
                            <em>
                                <a href="#"><i class="fa fa-eye"></i></a>
                            </em>
                            @if ($errors->has('password_confirmation'))
                                <span class="text-danger">{{ $errors->first('password_confirmation') }}</span>
                            @endif

                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-12 mt-4 text-center forget_">
                            <button type="submit" class="btn btn-primary mb-3">Continue</button>
                        </div>
                    </div>

                </form>

               </div>
            </div>
            <p class="font-14px text-center mt-5">Copyright &copy; {{ date('Y' )}} FIX MY BUILD LTD. All Rights Reserved.</p>
         </section>
      </div>
      <!-- Bootstrap core JavaScript -->
      <script src="{{ asset('frontend/js/vendor/jquery-3.4.1.min.js') }}"></script>
      {{-- <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
      <script src="assets/js/particles.js"></script>
      <script src="assets/js/app.js"></script> --}}
   </body>
</html>
