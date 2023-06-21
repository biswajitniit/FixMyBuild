<!doctype html>
<html class="no-js" lang="en">
   <head>
      <meta charset="utf-8">
      <meta http-equiv="x-ua-compatible" content="ie=edge">
      <title>SMS Verification</title>
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
                     <!-- <p>Amet minim mollit non deserunt ullamco est sit aliqua dolor do amet sint. Velit officia consequat duis enim velit mollit. Exercitation veniam consequat </p> -->
                  </div>
               </div>
            </div>
         </section>
         <section class="content">
            <header>
               <a href="{{ route('forget.password.get') }}" class="float-right  link-color"><span class="bold m-1 ">Close</span> <i class="fa fa-times"></i></a>
            </header>
            <div class="auth-content">
                <div>
                    <div class='row'>
                        <div class='input-field col-md-12'>
                            <h2 class="heading1 mb-2 text-left color-blue">SMS Verification</h2>
                            <p  class="heading3 text-left mb-2">
                                A text message with a six digit verification code has been sent to your phone number ending in
                                <?php
                                $number =  $phone ;
                                $lastFourDigits = substr($number, -4);
                                echo 'XXXXXX' . $lastFourDigits;
                                ?>
                            </p>
                        </div>
                    </div>
                  @if (Session::has('message'))
                  <div class="alert alert-success" role="alert">
                     {{ Session::get('message') }}
                  </div>
                  @endif
                  @if (Session::has('error'))
                  <div class="alert alert-danger" role="alert">
                     {{ Session::get('error') }}
                  </div>
                  @endif
                  <form action="{{ route('otpVerify.post') }}" method="post" class="sms_v" id='otpverification' >
                    @csrf

                    <div class="row form-otp">
                        <input type="text"  id='input1' class="col-md-1 p-2 text-center" maxlength="1">
                        <input type="text"  id='input2' class="col-md-1 p-2 text-center" maxlength="1">
                        <input type="text"  id='input3' class="col-md-1 p-2 text-center" maxlength="1">
                        <input type="text"  id='input4' class="col-md-1 p-2 text-center" maxlength="1">
                        <input type="text"  id='input5' class="col-md-1 p-2 text-center" maxlength="1">
                        <input type="text"  id='input6' class="col-md-1 p-2 text-center" maxlength="1">
                        <input type='hidden' value="" id='otp' name="otp">
                        <input type='hidden' value="{{ $user_id }}" id='id' name="id">
                    </div>
                    <h5><a href="#" onclick="resendOtp()">Send another code</a></h5>
                     <div class="row">
                        <div class="form-group col-md-12 mt-4 mb-2 text-center forget_">
                           <button type="submit" class="btn btn-primary mb-3" >Continue</button>
                        </div>
                     </div>
                  </form>

               </div>
            </div>
            <p class="font-14px text-center mt-5">Copyright © 2022 FIX MY BUILD LTD. All Rights Reserved.</p>
         </section>
      </div>
      <!-- Bootstrap core JavaScript -->
      {{-- <script src="vendor/jquery/jquery.min.js"></script>
      <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
      <script src="assets/js/particles.js"></script>
      <script src="assets/js/app.js"></script> --}}
      <script src="{{ asset('frontend/js/jquery.min.js') }}"></script>
      <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

      <script>
            // for auto-focus
            $(".col-md-1").keyup(function () {
                const input1=$('#input1').val()
                const input2=$('#input2').val()
                const input3=$('#input3').val()
                const input4=$('#input4').val()
                const input5=$('#input5').val()
                const input6=$('#input6').val()
                const otp = input1+input2+input3+input4+input5+input6
                if(this.value.length == this.maxLength) {
                    $(this).next('.col-md-1').focus();
                    $('#otp').val(otp)
                }
                if(otp.length==6){
                    $('#otp').val(otp)
                    document.getElementById("otpverification").submit();
                }
            });

            // for resend sms otp

            function resendOtp() {
                var userid = document.getElementById('id').value
                $.ajax({
                url: "{{ route('resendOtp') }}",
                type: "POST",
                data: {'_token': "{{ csrf_token() }}",'user_id':userid},

                success: function(data) {
                    if(data==1){
                        Swal.fire({
                        icon: 'success',
                        title: 'New OTP has been sent to your mobile!!',
                        showConfirmButton: false,
                        timer: 1500
                        });
                    }else{
                        alert('OTP not sent')
                    }
                },
                error: function(data) {
                }
                });
            }
        </script>
   </body>
</html>
