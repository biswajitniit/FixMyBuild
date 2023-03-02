@extends('layouts.app')

@section('content')
<!--Code area start-->
<section>
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center pt-5 fmb_titel">
                <h1>New project</h1>
                <ol class="breadcrumb mb-5">
                    <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">New project</li>
                </ol>
            </div>
        </div>
    </div>
</section>
<!--Code area end-->

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

<!--Code area start-->
<section class="pb-5">
    <div class="container">
        <form action="{{route('customer.storeproject')}}" method="post" name="savenewproject" id="savenewproject">
            @csrf
            <div class="row">
                <div class="col-md-10 offset-md-1">
                    <div class="tell_about">
                        <h3>Tell us about yourself</h3>
                        <div class="row form_wrap mt-3">
                            <div class="col-md-6">
                                <div class="form-group col-md-12">
                                    <input type="text" class="form-control" id="forename" placeholder="Forename" name="forename" value=""/>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group col-md-12">
                                    <input type="text" class="form-control" id="surname" placeholder="Surname" name="surname" value=""/>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--// END-->



            <section>
                <div class="container">
                    <div class="row">
                        <div class="col-md-12 text-center pt-5 mb-5 fmb_titel">
                            <h2>About your project</h2>
                        </div>
                    </div>
                </div>
            </section>
            <div class="row">
                <div class="col-md-10 offset-md-1">
                    <div class="white_bg mb-5">
                        <div class="row">
                            <div class="col-md-6">
                                <h3>Where is it happening?</h3>
                                <h5>Enter your postcode:</h5>
                                <div class="col-md-10 post_code">
                                    <div class="form-control d-inline">
                                        <input type="text" class="col-6" name="postcode" id="postcode" placeholder="Postcode" />
                                        {{-- <a data-bs-toggle="modal" data-bs-target="#exampleModal" class="btn btn-danger col-4 pull-right">Find me</a> --}}
                                        <a class="btn btn-danger col-4 pull-right postcodefind">Find me</a>
                                    </div>
                                    <!-- The Modal -->
                                    <!-- Modal -->
                                    <div class="modal fade select_address" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header zipcode-modal-header">

                                                </div>
                                                <div class="modal-body pt-0 zipcode-modal-body">

                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-link" data-bs-dismiss="modal">Close</button>
                                                    <button type="button" class="btn btn-light">Save</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 last_ua">
                                {{-- <div class="form-check mb-2">
                                    <input type="radio" class="form-check-input mb" id="radio1" name="choseaddresstype" value="choseexistaddress" checked />
                                    <h5>Last used address</h5>
                                </div>
                                <p>2972 Westheimer Rd. Santa Ana, Illinois 85486</p> --}}
                                <div class="form-check mt-5">
                                    <input type="radio" class="form-check-input mb" id="radio1" name="choseaddresstype" value="chosenewaddress" />
                                    <h5>Or type your address</h5>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group mb-3">
                                        <input type="text" class="form-control" id="address_line_one" placeholder="Address line 1" name="address_line_one"/>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group mb-3">
                                        <input type="text" class="form-control" id="address_line_two" placeholder="Address line 2" name="address_line_two"/>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <input type="text" class="form-control" id="town_city" placeholder="Town/City" name="town_city"/>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <input type="text" class="form-control" id="postcode" placeholder="Postcode" name="postcode"/>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--// END-->
            <div class="row">
                <div class="col-md-10 offset-md-1">
                    <div class="white_bg mb-5">
                        <div class="row">
                            <div class="col-md-12">
                                <h3>How would you like to name your project?</h3>
                            </div>
                            <div class="col-md-12 mb-4">
                                <div class="form-group">
                                    <input type="text" class="form-control" id="project_name" placeholder="Type your project name" name="project_name"/>
                                </div>
                            </div>
                            <div class="col-md-12 mb-4">
                                <h3>Describe the work required clearly so that builders can understand.</h3>
                                <p>If the style (including colors) are important please mention them explicitly to avoid confusion and
                                    unexpected costs.</p>
                                <p>If you're unsure of what to write here you might find our advice on this page useful: <a href="#" class="sugg_">Suggestions</a></p>
                            </div>
                            <div class="col-md-12 mb-4">
                                {{-- <div id="summernote"></div> --}}
                                <textarea name="description" id="summernote"></textarea>

                            </div>
                            <div class="col-md-12 mb-4">
                                <h3>Please upload at least one photo, video or design of the work to be undertaken.</h3>
                                <p>For example if you are replacing a door lock please take a photo of the existing lock.</p>
                            </div>




                            <div class="col-md-3">
                                <div class="form-group">
                                    <a data-bs-toggle="modal" data-bs-target="#exampleModal4" id="gUMbtn1" class="btn btn-outline-danger btn-block">
                                        <svg width="22" height="20" viewBox="0 0 22 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M18 6V4H16V2H18V0H20V2H22V4H20V6H18ZM2 20C1.45 20 0.979333 19.8043 0.588 19.413C0.196 19.021 0 18.55 0 18V6C0 5.45 0.196 4.97933 0.588 4.588C0.979333 4.196 1.45 4 2 4H5.15L7 2H13V4H7.875L6.05 6H2V18H18V9H20V18C20 18.55 19.8043 19.021 19.413 19.413C19.021 19.8043 18.55 20 18 20H2ZM10 16.5C11.25 16.5 12.3127 16.0627 13.188 15.188C14.0627 14.3127 14.5 13.25 14.5 12C14.5 10.75 14.0627 9.68733 13.188 8.812C12.3127 7.93733 11.25 7.5 10 7.5C8.75 7.5 7.68733 7.93733 6.812 8.812C5.93733 9.68733 5.5 10.75 5.5 12C5.5 13.25 5.93733 14.3127 6.812 15.188C7.68733 16.0627 8.75 16.5 10 16.5ZM10 14.5C9.3 14.5 8.70833 14.2583 8.225 13.775C7.74167 13.2917 7.5 12.7 7.5 12C7.5 11.3 7.74167 10.7083 8.225 10.225C8.70833 9.74167 9.3 9.5 10 9.5C10.7 9.5 11.2917 9.74167 11.775 10.225C12.2583 10.7083 12.5 11.3 12.5 12C12.5 12.7 12.2583 13.2917 11.775 13.775C11.2917 14.2583 10.7 14.5 10 14.5Z"
                                                fill="#EE5719"
                                            />
                                        </svg>
                                        Take photo
                                    </a>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <a data-bs-toggle="modal" data-bs-target="#exampleModal3" id="gUMbtn2" class="btn btn-outline-danger btn-block">
                                        <svg width="22" height="20" viewBox="0 0 22 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M18 6V4H16V2H18V0H20V2H22V4H20V6H18ZM2 20C1.45 20 0.979333 19.8043 0.588 19.413C0.196 19.021 0 18.55 0 18V6C0 5.45 0.196 4.97933 0.588 4.588C0.979333 4.196 1.45 4 2 4H5.15L7 2H13V4H7.875L6.05 6H2V18H18V9H20V18C20 18.55 19.8043 19.021 19.413 19.413C19.021 19.8043 18.55 20 18 20H2ZM10 16.5C11.25 16.5 12.3127 16.0627 13.188 15.188C14.0627 14.3127 14.5 13.25 14.5 12C14.5 10.75 14.0627 9.68733 13.188 8.812C12.3127 7.93733 11.25 7.5 10 7.5C8.75 7.5 7.68733 7.93733 6.812 8.812C5.93733 9.68733 5.5 10.75 5.5 12C5.5 13.25 5.93733 14.3127 6.812 15.188C7.68733 16.0627 8.75 16.5 10 16.5ZM10 14.5C9.3 14.5 8.70833 14.2583 8.225 13.775C7.74167 13.2917 7.5 12.7 7.5 12C7.5 11.3 7.74167 10.7083 8.225 10.225C8.70833 9.74167 9.3 9.5 10 9.5C10.7 9.5 11.2917 9.74167 11.775 10.225C12.2583 10.7083 12.5 11.3 12.5 12C12.5 12.7 12.2583 13.2917 11.775 13.775C11.2917 14.2583 10.7 14.5 10 14.5Z"
                                                fill="#EE5719"
                                            />
                                        </svg>
                                        Take video
                                    </a>
                                </div>
                                <div>
                                    <ul  class="list-unstyled" id='ul'></ul>
                                </div>
                            </div>


                            <div class="col-md-3">
                                <div class="form-group">
                                    <a href="{{ route('dropzoneupload') }}" data-bs-toggle="modal" onclick="geturldata(event)" class="btn btn-outline-danger btn-block">
                                        <svg width="18" height="20" viewBox="0 0 18 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M17.0344 4.21564L13.2844 0.465637C13.1415 0.326345 12.9495 0.248887 12.75 0.250012H5.25C4.85218 0.250012 4.47064 0.408047 4.18934 0.689352C3.90804 0.970656 3.75 1.35219 3.75 1.75001V3.25001H2.25C1.85218 3.25001 1.47064 3.40805 1.18934 3.68935C0.908035 3.97066 0.75 4.35219 0.75 4.75001V18.25C0.75 18.6478 0.908035 19.0294 1.18934 19.3107C1.47064 19.592 1.85218 19.75 2.25 19.75H12.75C13.1478 19.75 13.5294 19.592 13.8107 19.3107C14.092 19.0294 14.25 18.6478 14.25 18.25V16.75H15.75C16.1478 16.75 16.5294 16.592 16.8107 16.3107C17.092 16.0294 17.25 15.6478 17.25 15.25V4.75001C17.2511 4.55048 17.1737 4.35851 17.0344 4.21564ZM12.75 18.25H2.25V4.75001H9.44062L12.75 8.05939V18.25ZM15.75 15.25H14.25V7.75001C14.2511 7.55048 14.1737 7.35851 14.0344 7.21564L10.2844 3.46564C10.1415 3.32635 9.94954 3.24889 9.75 3.25001H5.25V1.75001H12.4406L15.75 5.05939V15.25ZM10.5 12.25C10.5 12.4489 10.421 12.6397 10.2803 12.7803C10.1397 12.921 9.94891 13 9.75 13H5.25C5.05109 13 4.86032 12.921 4.71967 12.7803C4.57902 12.6397 4.5 12.4489 4.5 12.25C4.5 12.0511 4.57902 11.8603 4.71967 11.7197C4.86032 11.579 5.05109 11.5 5.25 11.5H9.75C9.94891 11.5 10.1397 11.579 10.2803 11.7197C10.421 11.8603 10.5 12.0511 10.5 12.25ZM10.5 15.25C10.5 15.4489 10.421 15.6397 10.2803 15.7803C10.1397 15.921 9.94891 16 9.75 16H5.25C5.05109 16 4.86032 15.921 4.71967 15.7803C4.57902 15.6397 4.5 15.4489 4.5 15.25C4.5 15.0511 4.57902 14.8603 4.71967 14.7197C4.86032 14.579 5.05109 14.5 5.25 14.5H9.75C9.94891 14.5 10.1397 14.579 10.2803 14.7197C10.421 14.8603 10.5 15.0511 10.5 15.25Z"
                                                fill="#EE5719"
                                            />
                                        </svg>
                                        Upload files
                                    </a>
                                </div>
                                <div id="exampleModal2" class="modal fade" role="dialog" >
                                    <div class="modal-dialog" style="width:700px;max-width:initial;height:500px;">
                                    <!-- Modal content-->
                                        <div class="modal-content">

                                            <div class="modal-body modeldropzone">

                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6 mt-2" id="getfilesformdb">

                                {{-- <div class="d-inline mr-3">
                                    abc.doc (3MB) <a href="#"><img src="{{ asset('frontend/img/crose-btn.svg') }}" alt="" /> </a>
                                </div> --}}

                            </div>


                        </div>
                    </div>
                </div>
            </div>
            <!--// END-->
            <div class="row">
                <div class="col-md-10 offset-md-1">
                    <div class="white_bg">
                        <div class="row">
                            <div class="col-md-12">
                                <h3>How do we contact you?</h3>
                            </div>
                            <div class="col-md-12">
                                <div class="row form_wrap mt-3">
                                    <div class="col-md-4">
                                        <div class="row">

                                            <div class="col-9 pl-0"><input type="text" name="contact_mobile_no" class="form-control col-md-10" placeholder="Mobile" id="phone"/></div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <input type="text" name="contact_home_phone" class="form-control" id="" placeholder="Home phone" />
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <input type="email" name="contact_email" class="form-control" id="" placeholder="Email" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group col-md-12 mt-5 text-center">
                        <button type="submit" class="btn btn-primary">Submit now</button>
                    </div>
                </div>
            </div>
            <!--// END-->
        </form>
    </div>

    <!-- The Modal Upload Video file-->
    <div class="modal fade select_address" id="exampleModal3" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Take video</h5>
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
                            <div id="my_camera_video"></div>
                            <div id='gUMArea'>
                                {{-- <div>
                                <input type="radio" name="media" value="video" checked id='mediaVideo'>Video
                                </div> --}}
                                <button class="btn btn-warning mt-3"  id='gUMbtn'>Request Stream</button>
                            </div>
                            <div id='btns' style="display: none;">
                                <button  class="btn btn-success mt-3" id='start'>Start</button>
                                <button  class="btn btn-danger mt-3" id='stop'>Stop</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-link btn-close" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <!-- The Modal Upload Video file END-->

    <!-- The Modal Upload Photo file-->
    <div class="modal fade select_address" id="exampleModal4" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Take photo</h5>
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

                    {{-- <form method="POST" action="{{ route('capture-photo') }}" enctype="multipart/form-data"> --}}
                    <form id="capturephoto">
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div id="my_camera"></div>
                                        <input type="button" class="btn btn-warning" value="Take Snapshot" onClick="take_snapshot()">
                                        <input type="hidden" name="image" class="image-tag" >

                                    </div>
                                    <div class="col-md-6">
                                        <div id="results">Your captured image will appear here...</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 text-center">
                                {{-- <button class="btn btn-danger">Submit</button> --}}
                                <button class="btn btn-success" type="submit">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-link btn-close" data-bs-dismiss="modal">Close</button>

                </div>
            </div>
        </div>
    </div>
    <!-- The Modal Upload Photo file END-->
</section>
<!--Code area end-->

@push('scripts')


<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
<script language="JavaScript">

    gUMbtn1 = id('gUMbtn1'),
    gUMbtn1.onclick = e => {
        var constraints = { audio: true, video: true };
        navigator.mediaDevices.getUserMedia(constraints)
        .then(function(mediaStream) {
                Webcam.set({
                    width: 300,
                    height: 250,
                    image_format: 'jpeg',
                    jpeg_quality: 100
                });
                Webcam.attach( '#my_camera' );
        })
        .catch(function(err) { console.log(err.name + ": " + err.message); }); // always check for errors at the end.
    }

    function take_snapshot() {
        Webcam.snap( function(data_uri) {
            $(".image-tag").val(data_uri);
            document.getElementById('results').innerHTML = '<img src="'+data_uri+'"/>';
        } );
    }

    gUMbtn2 = id('gUMbtn2'),
    gUMbtn2.onclick = e => {
        var constraints = { audio: true, video: true };
        navigator.mediaDevices.getUserMedia(constraints)
        .then(function(mediaStream) {

                Webcam.set({
                    width: 300,
                    height: 250,
                    image_format: 'jpeg',
                    jpeg_quality: 90
                });

                Webcam.attach( '#my_camera_video' );
        })
        .catch(function(err) { console.log(err.name + ": " + err.message); }); // always check for errors at the end.
    }


    $(document).ready(function(){
        $('.postcodefind').on('click', function () {
            $postcode = $("#postcode").val();
            if($postcode !=''){
                $.ajax({
                    //url: 'https://api.getAddress.io/find/'+$postcode+'?api-key=8IiS7wYTGUGowt0cbGIWeA37601',
                    url: 'https://api.getAddress.io/find/'+$postcode+'?api-key=8IiS7wYTGUGowt0cbGIWeA37601&expand=true',
                    success: function(data){

                        var  addresshtml ='';

                        $.each(data.addresses, function(index, value) {
                            var fulladdress = '';
                            if(value.line_1 != ''){
                                fulladdress += value.line_1+', ';
                            }
                            if(value.line_2 != ''){
                                fulladdress += value.line_2+', ';
                            }
                            if(value.town_or_city != ''){
                                fulladdress += value.town_or_city+', ';
                            }
                            if(value.country != ''){
                                fulladdress += value.country;
                            }

                            addresshtml += '<div class="form-check target"><input type="radio" class="form-check-input" id="radio1" name="optradio" value="'+fulladdress+'"  />'+fulladdress+'<label class="form-check-label" for="radio1"></label></div>';
                        });
                        $(".zipcode-modal-header").html('<h5 class="modal-title" id="exampleModalLabel">Select your address<span>Postcode: '+$postcode+'</span></h5><button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><svg width="19" height="19" viewBox="0 0 19 19" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M2.26683 18.5416L0.458496 16.7333L7.69183 9.49992L0.458496 2.26659L2.26683 0.458252L9.50016 7.69159L16.7335 0.458252L18.5418 2.26659L11.3085 9.49992L18.5418 16.7333L16.7335 18.5416L9.50016 11.3083L2.26683 18.5416Z" fill="black"/></svg></button>');
                        $(".zipcode-modal-body").html('<div class="wrap"><div class="search"><button type="submit" class="searchButton"><svg width="19" height="20" viewBox="0 0 19 20" fill="none" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" clip-rule="evenodd" d="M8.59174 2.00025C7.01698 2.00025 5.50672 2.68507 4.3932 3.90406C3.27968 5.12305 2.65411 6.77635 2.65411 8.50025C2.65411 10.2242 3.27968 11.8775 4.3932 13.0964C5.50672 14.3154 7.01698 15.0003 8.59174 15.0003C10.1665 15.0003 11.6768 14.3154 12.7903 13.0964C13.9038 11.8775 14.5294 10.2242 14.5294 8.50025C14.5294 6.77635 13.9038 5.12305 12.7903 3.90406C11.6768 2.68507 10.1665 2.00025 8.59174 2.00025ZM0.827148 8.50025C0.827254 7.14485 1.12345 5.80912 1.69102 4.60451C2.25859 3.3999 3.08109 2.36135 4.08988 1.57549C5.09867 0.789633 6.2645 0.279263 7.49012 0.0869618C8.71573 -0.10534 9.96558 0.0260029 11.1354 0.470032C12.3052 0.914061 13.3611 1.6579 14.2149 2.63949C15.0687 3.62108 15.6957 4.81196 16.0435 6.11277C16.3914 7.41358 16.4501 8.7866 16.2147 10.1173C15.9792 11.448 15.4565 12.6977 14.6901 13.7623L18.0262 17.4143C18.1926 17.6029 18.2846 17.8555 18.2826 18.1177C18.2805 18.3799 18.1844 18.6307 18.015 18.8161C17.8457 19.0015 17.6166 19.1066 17.377 19.1089C17.1375 19.1112 16.9068 19.0104 16.7345 18.8283L13.3985 15.1763C12.2535 16.1642 10.8776 16.7794 9.42823 16.9514C7.97884 17.1233 6.5145 16.8451 5.20281 16.1485C3.89112 15.4519 2.78506 14.3651 2.01123 13.0126C1.2374 11.66 0.827051 10.0962 0.827148 8.50025ZM7.67826 5.00025C7.67826 4.73504 7.7745 4.48068 7.94581 4.29315C8.11712 4.10561 8.34947 4.00025 8.59174 4.00025C9.68195 4.00025 10.7275 4.47436 11.4984 5.31827C12.2693 6.16219 12.7024 7.30678 12.7024 8.50025C12.7024 8.76547 12.6062 9.01982 12.4348 9.20736C12.2635 9.3949 12.0312 9.50025 11.7889 9.50025C11.5466 9.50025 11.3143 9.3949 11.143 9.20736C10.9717 9.01982 10.8754 8.76547 10.8754 8.50025C10.8754 7.83721 10.6348 7.20133 10.2066 6.73249C9.77828 6.26365 9.19741 6.00025 8.59174 6.00025C8.34947 6.00025 8.11712 5.8949 7.94581 5.70736C7.7745 5.51982 7.67826 5.26547 7.67826 5.00025Z" fill="#6D717A"/></svg></button><input type="text" id="Search" onkeyup="Searchpostcode()"  class="searchTerm" placeholder="Search your address"></div></div><div class="div_checked">'+addresshtml+'<div>');
                        $("#exampleModal").modal('show');
                        return false;
                    }
                });
                return false;
            }else{
                alert("Before submit enter your postcode."); return false;
            }

        });



    });

    function geturldata(e){
        //alert(e.currentTarget.href);
        var result = '<iframe  width="660" height="500"  src="'+e.currentTarget.href+'" frameborder="0" marginheight="0" marginwidth="0">Loading&amp;#8230;</iframe>';
        $("#exampleModal2").modal('show');
        $(".modeldropzone").html(result);
        e.preventDefault();
    }



    function Searchpostcode() {
        var input = document.getElementById("Search");
        var filter = input.value.toLowerCase();
        var nodes = document.getElementsByClassName('target');

        for (i = 0; i < nodes.length; i++) {
            if (nodes[i].innerText.toLowerCase().includes(filter)) {
            nodes[i].style.display = "block";
            } else {
            nodes[i].style.display = "none";
            }
        }
    }

    $('#summernote').summernote({
        //placeholder: 'FixMyBuild',
        tabsize: 2,
        height: 200
    });
    setInterval(function() { FetchfilesData(); }, 5000);
    function FetchfilesData(){
        $.ajax({
            type:'POST',
            url:'{{ route("customer.getcustomermediafiles") }}',
            data:{_token: '{{csrf_token()}}'},
            success:function(result){
                $("#getfilesformdb").html(result);
            }
        });
    }
    function deletetempmediafile(deleteid){
        var result = confirm("Are you sure you want to delete?");
        if (result==true) {
            $.ajax({
                type:'POST',
                url:'{{ route("customer.deletecustomermediafiles") }}',
                data:{deleteid:deleteid,_token: '{{csrf_token()}}'},
                success:function(result){
                    alert('Record deleted successfully!');
                    return false;
                }
            });
        } else {
            return false;
        }
    }

    $(document).ready(function(){
        $("form#capturephoto").submit(function(e){
            e.preventDefault();
            var formData = new FormData(this);
            Swal.fire({
            title: 'Are you sure?',
            text: "You want to upload this image?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '{{ route("capture-photo") }}',
                        type: 'POST',
                        contentType: 'multipart/form-data',
                        cache: false,
                        contentType: false,
                        processData: false,
                        data: formData,
                        success: (response) => {
                            // success
                            Swal.fire({
                                //position: 'top-end',
                                icon: 'success',
                                title: 'Image uploaded successfully.',
                                showConfirmButton: false,
                                timer: 1500
                            })
                        },
                        error: (response) => {
                            console.log(response);
                        }
                    });
                }
            })
        });
    });

</script>
@endpush



@endsection
