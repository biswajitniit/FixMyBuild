@extends('layouts.app')



@section('content')
 <!--Code area start-->
 {{-- Avatar Upload Modal Starts --}}
<div class="modal fade select_address" id="companyLogoModal" tabindex="-1" aria-labelledby="companyModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header pb-0">
                <h5 class="modal-title" id="companyModalLabel">Change profile photo</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <svg width="19" height="19" viewBox="0 0 19 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M2.26683 18.5416L0.458496 16.7333L7.69183 9.49992L0.458496 2.26659L2.26683 0.458252L9.50016 7.69159L16.7335 0.458252L18.5418 2.26659L11.3085 9.49992L18.5418 16.7333L16.7335 18.5416L9.50016 11.3083L2.26683 18.5416Z"
                            fill="black"
                        />
                    </svg>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12 supported_">
                        <h5>
                            Supported file type list:
                            <div class="ext_">.gif .heic .jpeg, .jpg .png .svg .webp</div>
                        </h5>
                        <form method="post" enctype="multipart/form-data" id="single_file_dropzone" class="dropzone text-center upload_wrap cpp_wrap">
                            @csrf
                            <div class="dz-default dz-message" id="single-file-upload-logo">
                                <img src="{{ asset('frontend/img/upload.svg') }}" alt="" />
                                <p>Drag and drop files here</p>
                                <h4>OR</h4>
                                <button type="button" id="single_file_upload_btn" class="btn btn-light mt-3" style="width: 180px;">Browse files</button>
                            </div>

                            <div class="files d-none" id="singleFilePreview">
                                <div id="singleFileTemplate" class="dz-image-preview">
                                    <div class="card clr-bg clr-border">
                                        <img class="card-img rounded-img" data-dz-thumbnail />
                                        <div class="card-img-overlay">
                                            <div class="progress progress-bar-striped active center-progress" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0">
                                                <div class="progress-bar bg-success" style="width:0%;" data-dz-uploadprogress></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div>
                                        <p class="name" data-dz-name></p>
                                        <small class="error text-danger" data-dz-errormessage></small>
                                    </div>
                                    {{-- <div>
                                        <button data-dz-remove class="btn text-orange delete">
                                            <span>Delete</span>
                                        </button>
                                    </div> --}}
                                </div>
                            </div>

                            {{-- <div>
                                <p>Drag and drop files here</p>
                                <h4>OR</h4>
                                <button type="button" id="single_file_upload_btn" class="btn btn-light mt-3" style="width: 180px;">Browse files</button>
                            </div> --}}
                        </form>
                        <div class='invalid-file'></div>
                        <div class="dropzone-messages"></div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-link" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-light" id="upload_single_file">Upload</button>
            </div>
        </div>
    </div>
</div>
{{-- Avatar Upload Modal Ends --}}

 <section>
    <div class="container">
       <div class="row">
          <div class="col-md-12 text-center pt-5 fmb_titel">
             <h1>My profile</h1>
             <ol class="breadcrumb mb-5">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Settings</li>
             </ol>
          </div>
       </div>
    </div>
 </section>
<!--Code area end-->
@if( Auth::user()->is_email_verified === 0 )
<section>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-7">
                <div class="alert alert-warning" role="alert">
                    <span>
                        <svg width="33" height="29" viewBox="0 0 33 29" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M16.4987 0.916992L0.457031 28.6253H32.5404M16.4987 6.75033L27.4799 25.7087H5.51745M15.0404 12.5837V18.417H17.957V12.5837M15.0404 21.3337V24.2503H17.957V21.3337" fill="#EE5719"></path>
                        </svg>
                    </span>
                    Please Verify Your Email.
                </div>
            </div>
            <div class="col-md-4">
                <button class="btn btn-primary" id="verify_mail">Resend Verification Link</button>
            </div>
        </div>
    </div>
</section>
@else
@endif
<!--Code area start-->
<section class="pb-5">
    <div class="container">
        <div class="row">
            <div class="col-md-3 dashboard_sidebar">
                <ul>
                    <li class="active"><a href="{{ route('customer.profile') }}">Profile</a></li>
                    <li><a href="{{ route('customer.project') }}">Projects</a></li>
                    <li><a href="{{ route('customer.notifications.index') }}">Notifications</a></li>
                    <li><a href="{{ route('logout') }}">Logout</a></li>
                </ul>
            </div>
            <div class="col-md-9 dashboard_wrapper">
                <div class="blue-font-color mt-4 mb-5">
                    <div class="row">
                        <div class="col-md-3 profile_pics">
                            @if (auth()->user()->profile_image)
                                <img src="{{ auth()->user()->profile_image }}" alt="" />
                            @else
                                <img src="{{ asset('images/user.png') }}" alt="" />
                            @endif
                            {{-- <a href="#" data-bs-toggle="modal" data-bs-target="#profile_pics"><img src="{{ asset('frontend/img/edit-pics.svg') }}" alt="" class="edit-pics" /></a> --}}
                            <a href="javascript:void(0);" onclick="avatar_upload()"><img src="{{ asset('frontend/img/edit-pics.svg') }}" alt="" class="edit-pics" /></a>
                            <!-- The Modal Change profile photo-->
                            {{-- <div class="modal fade select_address" id="profile_pics" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header pb-0">
                                            <h5 class="modal-title" id="exampleModalLabel">Change profile photo</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                                <svg width="19" height="19" viewBox="0 0 19 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M2.26683 18.5416L0.458496 16.7333L7.69183 9.49992L0.458496 2.26659L2.26683 0.458252L9.50016 7.69159L16.7335 0.458252L18.5418 2.26659L11.3085 9.49992L18.5418 16.7333L16.7335 18.5416L9.50016 11.3083L2.26683 18.5416Z"
                                                        fill="black"
                                                    />
                                                </svg>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-md-12 supported_">
                                                    <h5>
                                                        Supported file type list:
                                                        <div class="ext_">.gif .heic .jpeg, .jpg .png .svg .webp</div>
                                                    </h5>
                                                    <div>
                                                        <form action="{{ route('customer.updateavatar') }}" method="post" enctype="multipart/form-data" id="avatar_dropzone" class="text-center upload_wrap cpp_wrap">
                                                            @csrf
                                                            @method('PUT')
                                                            <div id="remove_after_upload">
                                                                <img src="{{ asset('frontend/img/upload.svg') }}" alt="" />
                                                                <p>Drag and drop files here</p>
                                                                <h4>OR</h4>
                                                                <button type="button" id="file_upload_btn" class="btn btn-light mt-3" style="width: 180px;">Browse files</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-link" data-bs-dismiss="modal">Cancel</button>
                                            <button type="button" class="btn btn-light" id="upload_avatar">Upload</button>
                                        </div>
                                    </div>
                                </div>
                            </div> --}}
                            {{-- <div class="modal fade select_address" id="profile_pics" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header pb-0">
                                            <h5 class="modal-title" id="exampleModalLabel">Change profile photo</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                                <svg width="19" height="19" viewBox="0 0 19 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M2.26683 18.5416L0.458496 16.7333L7.69183 9.49992L0.458496 2.26659L2.26683 0.458252L9.50016 7.69159L16.7335 0.458252L18.5418 2.26659L11.3085 9.49992L18.5418 16.7333L16.7335 18.5416L9.50016 11.3083L2.26683 18.5416Z"
                                                        fill="black"
                                                    />
                                                </svg>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-md-12 supported_">
                                                    <h5>
                                                        Supported file type list:
                                                        <div class="ext_">.gif .heic .jpeg, .jpg .png .svg .webp</div>
                                                    </h5>
                                                    <form action="{{ route('customer.updateavatar') }}" method="post" enctype="multipart/form-data" id="avatar_dropzone" class="dropzone text-center upload_wrap cpp_wrap">
                                                        @csrf
                                                        @method('PUT')
                                                        <div class="dz-message">
                                                            <img src="{{ asset('frontend/img/upload.svg') }}" alt="" />
                                                            <p>Drag and drop a file here</p>
                                                            <h4>OR</h4>
                                                            <button type="button" id="file_upload_btn" class="btn btn-light mt-3" style="width: 180px;">Browse files</button>
                                                        </div>
                                                    </form>
                                                    <div class='invalid-file'></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-link" data-bs-dismiss="modal">Cancel</button>
                                            <button type="button" class="btn btn-light" id="upload_avatar" disabled>Upload</button>
                                        </div>
                                    </div>
                                </div>
                            </div> --}}

                            <!-- The Modal Change profile photo END-->
                        </div>
                        <div class="col-md-9">
                            <div id="display-name">
                                <h3>
                                    <span class="show-name">{{Auth::user()->name}}</span>
                                    <span>
                                        <button href="#" class="edit-name-btn">
                                            <img src="{{ asset('frontend/img/edit-pencil.svg') }}" alt="" />
                                        </button>
                                    </span>
                                </h3>
                             </div>
                            <div id="edit-name" hidden>
                                <form action="#" id="updateNameForm">
                                    @csrf
                                    @method('PUT')
                                    <h3>
                                        <input type="text" name="name" value="{{ Auth::user()->name }}"/>
                                    </h3>
                                    <span class="pull-right">
                                        <button id="submit-name">
                                            <img src="{{ asset('frontend/img/tick.svg') }}" alt=""/>
                                        </button>
                                        <button class="cancel-btn">
                                            <img src="{{ asset('frontend/img/cancel-name.svg') }}"  class="ml-2" alt="" />
                                        </button>
                                    </span>
                                    <input type="submit" hidden>
                                </form>
                             </div>

                             <div id="update-name-errors"></div>

                             <div class="row">
                                <div class="col-md-6">
                                    <h5>Email: {{Auth::user()->email}}</h5>
                                </div>
                                <div class="col-md-6">
                                    <h5>
                                        Password: *************
                                        <a href="#" data-bs-toggle="modal" data-bs-target="#change_pw"><img src="{{ asset('frontend/img/edit-pencil.svg') }}" alt="" /></a>
                                    </h5>
                                </div>
                                <!-- The ModalChange password-->
                                <div class="modal fade select_address" id="change_pw" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <form action="#" id="changePasswordForm" method="post">
                                                <div class="modal-header pb-0">
                                                    <h5 class="modal-title" id="exampleModalLabel">Change password</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                                        <svg width="19" height="19" viewBox="0 0 19 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path
                                                                d="M2.26683 18.5416L0.458496 16.7333L7.69183 9.49992L0.458496 2.26659L2.26683 0.458252L9.50016 7.69159L16.7335 0.458252L18.5418 2.26659L11.3085 9.49992L18.5418 16.7333L16.7335 18.5416L9.50016 11.3083L2.26683 18.5416Z"
                                                                fill="black"
                                                            />
                                                        </svg>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="password-messages"></div>
                                                    <div class="row">
                                                        <div class="col-md-12 supported_">
                                                            <div class="row">
                                                                <div class="form-group col-md-12 pw_">
                                                                    <input type="password" class="form-control" name="current_password" id="currentPassword" placeholder="Enter your current password here" required/>
                                                                    <em>
                                                                        <a href="#">
                                                                            {{-- <i class="fa fa-eye-slash"></i> --}}
                                                                            <img class="eye-slash-icon" src="{{ asset('frontend/img/hide_password.svg') }}" alt="" >
                                                                            <img class="eye-icon d-none" src="{{ asset('frontend/img/show_password.svg') }}" alt="">
                                                                        </a>
                                                                    </em>
                                                                </div>
                                                            </div>
                                                            <div class="input-field col-md-12">
                                                                <p class="heading3 text-left">
                                                                    <strong>Criteria:</strong>
                                                                </p>
                                                                <h6 id="pswd_length"> 8-32 character</h6>
                                                                <h6 id="pswd_uppercase"> One upper case</h6>
                                                                <h6 id="pswd_lowercase"> One lower case</h6>
                                                                <h6 id="pswd_special"> One special character</h6>
                                                                <h6 id="pswd_digit"> One numeric character</h6>
                                                            </div>
                                                            <div class="row">
                                                                <div class="form-group col-md-12 mt-1 pw_">
                                                                    <input type="password" class="form-control" name="new_password" id="newPassword" placeholder="New password" required/>
                                                                    {{-- <em>
                                                                        <a href="#"><i class="fa fa-eye-slash"></i></a>
                                                                    </em> --}}
                                                                    <em>
                                                                        <a href="#">
                                                                            <img class="eye-slash-icon" src="{{ asset('frontend/img/hide_password.svg') }}" alt="" >
                                                                            <img class="eye-icon d-none" src="{{ asset('frontend/img/show_password.svg') }}" alt="">
                                                                        </a>
                                                                    </em>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="form-group col-md-12 mt-3 mb-3 pw_">
                                                                    <input type="password" class="form-control" name="new_password_confirmation" id="newConfirmPassword" placeholder="Confirm password" required/>
                                                                    {{-- <em>
                                                                        <a href="#"><i class="fa fa-eye-slash"></i></a>
                                                                    </em> --}}
                                                                    <em>
                                                                        <a href="#">
                                                                            <img class="eye-slash-icon" src="{{ asset('frontend/img/hide_password.svg') }}" alt="" >
                                                                            <img class="eye-icon d-none" src="{{ asset('frontend/img/show_password.svg') }}" alt="">
                                                                        </a>
                                                                    </em>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-link" data-bs-dismiss="modal">Cancel</button>
                                                    <button type="submit" class="btn btn-light" disabled>Save</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <!-- The Modal Change password END-->
                            </div>
                        </div>
                    </div>
                </div>
                <div class="white_bg">
                    <div class="row num_change">
                        <div class="col-md-6">
                            <h3>Contact</h3>
                        </div>
                        <div class="col-md-6">
                            <input type="text" class="form-control" id="phone" disabled/>
                            <button class="num-edit">Has your number changed?</button>
                            <button id="save_" class="pull-left mr-4" disabled hidden>Save</button>
                            <button id="cancel_" hidden>Cancel</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--// END-->
    </div>
</section>
<!--Code area end-->




@endsection

@push('scripts')
<script src="{{ asset('frontend/js/utils.js') }}"></script>
<script src="{{ asset('frontend/dropzone/dropzone.js') }}"></script>
    <script>
    $(function () {
        let phone_num = '{{ Auth::user()->phone }}';
        let input = document.querySelector("#phone");
        let iti = window.intlTelInput(input, {
            separateDialCode: true,
            allowDropdown: false,
        });
        iti.setNumber(phone_num);
        let phone_field = $('.num_change').find('.form-control:disabled').addClass('clr-bg');
        password_validation();

        input.addEventListener("countrychange", function() {
            if($('#phone').val().trim()){
                if(iti.isValidNumber()){
                    $('#save_').attr('disabled', false);
                }else{
                    $('#save_').attr('disabled', true);
                }
            }
        });

        $(document).on("submit", "#changePasswordForm", function (e) {
            e.preventDefault();
            let form_data = $(this).serializeArray();
            form_data.push({ name: '_token', value: '{{ csrf_token() }}' });
            $('.password-messages').empty();
            changePassword(form_data);
        });


        $('input[id=currentPassword]').keyup(function(){
            password_validation();
        });

        $('input[id=newPassword]').keyup(function(){
            password_validation();
        });

        $('input[id=newConfirmPassword]').keyup(function(){
            password_validation();
        });

        // On Closing Password Modal empty the messages and input fields
        $('#change_pw').on('hidden.bs.modal', function (e) {
            $('.password-messages').empty();
            $('#changePasswordForm :input').val('');
            password_validation('input[id=newPassword]');
        });

        // Toggle Password show/hide
        $('.pw_ a').click(function() {
            var input = $(this).closest('.pw_').find('input');
            // var icon = $(this).find('i');

            if(input.attr('type') === 'password'){
                input.attr('type', 'text');
                // icon.removeClass('fa-eye-slash').addClass('fa-eye');
                $(this).find('.eye-icon').removeClass('d-none');
                $(this).find('.eye-slash-icon').addClass('d-none');
            } else {
                input.attr('type', 'password');
                // icon.removeClass('fa-eye').addClass('fa-eye-slash');
                $(this).find('.eye-slash-icon').removeClass('d-none');
                $(this).find('.eye-icon').addClass('d-none');
            }
        });

        // Update Name Starts
        $('#display-name .edit-name-btn').click(function(){
            $('#display-name').attr('hidden', true);
            $('#edit-name').attr('hidden', false);
        });

        $('#edit-name .cancel-btn').click(function(){
            $('#display-name').attr('hidden', false);
            document.getElementById("updateNameForm").reset();
            $('#edit-name').attr('hidden', true);
        });

        $('#submit-name').click(function(){
            $(this).closest('form').submit();
        });

        $(document).on('submit', '#updateNameForm', function (e) {
            e.preventDefault();
            let form_data = $(this).serialize();
            $('.password-messages').empty();
            changeName(form_data);
        });

        $('#updateNameForm input[name="name"]').on('keyup', function(e){
            if ($(this).val() == '') {
                $(this).closest('form').find('#submit-name').prop('disabled', true);
            } else {
                $(this).closest('form').find('#submit-name').prop('disabled', false);
            }
        })

        // Update Name Ends



        function changeName(form_data){
            $.ajax({
                type: 'PUT',
                datatype: 'json',
                url: "{{ route('customer.updatename') }}",
                data: form_data,
                success: function (response) {
                    $('#display-name').attr('hidden', false);
                    $('#display-name .show-name').text(response.name);
                    $('#update-name-errors .alert').remove();
                    // Set the name in the navbar
                    $('.dropdown-menu li:first-child a.dropdown-item').contents().filter(function() {
                        return this.nodeType === 3;
                    })[0].data=response.name;
                    $('.dropdown-menu li:first-child a.dropdown-item').contents().filter(function() {
                        return this.nodeType === 3;
                    })[1].data=response.name;
                    $('#edit-name').attr('hidden', true);
                },
                error: function (xhr, status, error) {
                    $('#update-name-errors .alert').remove();
                    if(xhr.responseJSON.errors) {
                        let errors = xhr.responseJSON.errors;
                        let errorMessages = '<ul>';
                        $.each(errors, function(field, fieldErrors) {
                            $.each(fieldErrors, function(key, errorMessage) {
                                errorMessages += `<li> ${errorMessage} </li>`;
                            });
                        });
                        errorMessages += '</ul>';
                        let errorElement = $(`<div class="alert alert-danger"></div>`).append(errorMessages);
                        $('#update-name-errors').append(errorElement);
                    }
                }
            });
        }

        function password_validation(){
            let curr_password = 'input[id=currentPassword]';
            let password = 'input[id=newPassword]';
            let conf_password = 'input[id=newConfirmPassword]';
            let curr_pswd = $(curr_password).val().trim();
            let pswd = $(password).val().trim();
            let c_pswd = $(conf_password).val().trim();
            let invalid = '<i class="fa fa-times" style="color:red;"></i>';
            let valid = '<i class="fa fa-check" style="color:green;"></i>';
            let is_valid = true;

            $(curr_password).val(curr_pswd);
            $(password).val(pswd);
            $(conf_password).val(c_pswd);

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
            if(c_pswd !== pswd){
                is_valid = false;
            }

            // Check if current password is not empty
            if(curr_pswd == ''){
                is_valid = false;
            }

            if(is_valid){
                $('#changePasswordForm button[type="submit"]').prop('disabled', false);
            }else{
                $('#changePasswordForm button[type="submit"]').prop('disabled', true);
            }
        }

        function changePassword(form_data) {
            $.ajax({
                type: 'POST',
                datatype: 'json',
                url: "{{ route('customer.changepassword') }}",
                data: form_data,
                success: function (response) {
                    let messageElement = $(`<div class="alert alert-success">${response.success}</div>`);
                    $(".password-messages").append(messageElement);
                },
                error: function (xhr, status, error) {
                    if(xhr.responseJSON.errors) {
                        let errors = xhr.responseJSON.errors;
                        let errorMessages = '<ul>';
                        $.each(errors, function(field, fieldErrors) {
                            $.each(fieldErrors, function(key, errorMessage) {
                                errorMessages += `<li> ${errorMessage} </li>`;
                            });
                        });
                        errorMessages += '</ul>';
                        let errorElement = $(`<div class="alert alert-danger"></div>`).append(errorMessages);
                        $('.password-messages').append(errorElement);
                    }
                    if(xhr.responseText) {
                        let errorMessage = JSON.parse(xhr.responseText).error;
                        let errorElement = $(`<div class="alert alert-danger"></div>`).append(errorMessage);
                        $('.password-messages').append(errorElement);
                    }
                }
            });
        };

        // Update Phone Number Starts
        $('#phone').keyup(function(){
            if($('#phone').val().trim()){
                if(iti.isValidNumber()){
                    $('#save_').attr('disabled', false);
                }else{
                    $('#save_').attr('disabled', true);
                }
            }
        })

        $('.num_change .num-edit').click(function(){
            $(this).attr('hidden', true);
            $('#save_').attr('hidden', false);
            $('#cancel_').attr('hidden', false);
            $("#phone").attr('disabled', false);
            $("#phone").addClass('input-border');
            iti.destroy();
            iti = window.intlTelInput(input, {
                separateDialCode: true,
                allowDropdown: true,
            });
            iti.setNumber(phone_num);
        });

        $('#save_').click(function(){
            $.ajax({
                type: 'PUT',
                datatype: 'json',
                url: "{{ route('customer.updatephone') }}",
                data: {'phone' : iti.getNumber(), '_token' : '{{ csrf_token() }}'},
                success: function (response) {
                    // $('#save_').attr('disabled', true);
                    $('#save_').attr('hidden', true);
                    $('#cancel_').attr('hidden', true);
                    // $('#cancel_').attr('disabled', true);
                    $("#phone").attr('disabled', true);
                    $("#phone").removeClass('input-border');
                    $('.num_change .num-edit').attr('hidden', false);
                    iti.destroy();
                    iti = window.intlTelInput(input, {
                        separateDialCode: true,
                        allowDropdown: false,
                    });
                    iti.setNumber(response.phone);
                    phone_num = response.phone;
                },
                error: function (xhr, status, error) {
                }
            });
        });

        $('#cancel_').click(function(){
            $('#save_').attr('hidden', true);
            $('#cancel_').attr('hidden', true);
            $('.num_change .num-edit').attr('hidden', false);
            $("#phone").attr('disabled', true);
            $("#phone").removeClass('input-border');
            iti.destroy();
            iti = window.intlTelInput(input, {
                separateDialCode: true,
                allowDropdown: false,
            });
            iti.setNumber(phone_num);
        });
        // Update Phone Number Ends


        Dropzone.autoDiscover = false;
        // // Dropzone Js Starts
        // let dropzone = new Dropzone("#avatar_dropzone", {
        //     url: "{{ route('customer.updateavatar') }}",
        //     uploadMultiple: false,
        //     maxFiles: 1,
        //     // maxFilesize: {{ env('CUSTOMER_PROFILE_IMAGE_SIZE') }},
        //     // acceptedFiles: "{{ env('CUSTOMER_PROFILE_IMAGE_ACCEPTED_FILE_TYPES') }}",
        //     maxFilesize: {{ config('const.dropzone_max_file_size') }},
        //     acceptedFiles: "{{ config('const.dropzone_accepted_image') }}",
        //     thumbnailWidth: 240,
        //     thumbnailHeight: 240,
        //     autoProcessQueue: false,
        //     previewsContainer: ".dropzone",
        //     clickable: "#file_upload_btn",
        //     dictDefaultMessage: "Drag and drop a file here",
        //     init: function() {
        //         let dz = this;
        //         let uploadButton = $("#upload_avatar");

        //         this.on("addedfile", function(file) {
        //             if (this.files.length > 1) {
        //                 dz.removeFile(this.files[0]);
        //             }
        //             updateUploadButton();
        //         });

        //         this.on("removedfile", function(file) {
        //             updateUploadButton();
        //         });

        //         this.on("thumbnail", function(file, dataUrl) {
        //             $("#avatar_dropzone").find(".dz-message").hide();
        //             $(file.previewElement).find(".dz-error-mark, .dz-success-mark, .dz-error-message, .dz-progress").hide();
        //             updateUploadButton();
        //         });

        //         this.on("sending", function(file, xhr, formData) {
        //             // $(file.previewElement).find(".dz-progress").css({"display": "block","position": "relative"});
        //             uploadButton.prop("disabled", true);
        //         });

        //         this.on("uploadprogress", function(file, progress) {
        //             if (file.upload) {
        //                 // $(file.previewElement).find(".dz-progress").css({"display": "block","position": "relative"});
        //                 uploadButton.prop("disabled", true);
        //             }
        //         });

        //         this.on("success", function(file, response) {
        //             $(file.previewElement).find(".dz-progress").hide();
        //             $(file.previewElement).find(".dz-success-mark").show();
        //             $('.profile_pics > img').attr('src', response.image_link);
        //             $('.reg_ img').attr('src', response.image_link);

        //             updateUploadButton();
        //         });

        //         this.on("error", function(file, errorMessage) {
        //             $(file.previewElement).find(".dz-progress").hide();
        //             $(file.previewElement).find(".dz-error-message").text(errorMessage).show();
        //             $(file.previewElement).find(".dz-error-mark").show();
        //             updateUploadButton();
        //         });

        //         function updateUploadButton() {
        //             let maxFileSize = dz.options.maxFilesize ? dz.options.maxFilesize * 1024 * 1024 : (2 * 1024 * 1024);
        //             // let acceptedFileTypes = dz.options.acceptedFiles ? dz.options.acceptedFiles.split(',').map(type => type.trim()) : ['.gif', '.jpg', '.jpeg', '.png', '.svg', '.webp', '.heic'];
        //             let acceptedFileTypes = dz.options.acceptedFiles;
        //             $('.supported_ .invalid-file').empty();

        //             let file = dz.files[0];
        //             if(file)
        //                 console.log(file.type);

        //             if (dz.files.length > 0) {
        //                 let file = dz.files[0];
        //                 if (file.size <= maxFileSize && acceptedFileTypes.includes(file.type)) {
        //                     uploadButton.prop("disabled", false);
        //                 } else {
        //                     let errorMessage = [];
        //                     let errorMessages = '<ul>';
        //                     if (file.size > maxFileSize) {
        //                         errorMessage.push("File size exceeds the maximum limit.");
        //                     }
        //                     if(!(acceptedFileTypes.includes(file.type))) {
        //                         $('.supported_ .invalid-file').empty();
        //                         $('.dz-error-message').empty();
        //                         $('.dz-success-mark').empty();
        //                         $('.dz-error-mark').empty();
        //                         $('.dz-details').empty();
        //                         $('.dz-message').show();
        //                         errorMessage.push("Invalid file type. Please select a valid file.");
        //                     } else{

        //                     }
        //                     $.each(errorMessage, function(key, errorMessage) {
        //                         errorMessages += `<li> ${errorMessage} </li>`;
        //                     });

        //                     errorMessages += '</ul>';
        //                     $('.supported_ .invalid-file').html(errorMessages);
        //                     uploadButton.prop("disabled", true);
        //                 }
        //             } else {
        //                 uploadButton.prop("disabled", true);
        //             }
        //         }



        //         uploadButton.click(function() {
        //             if (dz.files.length > 0) {
        //                 dz.processQueue();
        //             }
        //         });

        //         $("#profile_pics").on("hidden.bs.modal", function() {
        //             $("#avatar_dropzone").find(".dz-message").show();
        //             $("#profile_pics .supported_ .invalid-file").empty();
        //             dz.removeAllFiles();
        //         });
        //     }

        // });
        // // Dropzone Js Ends

    });

    // PreviewTemplate For Single File dropzone Starts
    var singleFilePreviewNode = document.querySelector("#singleFileTemplate");
    singleFilePreviewNode.id = "";
    var singleFilepreviewTemplate = singleFilePreviewNode.parentNode.innerHTML;
    singleFilePreviewNode.parentNode.removeChild(singleFilePreviewNode);
    // PreviewTemplate For Single File dropzone Starts

    // Dropzone Js For Single File Upload Starts
    function singleFileDropzone(url, params, acceptedFiles="{{ config('const.dropzone_accepted_file') }}", maxFileSize={{ config('const.dropzone_max_file_size') }}, modalId="#singleFileModal") {
        var singleFileDropzoneElement = document.querySelector("#single_file_dropzone");
        var singleFileDropzone = singleFileDropzoneElement.dropzone;
        var thumbnailMapping = {
            'application/pdf': "{{ asset('frontend/img/pdf_logo.png') }}",
            'application/msword': "{{ asset('frontend/img/doc_logo.png') }}",
            'application/vnd.openxmlformats-officedocument.wordprocessingml.document': "{{ asset('frontend/img/doc_logo.png') }}",
        };

        // If a Dropzone instance doesn't exist, create a new one
        if (!singleFileDropzone) {
            singleFileDropzone = new Dropzone(singleFileDropzoneElement, {
                url: url,
                params: params,
                uploadMultiple: false,
                maxFiles: 1,
                maxFilesize: maxFileSize,
                acceptedFiles: acceptedFiles,
                thumbnailWidth: 240,
                thumbnailHeight: 240,
                previewTemplate: singleFilepreviewTemplate,
                autoQueue: false,
                previewsContainer: "#singleFilePreview",
                clickable: "#single_file_upload_btn",
                init: function() {
                    let dz = this;

                    this.on("addedfile", function(file) {
                        if (this.files.length > 1) {
                            dz.removeFile(this.files[0]);
                        }
                    });
                }
            });
        }

        // If a Dropzone instance exists, update the old instance
        singleFileDropzone.options.url = url;
        singleFileDropzone.options.params = params;

        singleFileDropzone.on("addedfile", function(file) {
            var videoElement   = $(file.previewElement).find('video[data-dz-video]');
            var imageElement   = $(file.previewElement).find('img[data-dz-thumbnail]');
            var uploadProgress = $(file.previewElement).find('.progress');

            uploadProgress.hide();

            if (file.type.startsWith('image/')) {
                videoElement.hide();
                imageElement.show();
                singleFileDropzone.emit("thumbnail", file, file.thumbnail);
            } else if (file.type.startsWith('video/')) {
                imageElement.hide();
                videoElement.show();
                var videoUrl = URL.createObjectURL(file);
                videoElement.attr('src', videoUrl);
            } else {
                videoElement.hide();
                imageElement.show();
                var thumbnailUrl = thumbnailMapping[file.type] || "{{ asset('frontend/img/file_logo.png') }}";
                singleFileDropzone.emit("thumbnail", file, thumbnailUrl);
            }
            $('#single-file-upload-logo').hide();
            $('#singleFilePreview').removeClass('d-none');
            // $('#single_file_dropzone.cpp_wrap').addClass('uploading');
        });

        // Update the total progress bar
        singleFileDropzone.on("totaluploadprogress", function(progress) {
            // document.querySelector("#total-progress .progress-bar").style.width = progress + "%";
        });

        singleFileDropzone.on("uploadprogress", function(file, progress) {
            if (progress == 100) {
                $(file.previewElement).find('.progress').hide();
            }
        });

        singleFileDropzone.on("sending", function(file) {
            // Show the total progress bar when upload starts
            // document.querySelector("#total-progress").style.opacity = "1";
            // And disable the start button
            // file.previewElement.querySelector(".start").setAttribute("disabled", "disabled");
            $(file.previewElement).find('.progress').show();
        });

        singleFileDropzone.on("queuecomplete", function(progress) {
            // document.querySelector("#total-progress").style.opacity = "0";
            // $('#previews.files').find('.progress').hide();
            // $('#multiModal').modal('hide');

        });

        singleFileDropzone.on("removedfile", function(file) {
            if(singleFileDropzone.files.length == 0) {
                $('#single-file-upload-logo').show();
                $('#singleFilePreview').addClass('d-none');
                // $('#multi_file_dropzone.cpp_wrap').removeClass('uploading');
            }
        });

        // Setup the buttons for all transfers
        // The "add files" button doesn't need to be setup because the config
        // `clickable` has already been specified.
        document.querySelector("#upload_single_file").onclick = function() {
            singleFileDropzone.enqueueFiles(singleFileDropzone.getFilesWithStatus(Dropzone.ADDED));
        };

        // document.querySelector("#cancel_multiple_file_upload").onclick = function() {
        //     singleFileDropzone.removeAllFiles(true);
        // };

        $(modalId).on('hidden.bs.modal', function(e){
            singleFileDropzone.removeAllFiles(true);
        });

        return singleFileDropzone;
    }
    // Dropzone Js For Single File Upload Ends

    // Dropzone Js For Avatar Upload Starts
    function avatar_upload() {
        var url = "{{ route('customer.updateavatar') }}";
        var params = {
            file_type: 'image',
            _method: 'PUT',
        };
        var html = ` .gif .heic .jpeg, .jpg .png .svg .webp`;
        var acceptedFiles = "{{ config('const.dropzone_accepted_image') }}";
        var maxFileSize = {{ config('const.dropzone_max_file_size') }};
        var modal = "#companyLogoModal";

        $(modal+' .ext_').html(html);
        $(modal).modal('show');

        var dropzone = singleFileDropzone(url, params, acceptedFiles, maxFileSize, modal);

        dropzone.on("success", function(file, response) {
            $('.profile_pics > img').attr('src', response.image_link);
            $('.reg_ img').attr('src', response.image_link);
        });

        // dropzone.on("error", function(file, errorMessage, xhr) {
        //     console.log(file);
        //     console.log(errorMessage);
        //     console.log(xhr);
        // });
    }
    // Dropzone Js For Avatar Upload Ends

    $("#verify_mail").click(function(){
        $.ajax({
            url: "{{ route('customer.resend_verification_email')}}",
                    data: {'_token': "{{ csrf_token() }}"},
                    method: 'POST',
                    success: function(data){
                        alert(data);
                }});
    });
</script>
@endpush
