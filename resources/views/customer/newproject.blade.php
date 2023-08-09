@extends('layouts.app')
@push('styles')

@endpush
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
<section>
    <div class="container">
        <div class="row">
            <div class="col-md-10 offset-md-1">
                @if($errors->any())
                    <div class="alert alert-danger mt-15">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

            </div>
        </div>
    </div>
</section>
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
                                    <input type="text" class="form-control" id="forename" placeholder="Forename" name="forename" value="{{ old('forename') }}"/>
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
                            <h3>Where is it happening?</h3>
                            <div class="col-md-6">

                                {{-- <h5>Enter your postcode:</h5> --}}
                                <div class="form-check mt-3 last_ua">
                                    <input type="radio" class="form-check-input mb" id="addresstype" name="addresstype" value="1" checked />
                                    <h5>Enter your postcode:</h5>
                                </div>

                                <div class="col-md-10 post_code">
                                    <div class="form-control d-inline">
                                        <input type="text" class="col-6 mt-2" name="postcode" id="postcode" placeholder="Postcode" autocomplete="off"/>
                                        <input type="hidden" name="zipcode_selected_address_line_one" id="zipcode_selected_address_line_one" value="">
                                        <input type="hidden" name="zipcode_selected_address_line_two" id="zipcode_selected_address_line_two" value="">
                                        <input type="hidden" name="zipcode_selected_town_city" id="zipcode_selected_town_city" value="">
                                        <input type="hidden" name="zipcode_selected_county" id="zipcode_selected_county" value="">
                                        <input type="hidden" name="zipcode_selected_town" id="zipcode_selected_town" value="">
                                        <input type="hidden" name="zipcode_selected_postcode" id="zipcode_selected_postcode" value="">
                                        {{-- <a data-bs-toggle="modal" data-bs-target="#exampleModal" class="btn btn-danger col-4 pull-right">Find me</a> --}}
                                        <a class="btn btn-danger col-4 pull-right postcodefind">Find me</a>
                                    </div>
                                    <div class="form-group"><label for="postcode" class="error"></label></div>
                                    <div id="errormsg"></div>
                                    <div id="postcodelist"></div>
                                    <p id="selected_post_code_html"></p>
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
                                                    <button type="button" class="btn btn-light" onclick="Get_zipcode()">Choose</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 last_ua">
                                @if($last_project)
                                    <div class="form-check mb-2">
                                        <input type="radio" class="form-check-input mb" id="addresstype" name="addresstype" value="3" checked>
                                        <h5>Last used address</h5>
                                    </div>
                                    <p class="last_used_address">
                                        {{ !empty($last_project->projectaddress->address_line_one) ? \Str::title($last_project->projectaddress->address_line_one): '' }}{{ !empty($last_project->projectaddress->address_line_two) ?', ' . \Str::title($last_project->projectaddress->address_line_two): '' }}{{ !empty($last_project->town) ?', ' . \Str::title($last_project->town): '' }}{{ !empty($last_project->county) ?', ' . \Str::title($last_project->county) : '' }}{{ !empty($last_project->postcode) ?', ' . \Str::upper($last_project->postcode): '' }}
                                    </p>

                                @endif

                                <div class="form-check mt-3">
                                    <input type="radio" class="form-check-input mb" id="addresstype" name="addresstype" value="2"/>
                                    <h5>Or type your address</h5>
                                </div>
                                <div id="typed_address">
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
                                                <input type="text" class="form-control" id="county" placeholder="County" name="county"/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group mb-3">
                                            <input type="text" class="form-control" id="address_type_postcode" placeholder="Postcode" name="address_type_postcode"/>
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
                                <textarea name="description" class="description p-2"></textarea>
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

                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                   {{-- <a data-bs-toggle="modal" data-bs-target="#exampleModal2" class="btn btn-outline-danger btn-block"> --}}
                                   <button type="button" class="btn btn-outline-danger btn-block" onclick="upload_file()">
                                      <svg width="18" height="20" viewBox="0 0 18 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                         <path d="M17.0344 4.21564L13.2844 0.465637C13.1415 0.326345 12.9495 0.248887 12.75 0.250012H5.25C4.85218 0.250012 4.47064 0.408047 4.18934 0.689352C3.90804 0.970656 3.75 1.35219 3.75 1.75001V3.25001H2.25C1.85218 3.25001 1.47064 3.40805 1.18934 3.68935C0.908035 3.97066 0.75 4.35219 0.75 4.75001V18.25C0.75 18.6478 0.908035 19.0294 1.18934 19.3107C1.47064 19.592 1.85218 19.75 2.25 19.75H12.75C13.1478 19.75 13.5294 19.592 13.8107 19.3107C14.092 19.0294 14.25 18.6478 14.25 18.25V16.75H15.75C16.1478 16.75 16.5294 16.592 16.8107 16.3107C17.092 16.0294 17.25 15.6478 17.25 15.25V4.75001C17.2511 4.55048 17.1737 4.35851 17.0344 4.21564ZM12.75 18.25H2.25V4.75001H9.44062L12.75 8.05939V18.25ZM15.75 15.25H14.25V7.75001C14.2511 7.55048 14.1737 7.35851 14.0344 7.21564L10.2844 3.46564C10.1415 3.32635 9.94954 3.24889 9.75 3.25001H5.25V1.75001H12.4406L15.75 5.05939V15.25ZM10.5 12.25C10.5 12.4489 10.421 12.6397 10.2803 12.7803C10.1397 12.921 9.94891 13 9.75 13H5.25C5.05109 13 4.86032 12.921 4.71967 12.7803C4.57902 12.6397 4.5 12.4489 4.5 12.25C4.5 12.0511 4.57902 11.8603 4.71967 11.7197C4.86032 11.579 5.05109 11.5 5.25 11.5H9.75C9.94891 11.5 10.1397 11.579 10.2803 11.7197C10.421 11.8603 10.5 12.0511 10.5 12.25ZM10.5 15.25C10.5 15.4489 10.421 15.6397 10.2803 15.7803C10.1397 15.921 9.94891 16 9.75 16H5.25C5.05109 16 4.86032 15.921 4.71967 15.7803C4.57902 15.6397 4.5 15.4489 4.5 15.25C4.5 15.0511 4.57902 14.8603 4.71967 14.7197C4.86032 14.579 5.05109 14.5 5.25 14.5H9.75C9.94891 14.5 10.1397 14.579 10.2803 14.7197C10.421 14.8603 10.5 15.0511 10.5 15.25Z" fill="#EE5719"/>
                                      </svg>
                                      Upload files
                                   </button>
                                   </a>
                                </div>
                             </div>
                            <div class="pv_top mt-4 d-flex align-items-start flex-wrap" id="getfilesformdb">
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
                                      <div class="form-group">
                                        <input type="text" name="contact_mobile_no" class="form-control col-md-10" placeholder="Mobile" id="contact_mobile_no"/>
                                        <label for="contact_mobile_no" generated="true" class="error"></label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <input type="text" name="contact_home_phone" class="form-control" id="contact_home_phone" placeholder="Home phone" />
                                            <label for="contact_home_phone" generated="true" class="error"></label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <input type="email" name="contact_email" class="form-control mb-0" id="contact_email" placeholder="Email" />
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
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Capture video</h5>
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
                                <button class="btn btn-outline-danger mt-3"  id='gUMbtn'>Request Stream</button>
                            </div>
                            <div id='btns' style="display: none;">
                                <button  class="btn btn-outline-danger mt-3" id='start'>Start</button>
                                <button  class="btn btn-outline-danger mt-3" id='stop'>Stop</button>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                      <ul class="list-unstyled" id='video-captutes'></ul>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-light" type="button" id="upload_video">Upload</button>
                    <button type="button" class="btn btn-link btn-close" data-bs-dismiss="modal" id="close_video_modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <!-- The Modal Upload Video file END-->

    <!-- The Modal Upload Photo file-->
    <div class="modal fade select_address" id="exampleModal4" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
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
                <form id="capturephoto">
                  @csrf
                  <div class="modal-body">
                    {{-- <form method="POST" action="{{ route('capture-photo') }}" enctype="multipart/form-data"> --}}
                    <div id="my_camera"></div>
                    <input type="button" class="btn btn-outline-danger" value="Take Snapshot" onClick="take_snapshot()">
                    <input type="hidden" name="image_count" id="image_count" class="image-tag">
                    <div id="results" class="row"></div>
                  </div>
                  <div class="modal-footer">
                    {{-- <button class="btn btn-danger">Submit</button> --}}
                    <button class="btn btn-light" type="submit">Upload</button>
                    <button type="button" class="btn btn-link btn-close" data-bs-dismiss="modal" id="close_image_modal">Close</button>
                  </div>
                </form>
              </div>
            </div>
    </div>
    <!-- The Modal Upload Photo file END-->


    <!-- The Modal Upload files-->
    {{-- <div class="modal fade select_address" id="exampleModal2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Upload files</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <svg width="19" height="19" viewBox="0 0 19 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M2.26683 18.5416L0.458496 16.7333L7.69183 9.49992L0.458496 2.26659L2.26683 0.458252L9.50016 7.69159L16.7335 0.458252L18.5418 2.26659L11.3085 9.49992L18.5418 16.7333L16.7335 18.5416L9.50016 11.3083L2.26683 18.5416Z" fill="black"/>
                    </svg>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6 supported_">
                    <h4>Supported file type list:</h4>
                    <h6><strong>Images:</strong> .gif .heic .jpeg, .jpg .png .svg .webp</h6>
                    <h6><strong>Documents:</strong> .doc, .docx .key .odt .pdf .ppt, .pptx, .pps, .ppsx .xls, .xlsx</h6>
                    <h6><strong>Audio:</strong> .mp3 .m4a .ogg .wav</h6>
                    <h6><strong>Video:</strong> .avi .mpg .mp4, .m4v .mov .ogv .vtt .wmv .3gp .3g2</h6>
                    </div>
                    <div class="col-md-6">
                        <form method="post" action="{{route('dropzonesave')}}" enctype="multipart/form-data" class="dropzone" id="dropzone">
                            @csrf
                            <div class="text-center upload_wrap dz-message">
                                <img src="{{ asset('frontend/img/upload.svg') }}" alt="">
                                <p>Drag and drop files here</p>
                                <h4>OR</h4>
                                <button type="button" id="file_upload_btn" class="btn btn-light mt-3" style="width:180px;">Browse files</button>
                            </div>
                        </form>
                        <div class='invalid-file'></div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-link" data-bs-dismiss="modal">Cancel</button>
                <button type="button" id="uploadfiles" class="btn btn-light">Upload</button>
            </div>
        </div>
        </div>
    </div> --}}
    <!-- The Modal Upload files END-->

    {{-- Multiple File Upload Image Modal Starts --}}
    <div class="modal fade select_address" id="multiModal" tabindex="-1" aria-labelledby="multiModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="multiModalLabel">Upload files</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <svg width="19" height="19" viewBox="0 0 19 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M2.26683 18.5416L0.458496 16.7333L7.69183 9.49992L0.458496 2.26659L2.26683 0.458252L9.50016 7.69159L16.7335 0.458252L18.5418 2.26659L11.3085 9.49992L18.5418 16.7333L16.7335 18.5416L9.50016 11.3083L2.26683 18.5416Z" fill="black"/>
                    </svg>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                    <div class="col-md-6 supported_">
                        <h4>Supported file type list:</h4>
                        <div class="accepted-file-list"></div>
                        <h6><strong>Maximum file size:</strong> {{ config('const.dropzone_max_file_size') }} MB</h6>
                    </div>
                    <div class="col-md-6">
                        <form method="post" enctype="multipart/form-data" id="multi_file_dropzone" class="dropzone text-center upload_wrap cpp_wrap">
                            @csrf
                            <div class="dz-default dz-message" id="file-upload-logo">
                                <img src="{{ asset('frontend/img/upload.svg') }}" alt="" />
                            </div>

                            <div class="files d-none" id="previews">
                                <div id="template" class="dz-image-preview">
                                    <div class="card">
                                        <img class="card-img rectangle-img" data-dz-thumbnail />
                                        <video class="rectangle-video" data-dz-video></video>
                                        <div class="card-img-overlay">
                                            <div class="progress progress-bar-striped active center-progress" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0">
                                                <div class="progress-bar bg-success" style="width:0%;" data-dz-uploadprogress></div>
                                            </div>
                                        </div>
                                    </div>

                                    <div>
                                        <small class="error text-danger" data-dz-errormessage></small>
                                    </div>
                                    <div>
                                        <button data-dz-remove class="btn text-orange delete">
                                            <span>Delete</span>
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <div>
                                <p>Drag and drop files here</p>
                                <h4>OR</h4>
                                <button type="button" id="multi_file_upload_btn" class="btn btn-light mt-3" style="width: 180px;">Browse files</button>
                            </div>
                        </form>
                    </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-link" data-bs-dismiss="modal" id="cancel_multiple_file_upload">Cancel</button>
                    <button type="button" class="btn btn-light" id="upload_multiple_file">Upload</button>
                </div>
            </div>
        </div>
    </div>
    {{-- Multiple File Upload Image Modal Ends--}}

    <!-- Delete Image Modal -->
    <div class="modal fade select_address" id="Delete_wp" tabindex="-1" aria-labelledby="deleteImageModal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body text-center p-5">
                <svg width="73" height="73" viewBox="0 0 73 73" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M36.5 0C29.281 0 22.2241 2.14069 16.2217 6.15136C10.2193 10.162 5.54101 15.8625 2.77841 22.532C0.0158149 29.2015 -0.707007 36.5405 0.701354 43.6208C2.10971 50.7011 5.586 57.2048 10.6906 62.3094C15.7952 67.414 22.2989 70.8903 29.3792 72.2986C36.4595 73.707 43.7984 72.9842 50.4679 70.2216C57.1374 67.459 62.838 62.7807 66.8486 56.7783C70.8593 50.7759 73 43.719 73 36.5C72.9907 26.8224 69.1422 17.5439 62.2991 10.7009C55.4561 3.8578 46.1776 0.00929194 36.5 0ZM36.5 67.3846C30.3916 67.3846 24.4204 65.5732 19.3414 62.1796C14.2625 58.786 10.3039 53.9624 7.96635 48.319C5.62877 42.6756 5.01715 36.4657 6.20884 30.4747C7.40053 24.4837 10.342 18.9806 14.6613 14.6613C18.9806 10.342 24.4837 7.40051 30.4747 6.20882C36.4657 5.01713 42.6756 5.62875 48.319 7.96633C53.9625 10.3039 58.786 14.2625 62.1796 19.3414C65.5733 24.4204 67.3846 30.3916 67.3846 36.5C67.3753 44.6882 64.1184 52.5385 58.3285 58.3284C52.5385 64.1184 44.6883 67.3753 36.5 67.3846ZM40.7115 54.75C40.7115 55.583 40.4645 56.3972 40.0018 57.0898C39.539 57.7824 38.8812 58.3222 38.1117 58.6409C37.3421 58.9597 36.4953 59.0431 35.6784 58.8806C34.8614 58.7181 34.111 58.317 33.522 57.728C32.933 57.139 32.5319 56.3886 32.3694 55.5716C32.2069 54.7547 32.2903 53.9079 32.6091 53.1383C32.9278 52.3687 33.4676 51.711 34.1602 51.2482C34.8528 50.7855 35.667 50.5384 36.5 50.5384C37.617 50.5384 38.6882 50.9822 39.478 51.772C40.2678 52.5618 40.7115 53.633 40.7115 54.75ZM49.1346 29.4808C49.1346 32.3437 48.1623 35.1218 46.3769 37.3599C44.5916 39.5979 42.0991 41.1633 39.3077 41.7995V42.1154C39.3077 42.86 39.0119 43.5742 38.4853 44.1007C37.9588 44.6273 37.2447 44.9231 36.5 44.9231C35.7554 44.9231 35.0412 44.6273 34.5147 44.1007C33.9881 43.5742 33.6923 42.86 33.6923 42.1154V39.3077C33.6923 38.563 33.9881 37.8489 34.5147 37.3223C35.0412 36.7958 35.7554 36.5 36.5 36.5C37.8883 36.5 39.2454 36.0883 40.3997 35.317C41.554 34.5458 42.4537 33.4495 42.9849 32.1669C43.5162 30.8843 43.6552 29.473 43.3844 28.1114C43.1135 26.7498 42.445 25.4991 41.4634 24.5174C40.4817 23.5358 39.231 22.8672 37.8694 22.5964C36.5078 22.3256 35.0965 22.4646 33.8139 22.9958C32.5313 23.5271 31.435 24.4268 30.6637 25.5811C29.8924 26.7354 29.4808 28.0925 29.4808 29.4808C29.4808 30.2254 29.185 30.9396 28.6584 31.4661C28.1319 31.9926 27.4177 32.2885 26.6731 32.2885C25.9284 32.2885 25.2143 31.9926 24.6877 31.4661C24.1612 30.9396 23.8654 30.2254 23.8654 29.4808C23.8654 26.1299 25.1965 22.9162 27.566 20.5467C29.9354 18.1773 33.1491 16.8461 36.5 16.8461C39.8509 16.8461 43.0646 18.1773 45.434 20.5467C47.8035 22.9162 49.1346 26.1299 49.1346 29.4808Z" fill="#061A48"/>
                    </svg>
                    <h5>Delete</h5>
                    <p>Are you sure you want to permanently delete this item?</p>
                    <h4 class="text-danger"></h4>
                </div>
                <div class="modal-footer justify-content-center">
                    <button type="button" class="btn btn-light" id="confirmedDelete">Yes</button>
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">No</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Delete Image Modal END -->

    {{-- Success Modal Starts --}}
    <div class="modal fade select_address" id="success_modal" tabindex="-1" aria-labelledby="successLabelModal" aria-hidden="true">
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
                    <h5>Success</h5>
                    <p>{{ session()->get('message') }}</p>
                </div>
                <div class="modal-footer justify-content-center">
                    <button type="button" class="btn btn-light" data-dismiss="modal">Ok</button>
                </div>
            </div>
        </div>
    </div>
    {{-- Success Modal Ends--}}

</section>
<!--Code area end-->

@push('scripts')

<script src="{{ asset('frontend/dropzone/dropzone.js') }}"></script>
<script src="{{ asset('frontend/webcamjs/webcam.min.js') }}"></script>
<script src="{{ asset('frontend/webcamjs/video.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="{{ asset('frontend/js/utils.js') }}"></script>

<script language="JavaScript">

    var currentFile = null;

    $('#uploadfiles').click(function(){
        myDropzone.processQueue();
        $(file.previewElement).find(".dz-error-mark, .dz-success-mark, .dz-error-message, .dz-progress").css("display", "none");
    });

    function Get_zipcode(){
        // var zipcode = $('input[name="zipcode"]:checked').val();
        // $("#zipcode_selected").attr('value',zipcode);
        // $("#selected_post_code_html").html(zipcode);
        // $('#exampleModal').modal('toggle');

        var zipcode = $('input[name="zipcode"]:checked').val();
        var county = $('input[name="zipcode"]:checked').attr('data-county');
        var town = $('input[name="zipcode"]:checked').attr('data-town');
        $("#zipcode_selected_address_line_one").attr('value', zipcode.split(",")[0]);
        $("#zipcode_selected_address_line_two").attr('value', zipcode.split(",")[1]);
        $("#zipcode_selected_town_city").attr('value', zipcode.split(",")[2]+','+ zipcode.split(",")[3]);
        $("#zipcode_selected_county").val(county);
        $("#zipcode_selected_town").val(town);
        $("#zipcode_selected_postcode").val($("#postcode").val());

        $("#selected_post_code_html").html(zipcode);
        $('#exampleModal').modal('toggle');
    }

    gUMbtn1 = id('gUMbtn1'),
    gUMbtn1.onclick = e => {
      var constraints = { audio: true, video: true };
      navigator.mediaDevices.getUserMedia(constraints)
      .then(function(mediaStream) {
        Webcam.set({
            width: 450,
            height: 350,
            image_format: 'jpeg',
            jpeg_quality: 100
        });
        Webcam.attach( '#my_camera' );
      })
      .catch(function (err) {
            Swal.fire({
                title: 'Camera and Microphone Access Required',
                html: `<small>Please close other apps using them and grant permission to proceed.</small>`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Grant Permission',
                cancelButtonText: 'Deny',
            }).then(function (result) {
                if (result.isConfirmed) {
                    navigator.mediaDevices.getUserMedia(constraints)
                    .then(function (mediaStream) {
                        Webcam.set({
                            width: 450,
                            height: 350,
                            image_format: 'jpeg',
                            jpeg_quality: 100
                        });
                        Webcam.attach('#my_camera');
                    })
                    .catch(function (err) {
                        $('#exampleModal4').modal('hide');
                        Swal.fire('Error', 'Failed to access webcam and microphone.', 'error');
                    });
                } else {
                    $('#exampleModal4').modal('hide');
                    Swal.fire('Permission Denied', 'You have denied access to your webcam and microphone.', 'error');
                }
            });
        });
    }
    let imagesArray = []
    function take_snapshot() {
      Webcam.snap( function(data_uri) {
        //$(".image-tag").val(data_uri);
        imagesArray.push(data_uri)
        //document.getElementById('results').innerHTML = '<img src="'+data_uri+'" class="rounded"/>';
      } );
      const form  = document.getElementById('capturephoto');
      var formData = new FormData(form);
      formData.append('image_count',  imagesArray.length);
      for (let i = 0; i < imagesArray; i++) {
        formData.append('image_' + i, imagesArray[i]);
      }
      displayImages()
    }
    function displayImages() {
      let images = ""
      output=document.getElementById('results')
      for (i = 0; i < imagesArray.length; i++){
        images += `<div class="col-4 col-sm-6 col-md-4 mt-2 image">
          <img src="${imagesArray[i]}" alt="image" class="rounded">
          <input type="hidden" name="image_${i}" class="image-tag" value="${imagesArray[i]}">
          <div class="capture-image-level">Image Capture ${i+1}
            <span class="capture-image-delete" onclick="deleteImage(${i})">&times;</span>
          </div>
        </div>`
      }
      output.innerHTML = images
      $("#image_count").val(imagesArray.length);
    }
    function deleteImage(index) {
      imagesArray.splice(index, 1)
      displayImages()
    }

    gUMbtn2 = id('gUMbtn2'),
    gUMbtn2.onclick = e => {
        var constraints = { audio: true, video: true };
        navigator.mediaDevices.getUserMedia(constraints)
        .then(function(mediaStream) {
            Webcam.set({
                width: 450,
                height: 350,
                image_format: 'jpeg',
                jpeg_quality: 90
            });
            Webcam.attach( '#my_camera_video' );
            $("#gUMbtn").click();
        })
        .catch(function (err) {
            Swal.fire({
                title: 'Camera and Microphone Access Required',
                html: `<small>Please close other apps using them and grant permission to proceed.</small>`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Grant Permission',
                cancelButtonText: 'Deny',
            }).then(function (result) {
                if (result.isConfirmed) {
                    navigator.mediaDevices.getUserMedia(constraints)
                    .then(function (mediaStream) {
                        Webcam.set({
                            width: 450,
                            height: 350,
                            image_format: 'jpeg',
                            jpeg_quality: 100
                        });
                        Webcam.attach('#my_camera_video');
                    })
                    .catch(function (err) {
                        $('#exampleModal3').modal('hide');
                        Swal.fire('Error', 'Failed to access webcam and microphone.', 'error');
                    });
                } else {
                    $('#exampleModal3').modal('hide');
                    Swal.fire('Permission Denied', 'You have denied access to your webcam and microphone.', 'error');
                }
            });
        }); // always check for errors at the end.
    }


    $(document).ready(function(){
        @if(session()->has('message'))
            $('#success_modal').modal('show');
        @endif

        $('.postcodefind').on('click', function () {
            $postcode = $("#postcode").val();
            if($postcode !=''){
                $.ajax({
                    //url: 'https://api.getAddress.io/find/'+$postcode+'?api-key=',
                    url: 'https://api.getAddress.io/find/'+$postcode+'?api-key=8IiS7wYTGUGowt0cbGIWeA37601&expand=true',
                    success: function(data){
                        var  addresshtml ='';
                        var counter = 1;
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

                            addresshtml += `<div class='form-check target'><input type='radio' class='form-check-input' id='radio${counter}' name='zipcode' value='${fulladdress}' data-county='${value.county}' data-town='${value.town_or_city}' /><label for='radio${counter}'>${fulladdress}</label></div>`;
                            counter++;
                        });
                        $(".zipcode-modal-header").html('<h5 class="modal-title" id="exampleModalLabel">Select your address<span>Postcode: '+$postcode+'</span></h5><button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><svg width="19" height="19" viewBox="0 0 19 19" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M2.26683 18.5416L0.458496 16.7333L7.69183 9.49992L0.458496 2.26659L2.26683 0.458252L9.50016 7.69159L16.7335 0.458252L18.5418 2.26659L11.3085 9.49992L18.5418 16.7333L16.7335 18.5416L9.50016 11.3083L2.26683 18.5416Z" fill="black"/></svg></button>');
                        $(".zipcode-modal-body").html('<div class="wrap"><div class="search"><button type="submit" class="searchButton"><svg width="19" height="20" viewBox="0 0 19 20" fill="none" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" clip-rule="evenodd" d="M8.59174 2.00025C7.01698 2.00025 5.50672 2.68507 4.3932 3.90406C3.27968 5.12305 2.65411 6.77635 2.65411 8.50025C2.65411 10.2242 3.27968 11.8775 4.3932 13.0964C5.50672 14.3154 7.01698 15.0003 8.59174 15.0003C10.1665 15.0003 11.6768 14.3154 12.7903 13.0964C13.9038 11.8775 14.5294 10.2242 14.5294 8.50025C14.5294 6.77635 13.9038 5.12305 12.7903 3.90406C11.6768 2.68507 10.1665 2.00025 8.59174 2.00025ZM0.827148 8.50025C0.827254 7.14485 1.12345 5.80912 1.69102 4.60451C2.25859 3.3999 3.08109 2.36135 4.08988 1.57549C5.09867 0.789633 6.2645 0.279263 7.49012 0.0869618C8.71573 -0.10534 9.96558 0.0260029 11.1354 0.470032C12.3052 0.914061 13.3611 1.6579 14.2149 2.63949C15.0687 3.62108 15.6957 4.81196 16.0435 6.11277C16.3914 7.41358 16.4501 8.7866 16.2147 10.1173C15.9792 11.448 15.4565 12.6977 14.6901 13.7623L18.0262 17.4143C18.1926 17.6029 18.2846 17.8555 18.2826 18.1177C18.2805 18.3799 18.1844 18.6307 18.015 18.8161C17.8457 19.0015 17.6166 19.1066 17.377 19.1089C17.1375 19.1112 16.9068 19.0104 16.7345 18.8283L13.3985 15.1763C12.2535 16.1642 10.8776 16.7794 9.42823 16.9514C7.97884 17.1233 6.5145 16.8451 5.20281 16.1485C3.89112 15.4519 2.78506 14.3651 2.01123 13.0126C1.2374 11.66 0.827051 10.0962 0.827148 8.50025ZM7.67826 5.00025C7.67826 4.73504 7.7745 4.48068 7.94581 4.29315C8.11712 4.10561 8.34947 4.00025 8.59174 4.00025C9.68195 4.00025 10.7275 4.47436 11.4984 5.31827C12.2693 6.16219 12.7024 7.30678 12.7024 8.50025C12.7024 8.76547 12.6062 9.01982 12.4348 9.20736C12.2635 9.3949 12.0312 9.50025 11.7889 9.50025C11.5466 9.50025 11.3143 9.3949 11.143 9.20736C10.9717 9.01982 10.8754 8.76547 10.8754 8.50025C10.8754 7.83721 10.6348 7.20133 10.2066 6.73249C9.77828 6.26365 9.19741 6.00025 8.59174 6.00025C8.34947 6.00025 8.11712 5.8949 7.94581 5.70736C7.7745 5.51982 7.67826 5.26547 7.67826 5.00025Z" fill="#6D717A"/></svg></button><input type="text" id="Search" onkeyup="Searchpostcode()"  class="searchTerm" placeholder="Search your address"></div></div><div class="div_checked">'+addresshtml+'<div>');
                        $("#exampleModal").modal('show');
                        return false;

                    },
                    error: function (error) {
                        //alert(error.responseText);
                        if(error.status == 400){
                            Swal.fire({
                                icon: 'warning',
                                title: 'Bad Request: Invalid postcode!!',
                                showConfirmButton: false,
                                timer: 2000
                            });
                            $("#postcode").val('');
                        }
                    }
                });
                return false;
            }else{
                Swal.fire({
                    icon: 'warning',
                    title: 'Enter your postcode.!!',
                    showConfirmButton: false,
                    timer: 2000
                });
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



    // function Searchpostcode() {
    //     var input = document.getElementById("Search");
    //     var filter = input.value.toLowerCase();
    //     var nodes = document.getElementsByClassName('target');

    //     for (i = 0; i < nodes.length; i++) {
    //         if (nodes[i].innerText.toLowerCase().includes(filter)) {
    //             nodes[i].style.display = "block";
    //         } else {
    //             nodes[i].style.display = "none";
    //         }
    //     }
    // }

    function Searchpostcode() {
        var filter = $('#Search').val().trim().toLowerCase();
        $('.target').each(function () {
            var label = $(this).children('label').text().toLowerCase();
            $(this).toggle(label.includes(filter));
        });
    }

    // $('#summernote').summernote({
    //     //placeholder: 'FixMyBuild',
    //     tabsize: 2,
    //     height: 200
    // });
     FetchfilesData();
    //setInterval(function() { FetchfilesData(); }, 5000);
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
        // var result = confirm("Are you sure you want to delete?");
        // if (result==true) {
            $.ajax({
                type:'POST',
                url:'{{ route("customer.deletecustomermediafiles") }}',
                data:{deleteid:deleteid,_token: '{{csrf_token()}}'},
                // success:function(result){
                //     alert('Record deleted successfully!');
                //     return false;
                // },
                success: function (data) {
                    FetchfilesData();
                },
            });
        // } else {
        //     return false;
        // }
    }

    function confirmDeletePopup(file, divId){
        $('#Delete_wp').modal('show');
        $('#confirmedDelete').on('click', function() {
            deletetempmediafile(file);
            $('#Delete_wp').modal('hide');
        });
    }

    Dropzone.autoDiscover = false;

    // PreviewTemplate For Multiple File dropzone Starts
    var previewNode = document.querySelector("#template");
    previewNode.id = "";
    var previewTemplate = previewNode.parentNode.innerHTML;
    previewNode.parentNode.removeChild(previewNode);
    // PreviewTemplate For Multiple File dropzone Ends

    // Dropzone Js For Multiple File Upload Starts
    function callDropzone(
        {
            url,
            params,
            acceptedFiles="{{ config('const.dropzone_accepted_file') }}",
            maxFileSize={{ config('const.dropzone_max_file_size') }},
            parallelUploads={{ config('const.dropzone_parallel_file_upload') }},
            maxFiles={{ config('const.dropzone_max_file_upload') }}
        }
    ) {
        var multiFileDropzoneElement = document.querySelector("#multi_file_dropzone");
        // var multiFileDropzone = multiFileDropzoneElement.dropzone;
        var thumbnailMapping = {
            'application/pdf': "{{ asset('frontend/img/pdf_logo.png') }}",
            'application/msword': "{{ asset('frontend/img/doc_logo.png') }}",
            'application/vnd.openxmlformats-officedocument.wordprocessingml.document': "{{ asset('frontend/img/doc_logo.png') }}",
        };

        // If a Dropzone instance doesn't exist, create a new one
        if (typeof multiFileDropzone === "undefined") {
            multiFileDropzone = new Dropzone(multiFileDropzoneElement, {
                url: url,
                params: params,
                maxFilesize: maxFileSize,
                acceptedFiles: acceptedFiles,
                thumbnailWidth: 100,
                thumbnailHeight: 69,
                previewTemplate: previewTemplate,
                uploadMultiple: true,
                parallelUploads: parallelUploads,
                maxFiles: maxFiles,
                autoQueue: false,
                previewsContainer: "#previews",
                clickable: "#multi_file_upload_btn",
            });
        }

        // If a Dropzone instance exists, update the old instance
        multiFileDropzone.options.url             = url;
        multiFileDropzone.options.params          = params;
        multiFileDropzone.options.acceptedFiles   = acceptedFiles;
        multiFileDropzone.options.maxFileSize     = maxFileSize;
        multiFileDropzone.options.parallelUploads = parallelUploads;
        multiFileDropzone.options.maxFiles        = maxFiles;

        multiFileDropzone.on("addedfile", function(file) {
            var videoElement   = $(file.previewElement).find('video[data-dz-video]');
            var imageElement   = $(file.previewElement).find('img[data-dz-thumbnail]');
            var uploadProgress = $(file.previewElement).find('.progress');

            uploadProgress.hide();

            if (file.type.startsWith('image/')) {
                videoElement.hide();
                imageElement.show();
                multiFileDropzone.emit("thumbnail", file, file.thumbnail);
            } else if (file.type.startsWith('video/')) {
                imageElement.hide();
                videoElement.show();
                var videoUrl = URL.createObjectURL(file);
                videoElement.attr('src', videoUrl);
            } else {
                videoElement.hide();
                imageElement.show();
                var thumbnailUrl = thumbnailMapping[file.type] || "{{ asset('frontend/img/file_logo.png') }}";
                multiFileDropzone.emit("thumbnail", file, thumbnailUrl);
            }
            $('#file-upload-logo').hide();
            $('#previews').removeClass('d-none');
            $('#multi_file_dropzone.cpp_wrap').addClass('uploading');
        });

        // Update the total progress bar
        multiFileDropzone.on("totaluploadprogress", function(progress) {
            // document.querySelector("#total-progress .progress-bar").style.width = progress + "%";
        });

        multiFileDropzone.on("uploadprogress", function(file, progress) {
            if (progress == 100)
                $(file.previewElement).find('.progress').hide(1000);
            $("#upload_multiple_file").html('<i class="fa fa-circle-o-notch fa-spin"></i> Upload');
            $("#upload_multiple_file").prop('disabled', true);
        });

        multiFileDropzone.on("sending", function(file) {
            // Show the total progress bar when upload starts
            // document.querySelector("#total-progress").style.opacity = "1";
            // And disable the start button
            // file.previewElement.querySelector(".start").setAttribute("disabled", "disabled");
            $(file.previewElement).find('.progress').show();
        });

        multiFileDropzone.on("queuecomplete", function(progress) {
            // document.querySelector("#total-progress").style.opacity = "0";
            // $('#previews.files').find('.progress').hide();
            // $('#multiModal').modal('hide');
            $("#upload_multiple_file").html('Upload');
            $("#upload_multiple_file").prop('disabled', false);

        });

        multiFileDropzone.on("removedfile", function(file) {
            if(multiFileDropzone.files.length == 0) {
                $('#file-upload-logo').show();
                $('#previews').addClass('d-none');
                $('#multi_file_dropzone.cpp_wrap').removeClass('uploading');
            }
        });

        multiFileDropzone.on("successmultiple", function(file, responses) {
            $('#multiModal').modal('hide');
            multiFileDropzone.removeAllFiles(true);
        });

        multiFileDropzone.on("error", function(file, errorMessage, xhr) {
            setTimeout(() => multiFileDropzone.removeFile(file), 5000);
        });

        // Setup the buttons for all transfers
        // The "add files" button doesn't need to be setup because the config
        // `clickable` has already been specified.
        document.querySelector("#upload_multiple_file").onclick = function() {
            multiFileDropzone.enqueueFiles(multiFileDropzone.getFilesWithStatus(Dropzone.ADDED));
        };

        document.querySelector("#cancel_multiple_file_upload").onclick = function() {
            multiFileDropzone.removeAllFiles(true);
        };


        $('#multiModal').on('hidden.bs.modal', function(e){
            // multiFileDropzone.removeAllFiles(true);
        });

        return multiFileDropzone;
    }
    // Dropzone Js For Multiple File Upload Ends

    function upload_file() {
        var url = "{{ route('dropzonesave') }}";
        var params = {
            file_related_to: 'public_liability_insurance',
            media_type: 'project',
        };
        let html = `<h6><strong>Images:</strong> .gif .heic .jpeg, .jpg .png .svg .webp</h6>
                    <h6><strong>Documents:</strong> .doc, .docx .odt .pdf .ppt, .pptx .xls, .xlsx</h6>
                    <h6><strong>Audio:</strong> .mp3 .ogg .wav</h6>
                    <h6><strong>Video:</strong> .avi .mp4, .m4v .ogv .3gp .3g2</h6>`;
        var acceptedFiles = "{{ config('const.dropzone_project_file_accepted') }}";

        $('#multiModal .accepted-file-list').html(html);
        $('#multiModal').modal('show');

        var dropzone = callDropzone({url: url, params: params, acceptedFiles: acceptedFiles});

        dropzone.on("successmultiple", function(file, responses) {
            FetchfilesData();
        });

        // dropzone.on("error", function(file, errorMessage, xhr) {
        //     console.log(file);
        //     console.log(errorMessage);
        //     console.log(xhr);
        // });
    }

    function disableAddressField(addresstype = $('input[name="addresstype"]:checked').val()) {
        if(addresstype == 1) {
            $('#typed_address').hide();
            $('#typed_address input').val('');
            $('#typed_address label.error').hide();
            $('#typed_address input.error').removeClass('error');

            $('.post_code').show();

            $('.last_used_address').hide();
        }

        if(addresstype == 2) {
            $('#typed_address').show();

            $('.last_used_address').hide();

            $('#postcode').val('');
            $('#selected_post_code_html').html('');
            $('.post_code').hide();
            $('#zipcode-container input').val('');
            $('.post_code label.error').hide();
            $('.post_code input.error').removeClass('error');
        }

        if(addresstype == 3) {
            $('#typed_address').hide();
            $('#typed_address input').val('');
            $('#typed_address label.error').hide();

            $('.last_used_address').show();

            $('#postcode').val('');
            $('#selected_post_code_html').html('');
            $('.post_code').hide();
            $('#zipcode-container input').val('');
            $('.post_code label.error').hide();
            $('.post_code input.error').removeClass('error');

            $('#typed_address input.error').removeClass('error');
            $('#typed_address label.error').hide();
        }
    }

    $(document).ready(function(){
        $("form#capturephoto").submit(function(e){
            e.preventDefault();
            var success=1
            var modalId = '#'+$(this).closest('.modal').attr('id');
            // var images = document.getElementById('image');
            // var formData = new FormData(this);
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
                    //for (i = 0; i < imagesArray.length; i++){
                    var formData = new FormData($("#capturephoto")[0]);
                    $.ajax({
                      data: formData,
                      async: false,
                      url: '{{ route("capture-photo") }}',
                      type: 'POST',
                      cache: false,
                      contentType: false,
                      processData: false,
                      dataType: "json",
                      success: (response) => {
                          success='1'
                      },
                      error: (response) => {
                        console.log(response);
                        success=response
                      }
                    });
                    if(success=='1'){
                      imagesArray = [];
                      displayImages();
                      FetchfilesData();
                      $(modalId).modal('hide');
                      Swal.fire({
                            //position: 'top-end',
                            icon: 'success',
                            title: 'Image uploaded successfully.',
                            showConfirmButton: false,
                            timer: 1500
                        });
                  } else{console.log(success);}

                }
            })
        });


        disableAddressField();

        $("input[name='addresstype']").change(() => disableAddressField());

        // Phone Number Setup
        let contact_mobile_no = document.querySelector("#contact_mobile_no");
        let contact_mobile_iti = window.intlTelInput(contact_mobile_no, {
            separateDialCode: true,
            initialCountry: "gb",
        });

        // Home Phone Number Setup
        let contact_home_phone = document.querySelector("#contact_home_phone");
        let home_phone_iti = window.intlTelInput(contact_home_phone, {
            separateDialCode: true,
            initialCountry: "gb",
        });

        $("#savenewproject").validate({
            // Specify validation rules
            rules: {
                forename: {
                    required: true,
                },
                surname: {
                    required: true,
                },
                project_name: {
                    required: true,
                },
                contact_mobile_no: {
                    required: true,
                    phoneNumber: true
                },
                contact_home_phone: {
                    required: true,
                    phoneNumber: true
                },
                contact_email: {
                    required: true,
                    email: true,
                    emailDNS: true
                },
                postcode : {
                    required: {
                        depends: function(element) {
                            return $('input[name="addresstype"]:checked').val() === "1";
                        }
                    },
                    checkAddress: true,
                },
                address_line_one: {
                    required: {
                        depends: function(element) {
                            return $('input[name="addresstype"]:checked').val() === "2";
                        }
                    }
                },
                town_city: {
                    required: {
                        depends: function(element) {
                            return $('input[name="addresstype"]:checked').val() === "2";
                        }
                    }
                },
                county: {
                    required: {
                        depends: function(element) {
                            return $('input[name="addresstype"]:checked').val() === "2";
                        }
                    }
                },
                address_type_postcode: {
                    required: {
                        depends: function(element) {
                            return $('input[name="addresstype"]:checked').val() === "2";
                        }
                    }
                },
                description: {
                    required: true
                },
            },
            messages: {
                forename: {
                    required: "Please enter forename",
                },
                surname: {
                    required: "Please enter surname",
                },
                project_name: {
                    required: "Please enter project name",
                },
                contact_mobile_no: {
                    required: 'Please enter a phone number',
                    phoneNumber: 'Invalid phone number'
                },
                contact_home_phone: {
                    required: 'Please enter a phone number',
                    phoneNumber: 'Invalid phone number'
                },
                contact_email: {
                    required: "Please enter contact email",
                },
            },
            onfocusout: function(element) {
                var excludedFields = [
                    "postcode",
                    "address_line_one",
                    "town_city",
                    "county",
                    "address_type_postcode"
                ];

                if (!excludedFields.includes(element.name)) {
                    this.element(element);
                }
            },
            onkeyup: function(element) {
                if (element.name !== "postcode") {
                    this.element(element);
                }
            },
            submitHandler: function(form) {
                $('#contact_mobile_no').val(contact_mobile_iti.getNumber());
                $('#contact_home_phone').val(home_phone_iti.getNumber());
                form.submit();
            }

        });

        // Jquery Validation

        $.validator.addMethod("checkAddress", function(value, element) {
            return $("#selected_post_code_html").text().trim() !== "";
        }, "Please select an address");

        $.validator.addMethod("emailDNS", function(value, element) {
            return /[a-z0-9]+@[a-z]+\.[a-z]{2,3}/i.test(value);
        }, "Please enter a valid email address.");

        $.validator.addMethod('phoneNumber', function(value, element) {
            if (element.id == 'contact_mobile_no')
                return /[a-z]/i.test($('#contact_mobile_no').val()) ? !/[a-z]/i.test($('#contact_mobile_no').val()) : contact_mobile_iti.isValidNumber();
            return /[a-z]/i.test($('#contact_home_phone').val()) ? !/[a-z]/i.test($('#contact_home_phone').val()) : home_phone_iti.isValidNumber();
        }, 'Invalid phone number');

        $('#exampleModal').on('hide.bs.modal', function(e) {
            $('#postcode').valid();
        });
    });
</script>
@endpush
@endsection
