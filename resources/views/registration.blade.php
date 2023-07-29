<!doctype html>
<html class="no-js" lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Fix my build | Sign Up</title>
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
    {{-- <link rel="stylesheet" href="https://cdn.tutorialjinni.com/intl-tel-input/17.0.8/css/intlTelInput.css"/> --}}
    <link rel="stylesheet" href="{{ asset('frontend/css/intlTelInput.css') }}"/>
    <link href="{{ asset('frontend/css/login-style.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/customcss/custom.css') }}" rel="stylesheet">
</head>
<body>
  <div class="main-contain">
    <section  class="auth-sidebar">
        <div class="auth-sidebar-content p-4">
           <div id="particles-js">
              <header class="logo"><a href="{{ route('home') }}"><img src="{{ asset('frontend/img/logo/logo.png') }}"  alt="Logo"></a></header>
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
                <span><a class="link-color" href="{{ route('login') }}">Sign in</a></span>
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

            {{-- @if(session()->has('message'))
                <div class="alert alert-success mt-15">
                    {{ session()->get('message') }}
                </div>
            @endif --}}

            {{-- <div class="modal fade select_address" id="successRegister" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-body text-center p-5">
                            <svg width="83" height="83" viewBox="0 0 83 83" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <g clip-path="url(#clip0_519_1019)">
                                <path d="M41.5002 4.61133C34.2043 4.61133 27.0722 6.77482 21.0059 10.8282C14.9395 14.8816 10.2114 20.6429 7.41934 27.3834C4.62731 34.124 3.89679 41.5411 5.32015 48.6969C6.74352 55.8526 10.2568 62.4256 15.4159 67.5846C20.5749 72.7436 27.1478 76.2569 34.3036 77.6803C41.4593 79.1037 48.8764 78.3731 55.617 75.5811C62.3576 72.7891 68.1188 68.0609 72.1722 61.9946C76.2256 55.9282 78.3891 48.7962 78.3891 41.5002C78.3891 31.7167 74.5026 22.3338 67.5846 15.4158C60.6666 8.49783 51.2838 4.61133 41.5002 4.61133ZM41.5002 73.778C35.1163 73.778 28.8757 71.8849 23.5677 68.3382C18.2596 64.7915 14.1225 59.7504 11.6795 53.8524C9.23643 47.9544 8.59722 41.4644 9.84266 35.2031C11.0881 28.9419 14.1623 23.1905 18.6764 18.6764C23.1905 14.1623 28.9419 11.0881 35.2032 9.84265C41.4644 8.5972 47.9544 9.23641 53.8524 11.6794C59.7504 14.1225 64.7915 18.2596 68.3382 23.5676C71.885 28.8757 73.778 35.1163 73.778 41.5002C73.778 50.0608 70.3773 58.2708 64.3241 64.3241C58.2708 70.3773 50.0608 73.778 41.5002 73.778Z" fill="#061A48"/>
                                <path d="M64.5554 27.897C64.1235 27.4676 63.5391 27.2266 62.93 27.2266C62.3209 27.2266 61.7366 27.4676 61.3046 27.897L35.7129 53.3734L21.8796 39.5401C21.4577 39.0845 20.8721 38.8152 20.2516 38.7914C19.6312 38.7677 19.0267 38.9913 18.5711 39.4133C18.1156 39.8352 17.8463 40.4208 17.8225 41.0412C17.7987 41.6617 18.0224 42.2662 18.4443 42.7217L35.7129 59.9442L64.5554 31.1709C64.7715 30.9566 64.9431 30.7016 65.0601 30.4206C65.1772 30.1397 65.2374 29.8383 65.2374 29.5339C65.2374 29.2296 65.1772 28.9282 65.0601 28.6473C64.9431 28.3663 64.7715 28.1113 64.5554 27.897Z" fill="#061A48"/>
                                </g>
                                <defs>
                                <clipPath id="clip0_519_1019">
                                <rect width="83" height="83" fill="white"/>
                                </clipPath>
                                </defs>
                            </svg>
                            <h5 class="color-blue mt-4">Thank you for registering for an account!</h5>
                            <p>{{ session()->get('message') }}</p>
                        </div>
                        <div class="modal-footer justify-content-center">
                            <a href={{ route('login') }} class="btn btn-light">Continue</a>
                        </div>
                    </div>
                </div>
            </div> --}}

            <form action="{{ route('user.save-user') }}" name="userregistration" id="userregistration" class="contact-form" method="POST">
                @csrf
                <div class="row">
                    <div class="form-group col-md-12">
                        <input type="text" name="name" id="name" class="form-control" placeholder="Full name"  required value="{{old('name')}}"/>
                    </div>
                </div>

                <div class="form-group col-md-12 mt-4">
                    <input type="email" name="email" id="email" class="form-control" placeholder="Email" id="email" value="{{old('email')}}" required pattern="[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{1,63}$" autocomplete="off"/>
                </div>

                <div class="input-field col-md-12" id="passwordCriteria" style="display: none">
                    <h6 id="pswd_length"><i class="fa fa-times text-danger"></i> 8-32 character</h6>
                    <h6 id="pswd_uppercase"><i class="fa fa-times text-danger"></i> One upper case</h6>
                    <h6 id="pswd_lowercase"><i class="fa fa-times text-danger"></i> One lower case</h6>
                    <h6 id="pswd_special"><i class="fa fa-times text-danger"></i> One special character</h6>
                    <h6 id="pswd_digit" class="mb-0"><i class="fa fa-times text-danger"></i> One numeric character</h6>
                </div>

                <div class="row">
                    <div class="form-group col-md-12 mt-4 pw_">
                        <input type="password" name="password" id="password" class="form-control" placeholder="Password" onkeyup="checkPasswordStrength();" onChange="Chkpassword_and_conpassword()" required autocomplete="off"/>
                        <em onclick="tooglepassword($(this))">
                            <a href="#">
                                {{-- <i class="fa fa-eye-slash" id="eye"></i> --}}
                                <img class="eye-slash-icon" src="{{ asset('frontend/img/hide_password.svg') }}" alt="" >
                                <img class="eye-icon d-none" src="{{ asset('frontend/img/show_password.svg') }}" alt="">
                            </a>
                        </em>
                    </div>
                </div>

                {{-- <div id="password-strength-status"></div> --}}

                <div class="row">
                    <div class="form-group col-md-12 mt-4 pw_">
                        <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" placeholder="Confirm password*"  onkeyup="checkPasswordStrength_confirm();" onChange="Chkpassword_and_conpassword()" required/>
                        <em onclick="tooglepasswordconfirm($(this))">
                            <a href="#">
                                <img class="eye-slash-icon" src="{{ asset('frontend/img/hide_password.svg') }}" alt="" >
                                <img class="eye-icon d-none" src="{{ asset('frontend/img/show_password.svg') }}" alt="">
                            </a>
                        </em>
                    </div>
                </div>

                {{-- <div id="password-strength-status-confirm"></div> --}}

                <div class="form-group col-md-12 mt-4">
                    <input type="text" name="phone" class="form-control col-md-10" id="phone" placeholder="Mobile phone"  value="{{old('phone')}}" required/>
                    <label for="phone" generated="true" class="error"></label>
                    <input type="hidden" name="full_phone" id="full_phone"  value="{{old('full_phone')}}"/>
                </div>
                @production
                <input type="hidden" name="customer_or_tradesperson" value="Tradesperson">
                @endproduction
                @env(['staging', 'development','local'])
                <div>
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
                @endenv
                <div class="form-check mt-4">
                    <label class="form-check-label">
                        <input class="form-check-input" type="checkbox" id="terms_of_service" name="terms_of_service" value="1" @if(old('terms_of_service') == 1) checked @endif required/> I have read and agree to our

                        <a href="{{ route('termspage') }}">Terms of Service</a> and <a href="{{ route('privacy-policy') }}">Privacy Policy</a>.
                    </label>
                    <div class="form-group">
                        <label for="terms_of_service" generated="true" class="error"></label>
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-md-12 mt-4">
                        <button type="submit" id="register" class="btn btn-primary" >Register</button>
                    </div>
                </div>

            </form>


          @env(['staging', 'development','local'])
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
          @endenv


        </div>
      </div>
      <p class="font-14px text-center mt-5">Copyright &copy; {{date('Y')}} Fix My Build Ltd. All Rights Reserved.</p>
    </section>

  </div>
  <!-- Bootstrap core JavaScript -->

  <script src="{{ asset('frontend/js/jquery.min.js') }}"></script>
  <script src="{{ asset('frontend/js/bootstrap.min.js') }}"></script>
  {{-- <script src="https://cdn.tutorialjinni.com/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script> --}}
  <script src="{{ asset('frontend/js/intlTelInput.min.js') }}"></script>
  <script src="{{ asset('frontend/js/utils.js') }}"></script>
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
                    rangelength: [8, 32],
                    includeUpperCase: true,
                    includeLowerCase: true,
                    includeSpecialCharacter: true,
                    includeDigit: true
                },
                password_confirmation: {
                    required: true,
                    equalTo: '#password'
                },
                phone: {
                    required: true,
                    phoneNumber: true
                },
                customer_or_tradesperson: {
                    required: true,
                }
            },
            messages: {
                name: {
                    required: "Please enter your full name",
                },
                email: {
                    required: "Please enter your email address",
                },
                password: {
                    required: "Please enter your password",
                    rangelength: jQuery.validator.format("At least 8 characters and maximum 32 characters are required!")
                },
                password_confirmation: {
                    required: "Please re-enter your password for confirmation",
                    equalTo: "Confirm password doesn't match with password field"
                },
                phone: {
                    required: "Please enter your phone number",
                    phoneNumber: 'Invalid phone number'
                },
                customer_or_tradesperson: {
                    required: "Are you a customer or tradeperson?",
                },
                terms_of_service: {
                    required: "Please agree to our Terms of Service and Privacy Policy."
                }
            },
            submitHandler: function(form) {
                $('#full_phone').val(iti.getNumber());
                form.submit();
            }
        });

        // Jquery Validations
        $.validator.addMethod('includeUpperCase', function(value, element){
            return value.match(/[A-Z]/);
        }, 'Please include a upper case letter.');

        $.validator.addMethod('includeLowerCase', function(value, element){
            return value.match(/[a-z]/);
        }, 'Please include a lower case letter.');

        $.validator.addMethod('includeDigit', function(value, element){
            return value.match(/[0-9]/);
        }, 'Please include a numeric character.');

        $.validator.addMethod('includeSpecialCharacter', function(value, element){
            return value.match(/([~,!,@,#,$,%,^,&,*,-,_,+,=,?,>,<])/);
        }, 'Please include a special characters.');


        // phone number setup
        let input = document.querySelector("#phone");
        let iti = window.intlTelInput(input, {
            separateDialCode: true,
            initialCountry: "gb",
        });

        // Jquery Validation
        $.validator.addMethod('phoneNumber', function(value, element) {
            let phone = $('#phone').val();
            return /[a-z]/i.test(phone) ? !/[a-z]/i.test(phone) : iti.isValidNumber();
        }, 'Invalid phone number');

        input.addEventListener('countrychange', function(e) {
            $("#userregistration").validate().element('#phone');
        });

        // $("#fullname").bind("keypress", function (event) {
        //     if (event.charCode!=0) {
        //         var regex = new RegExp("^[a-zA-Z ]+$");
        //         var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
        //         if (!regex.test(key)) {
        //             event.preventDefault();
        //             return false;
        //         }
        //     }
        // });

        // $('#userregistration').submit(function(event) {
        //     event.preventDefault();
        //     $('#full_phone').val(iti.getNumber());
        //     this.submit();
        // });


        $('#name').focus();

        $('#password, #password_confirmation').on('keyup blur', function(){
            password_validation();
            // disableForm();
        });

        $('#password').focus(function (e) {
            // $('#passwordCriteria').removeClass('d-none');
            $('#password').closest('.form-group').removeClass('mt-4').addClass('mt-2');
            $("#passwordCriteria").show('slow');
        });

        $('#password').blur(function (e) {
            $('#password').closest('.form-group').removeClass('mt-2').addClass('mt-4');
            $("#passwordCriteria").hide('slow');
        });

        // @if(session()->has('message'))
        //     $('#successRegister').modal('show');
        // @endif

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





    // $(document).ready(function(){
    //     $("#userregistration").validationEngine();
    // });

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

    // function checkBox() {
    //     const checkbox = document.getElementById("terms_of_service");
    //     const button  = document.getElementById("register");
    //     if (checkbox.checked == false || password_validation() == false) {
    //         button.disabled = true;
    //     }
    //     else{
    //         button.disabled = false;
    //     }isCheckedCheckBox();
    // }

    // function isCheckedCheckBox() {
    //     return $('#terms_of_service').is(':checked');
    // }

    function disableForm() {
        if($('#terms_of_service').is(':checked') && password_validation()) {
            $('#register').attr('disabled', false);
        } else {
            $('#register').attr('disabled', true);
        }
    }

  </script>

</body>
</html>
