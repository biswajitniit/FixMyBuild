@extends('layouts.app')

@section('content')
 <!--Code area start-->
<section>
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center pt-5 fmb_titel">
                <h1>My profile</h1>
                <ol class="breadcrumb mb-5">
                    <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Profile</li>
                </ol>
            </div>
        </div>
    </div>
</section>
<!--Code area end-->
<!--Code area start-->
<section class="pb-5">
    <div class="container">
        <div class="row">
            <div class="col-md-3 dashboard_sidebar">
                <ul>
                    <li class="active"><a href="{{ route('customer.profile') }}">Profile</a></li>
                    <li><a href="{{ route('customer.project') }}">Projects</a></li>
                    <li><a href="{{ route('customer.notifications') }}">Notifications</a></li>
                    <li><a href="{{ route('logout') }}">Logout</a></li>
                </ul>
            </div>
            <div class="col-md-9 dashboard_wrapper">
                <div class="blue-font-color mt-4 mb-5">
                    <div class="row">
                        <div class="col-md-3 profile_pics">
                            <img src="{{ asset('frontend/img/Rectangle 88.png') }}" alt="" />
                            <a href="#" data-bs-toggle="modal" data-bs-target="#profile_pics"><img src="{{ asset('frontend/img/edit-pics.svg') }}" alt="" class="edit-pics" /></a>
                            <!-- The Modal Change profile photo-->
                            <div class="modal fade select_address" id="profile_pics" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                                    <div class="text-center upload_wrap cpp_wrap">
                                                        <img src="{{ asset('frontend/img/upload.svg') }}" alt="" />
                                                        <p>Drag and drop files here</p>
                                                        <h4>OR</h4>
                                                        <button type="button" class="btn btn-light mt-3" style="width: 180px;">Browse files</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-link" data-bs-dismiss="modal">Cancel</button>
                                            <button type="button" class="btn btn-light">Upload</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- The Modal Change profile photo END-->
                        </div>
                        <div class="col-md-9">
                            <h3>
                                Jenny Wilson
                                <span>
                                    <a href="#"><img src="{{ asset('frontend/img/edit-pencil.svg') }}" alt="" /></a>
                                </span>
                            </h3>
                            <div class="row">
                                <div class="col-md-6">
                                    <h5>Email: jenny-wilson@gmail.com</h5>
                                </div>
                                <div class="col-md-6">
                                    <h5>
                                        Password: ************* <a href="#" data-bs-toggle="modal" data-bs-target="#change_pw"><img src="{{ asset('frontend/img/edit-pencil.svg') }}" alt="" /></a>
                                    </h5>
                                </div>
                                <!-- The ModalChange password-->
                                <div class="modal fade select_address" id="change_pw" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <form action="#" method="post">
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
                                                    <div class="row">
                                                        <div class="col-md-12 supported_">
                                                            <div class="row">
                                                                <div class="form-group col-md-12 pw_">
                                                                    <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Enter your current password here" />
                                                                    <em>
                                                                        <a href="#"><i class="fa fa-eye-slash"></i></a>
                                                                    </em>
                                                                </div>
                                                            </div>
                                                            <div class="input-field col-md-12">
                                                                <p class="heading3 text-left">
                                                                    <strong>Criteria:</strong>
                                                                </p>
                                                                <h6><i class="fa fa-check"></i> 8-32 character</h6>
                                                                <h6><i class="fa fa-check"></i> One upper case</h6>
                                                                <h6><i class="fa fa-check"></i> One lower case</h6>
                                                                <h6><i class="fa fa-times"></i> One special character</h6>
                                                                <h6><i class="fa fa-circle"></i> One numeric character</h6>
                                                            </div>
                                                            <div class="row">
                                                                <div class="form-group col-md-12 mt-1 pw_">
                                                                    <input type="password" class="form-control" id="exampleInputPassword1" placeholder="New password" />
                                                                    <em>
                                                                        <a href="#"><i class="fa fa-eye"></i></a>
                                                                    </em>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="form-group col-md-12 mt-3 mb-3 pw_">
                                                                    <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Confirm password" />
                                                                    <em>
                                                                        <a href="#"><i class="fa fa-eye"></i></a>
                                                                    </em>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-link" data-bs-dismiss="modal">Cancel</button>
                                                    <button type="button" class="btn btn-light">Save</button>
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
                            <input type="text" class="form-control" id="phone" placeholder="20 7278 3339 " />
                            <a href="#">Has your number changed?</a>
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
