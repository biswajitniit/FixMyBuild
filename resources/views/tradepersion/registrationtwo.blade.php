@extends('layouts.app')

@section('content')

{{-- Company Logo Upload Modal Starts --}}
<div class="modal fade select_address" id="companyLogoModal" tabindex="-1" aria-labelledby="companyModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header pb-0">
                <h5 class="modal-title" id="companyModalLabel">Upload Company Logo</h5>
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
                        {{-- <form action="{{ route('customer.updateavatar') }}" method="post" enctype="multipart/form-data" id="company_logo_dropzone" class="dropzone text-center upload_wrap cpp_wrap">
                            @csrf
                            <div class="dz-message">
                                <img src="{{ asset('frontend/img/upload.svg') }}" alt="" />
                                <p>Drag and drop a file here</p>
                                <h4>OR</h4>
                                <button type="button" id="file_upload_btn" class="btn btn-light mt-3" style="width: 180px;">Browse files</button>
                            </div>
                        </form> --}}
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
{{-- Company Logo Upload Modal Ends --}}

{{-- Public liability insurance Modal Starts --}}
{{-- <div class="modal fade select_address" id="pliModal" tabindex="-1" aria-labelledby="pliModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header pb-0">
                <h5 class="modal-title" id="pliModalLabel">Upload Files</h5>
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
                            <div class="ext_">.gif .jpeg, .jpg .png .svg .webp .pdf</div>
                        </h5>
                        <form method="post" enctype="multipart/form-data" id="pli_dropzone" class="dropzone text-center upload_wrap cpp_wrap">
                            @csrf
                            <div class="dz-message">
                                <img src="{{ asset('frontend/img/upload.svg') }}" alt="" />
                                <p>Drag and drop a file here</p>
                                <h4>OR</h4>
                                <button type="button" id="pli_upload_btn" class="btn btn-light mt-3" style="width: 180px;">Browse files</button>
                            </div>
                        </form>
                        <div class='invalid-file'></div>
                        <div class="dropzone-messages"></div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-link" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-light" id="upload_pli" disabled>Upload</button>
            </div>
        </div>
    </div>
</div> --}}
{{-- Public liability insurance Upload Modal Ends --}}

{{-- Trader Image Modal Starts --}}
{{-- <div class="modal fade select_address" id="traderImgDropzoneModal" tabindex="-1" aria-labelledby="traderImgDropzoneModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header pb-0">
                <h5 class="modal-title" id="traderImgDropzoneModalLabel">Upload Files</h5>
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
                            <div class="ext_">.gif .jpeg, .jpg .png .svg .webp .pdf</div>
                        </h5>
                        <form method="post" enctype="multipart/form-data" id="trader_img_dropzone" class="dropzone text-center upload_wrap cpp_wrap">
                            @csrf
                            <div class="dz-message">
                                <img src="{{ asset('frontend/img/upload.svg') }}" alt="" />
                                <p>Drag and drop a file here</p>
                                <h4>OR</h4>
                                <button type="button" id="trader_img_upload_btn" class="btn btn-light mt-3" style="width: 180px;">Browse files</button>
                            </div>
                        </form>
                        <div class='invalid-file'></div>
                        <div class="dropzone-messages"></div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-link" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-light" id="upload_trader_img" disabled>Upload</button>
            </div>
        </div>
    </div>
</div> --}}
{{-- Trader Image Modal Ends--}}


{{-- Trader Address Modal Starts --}}
{{-- <div class="modal fade select_address" id="traderAddressModal" tabindex="-1" aria-labelledby="traderAddressModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header pb-0">
                <h5 class="modal-title" id="traderAddressModalLabel">Upload Files</h5>
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
                            <div class="ext_">.gif .jpeg, .jpg .png .svg .webp .pdf</div>
                        </h5>
                        <form method="post" enctype="multipart/form-data" id="trader_addr_dropzone" class="dropzone text-center upload_wrap cpp_wrap">
                            @csrf
                            <div class="dz-message">
                                <img src="{{ asset('frontend/img/upload.svg') }}" alt="" />
                                <p>Drag and drop a file here</p>
                                <h4>OR</h4>
                                <button type="button" id="trader_addr_upload_btn" class="btn btn-light mt-3" style="width: 180px;">Browse files</button>
                            </div>
                        </form>
                        <div class='invalid-file'></div>
                        <div class="dropzone-messages"></div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-link" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-light" id="upload_trader_addr" disabled>Upload</button>
            </div>
        </div>
    </div>
</div> --}}
{{-- Trader Address Modal Ends--}}


{{-- Team Photos Upload Modal Starts --}}
{{-- <div class="modal fade select_address" id="teamPhotoModal" tabindex="-1" aria-labelledby="teamPhotoModal" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="teamPhotoModal">Upload files</h5>
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
                    <!-- <div class="text-center upload_wrap">
                        <img src="{{ asset('frontend/img/upload.svg') }}" alt="">
                        <p>Drag and drop files here</p>
                        <h4>OR</h4>
                        <button type="button" class="btn btn-light mt-3" style="width:180px;">Browse files</button>
                    </div> -->
                    <form action="{{ route('tradesperson.storeTeamPhoto') }}" method="post" enctype="multipart/form-data" id="team_photo_dropzone" class="dropzone text-center upload_wrap cpp_wrap">
                        @csrf
                        <div class="dz-default dz-message">
                            <img src="{{ asset('frontend/img/upload.svg') }}" alt="" />
                            <p>Drag and drop a file here</p>
                            <h4>OR</h4>
                            <button type="button" id="team_photo_upload_btn" class="btn btn-light mt-3" style="width: 180px;">Browse files</button>
                        </div>
                    </form>
                </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-link" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-light" id="upload_team_photo">Upload</button>
            </div>
        </div>
    </div>
</div> --}}
{{-- Team Photos Upload Modal Ends --}}

{{-- Previous Project Upload Modal Starts --}}
{{-- <div class="modal fade select_address" id="prevProjModal" tabindex="-1" aria-labelledby="prevProjModal" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="prevProjModal">Upload files</h5>
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
                    <!-- <div class="text-center upload_wrap">
                        <img src="{{ asset('frontend/img/upload.svg') }}" alt="">
                        <p>Drag and drop files here</p>
                        <h4>OR</h4>
                        <button type="button" class="btn btn-light mt-3" style="width:180px;">Browse files</button>
                    </div> -->
                    <form action="{{ route('tradesperson.storePrevProj') }}" method="post" enctype="multipart/form-data" id="prev_proj_dropzone" class="dropzone text-center upload_wrap cpp_wrap">
                        @csrf
                        <div class="dz-default dz-message">
                            <img src="{{ asset('frontend/img/upload.svg') }}" alt="" />
                            <p>Drag and drop a file here</p>
                            <h4>OR</h4>
                            <button type="button" id="prev_proj_upload_btn" class="btn btn-light mt-3" style="width: 180px;">Browse files</button>
                        </div>
                    </form>
                </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-link" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-light" id="upload_prev_proj">Upload</button>
            </div>
        </div>
    </div>
</div> --}}
{{-- Previous Project Upload Modal Ends --}}

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
                                    {{-- <p class="size" data-dz-size></p> --}}
                                    {{-- <div class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0">
                                        <div class="progress-bar progress-bar-success" style="width:0%;" data-dz-uploadprogress></div>
                                    </div> --}}
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

<section>
    <div class="container">
       <div class="row">
          <div class="col-md-12 text-center pt-5 fmb_titel">
             <h1>Company Registration</h1>
             <ol class="breadcrumb mb-5">
                <li class="breadcrumb-item"><a href="{{ route('home')}}">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Company Registration</li>
             </ol>
          </div>
       </div>
    </div>
</section>
 <!--Code area end-->
 <!--Code area start-->
 <section>
    <div class="container">
       <div class="row">
          <div class="col-md-12 text-center mb-5 fmb_titel">
             <h2>General information</h2>
          </div>
       </div>
    </div>
 </section>
 <section class="pb-5">
    <div class="container">
      @if($errors->any())
         <div class="alert alert-danger">
            <ul>
                  @foreach ($errors->all() as $error)
                     <li>{{ $error }}</li>
                  @endforeach
            </ul>
         </div>
      @endif

      @if(session()->has('message'))
         <div class="alert alert-success">
            {{ session()->get('message') }}
         </div>
      @endif
       <form action="{{route('tradepersion.savecompregistration')}}" method="post" id="company-general-form">
         @csrf
          <div class="row mb-5">
             <div class="col-md-10 offset-md-1">
                <div class="tell_about gen-info">
                   <div class="row">
                      <div class="col-md-10">
                         <input type="text" name="comp_reg_no" class="form-control pb-2" value="{{ old('comp_reg_no') }}" id="comp_reg_no" placeholder="Enter company registration number">
                      </div>
                      <div class="col-md-2">
                         <button type="button" onclick="findcomp()" class="btn btn-danger btn-block pull-right">Find</button>
                      </div>
                      <div id="findcomperror"></div>
                   </div>
                   <div id="serchcompres" style="display:none">
                     <div class="row mt-2">
                        <div class="col-md-4"><h5><strong>Company name: </strong></h5></div>
                        <div class="col-md-8"><h5 id="txt_comp_name"></h5></div>
                        <input type="hidden" name="comp_name" value="" id="comp_name">
                     </div>
                     <div class="row mt-2">
                           <div class="col-md-4"><h5><strong>Company address:</strong></h5></div>
                           <div class="col-md-8"><h5 id="txt_comp_address"></h5></div>
                           <input type="hidden" name="comp_address" value="" id="comp_address">
                     </div>
                     <div class="row mt-4">
                        <div class="col-md-6 text-center">
                           <img src="{{asset('frontend/img/Group 128.png')}}" alt="">
                        </div>
                        <div class="col-md-6 mt-4">
                           <h5><strong>Trading name</strong></h5>
                           <p>This name will appear on your quotes</p>
                           <div class="mt-4">
                              <input type="text" name="trader_name" class="form-control pb-2" id="" placeholder="Type your trading name" value="{{ old('trader_name') }}">
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
                      <div class="col-md-12 mb-3">
                         <h3>Describe your company</h3>
                      </div>
                      <div class="col-md-12 mb-4">
                        {{-- <textarea id="editor" name="comp_description"></textarea> --}}
                        <textarea id="summernote" name="comp_description">{{ old('comp_description') }}</textarea>
                      </div>
                      <div class="col-md-5 mb-4">
                         <h3>Upload company logo
                         </h3>
                         <p>This is optional.</p>
                         <div class="row mt-3">
                            <div class="col-md-5">
                               <div class="form-group">
                                    {{-- <a  class="btn btn-outline-danger btn-block" href="{{ route('dropzoneupload') }}" data-bs-toggle="modal" onclick="geturldata(event)"> --}}
                                    {{-- <a class="btn btn-outline-danger btn-block" href="#" data-bs-toggle="modal" data-bs-target="#companyLogoModal"> --}}
                                    <button class="btn btn-outline-danger btn-block" type="button" onclick="comp_logo_upload()">
                                        <svg width="19" height="19" viewBox="0 0 19 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M4.8418 5.55469C4.69569 5.40823 4.61364 5.2098 4.61364 5.00293C4.61364 4.79606 4.69569 4.59763 4.8418 4.45117L8.94336 0.349609C9.09148 0.202905 9.29152 0.120605 9.5 0.120605C9.70848 0.120605 9.90852 0.202905 10.0566 0.349609L14.1582 4.45117C14.3043 4.59763 14.3864 4.79606 14.3864 5.00293C14.3864 5.2098 14.3043 5.40823 14.1582 5.55469C14.0855 5.6285 13.9989 5.68712 13.9033 5.72714C13.8077 5.76715 13.7052 5.78776 13.6016 5.78776C13.498 5.78776 13.3954 5.76715 13.2998 5.72714C13.2043 5.68712 13.1176 5.6285 13.0449 5.55469L10.2812 2.79102V11.8438C10.2812 12.051 10.1989 12.2497 10.0524 12.3962C9.90592 12.5427 9.7072 12.625 9.5 12.625C9.2928 12.625 9.09409 12.5427 8.94757 12.3962C8.80106 12.2497 8.71875 12.051 8.71875 11.8438V2.79102L5.95508 5.55469C5.88238 5.6285 5.79573 5.68712 5.70017 5.72714C5.60461 5.76715 5.50204 5.78776 5.39844 5.78776C5.29484 5.78776 5.19227 5.76715 5.09671 5.72714C5.00114 5.68712 4.91449 5.6285 4.8418 5.55469ZM18.0938 11.0625C17.8865 11.0625 17.6878 11.1448 17.5413 11.2913C17.3948 11.4378 17.3125 11.6365 17.3125 11.8438V17.3125H1.6875V11.8438C1.6875 11.6365 1.60519 11.4378 1.45868 11.2913C1.31216 11.1448 1.11345 11.0625 0.90625 11.0625C0.69905 11.0625 0.500336 11.1448 0.353823 11.2913C0.20731 11.4378 0.125 11.6365 0.125 11.8438V17.3125C0.125 17.7269 0.28962 18.1243 0.582646 18.4174C0.875671 18.7104 1.2731 18.875 1.6875 18.875H17.3125C17.7269 18.875 18.1243 18.7104 18.4174 18.4174C18.7104 18.1243 18.875 17.7269 18.875 17.3125V11.8438C18.875 11.6365 18.7927 11.4378 18.6462 11.2913C18.4997 11.1448 18.301 11.0625 18.0938 11.0625Z" fill="#EE5719"/>
                                        </svg>
                                        Logo
                                    </button>
                                    {{-- </a> --}}
                               </div>

                                {{-- <div id="complogoModal" class="modal fade" role="dialog" >
                                    <div class="modal-dialog" style="width:700px;max-width:initial;height:500px;">
                                    <div class="modal-content">
                                        <div class="modal-body comlogodropzone"></div>
                                    </div>
                                    </div>
                                </div> --}}

                            </div>


                            <div class="col-md-12 mt-3" id="company_logo">
                            {{-- <img src="{{ asset('frontend/img/Rectangle-82.jpg') }}" alt=""> --}}
                            @if($temp_company_logo)
                                <img src="{{ $temp_company_logo->url }}" alt="" class="square-img" id="uploaded_company_logo" />
                                <div class="d-inline ml-2">
                                    <span id="uploaded_company_logo_details">{{ $temp_company_logo ? $temp_company_logo->filename: '' }}</span>
                                </div>
                            @endif
                            </div>
                         </div>
                      </div>
                      <div class="col-md-7 mb-4">
                         <h3>Public liability insurance
                         </h3>
                         <p>Please provide a copy of your public liability insurance documentation, including the amount of coverage and scheduled start and end dates.</p>
                         <div class="row mt-3">
                           <div class="col-md-4">
                              <div class="form-group">
                                 <a data-bs-toggle="modal" data-bs-target="#takePhotoModal" class="btn btn-outline-danger btn-block">
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
                            {{-- <div class="col-md-4">
                               <div class="form-group">
                                 <a data-bs-toggle="modal" data-bs-target="#takeVideoModal" class="btn btn-outline-danger btn-block">
                                    <svg width="22" height="20" viewBox="0 0 22 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M18 6V4H16V2H18V0H20V2H22V4H20V6H18ZM2 20C1.45 20 0.979333 19.8043 0.588 19.413C0.196 19.021 0 18.55 0 18V6C0 5.45 0.196 4.97933 0.588 4.588C0.979333 4.196 1.45 4 2 4H5.15L7 2H13V4H7.875L6.05 6H2V18H18V9H20V18C20 18.55 19.8043 19.021 19.413 19.413C19.021 19.8043 18.55 20 18 20H2ZM10 16.5C11.25 16.5 12.3127 16.0627 13.188 15.188C14.0627 14.3127 14.5 13.25 14.5 12C14.5 10.75 14.0627 9.68733 13.188 8.812C12.3127 7.93733 11.25 7.5 10 7.5C8.75 7.5 7.68733 7.93733 6.812 8.812C5.93733 9.68733 5.5 10.75 5.5 12C5.5 13.25 5.93733 14.3127 6.812 15.188C7.68733 16.0627 8.75 16.5 10 16.5ZM10 14.5C9.3 14.5 8.70833 14.2583 8.225 13.775C7.74167 13.2917 7.5 12.7 7.5 12C7.5 11.3 7.74167 10.7083 8.225 10.225C8.70833 9.74167 9.3 9.5 10 9.5C10.7 9.5 11.2917 9.74167 11.775 10.225C12.2583 10.7083 12.5 11.3 12.5 12C12.5 12.7 12.2583 13.2917 11.775 13.775C11.2917 14.2583 10.7 14.5 10 14.5Z"
                                            fill="#EE5719"
                                        />
                                    </svg>
                                    Take video
                                </a>
                               </div>
                            </div> --}}
                            <div class="col-md-4">
                               <div class="form-group">
                                 <div class="form-group">
                                    {{-- <a href="{{ route('dropzoneupload') }}" data-bs-toggle="modal" onclick="geturldataupload(event)" class="btn btn-outline-danger btn-block"> --}}
                                        {{-- <a href="#" data-bs-toggle="modal" data-bs-target="#pliModal" class="btn btn-outline-danger btn-block"> --}}
                                        <a href="javascript:void(0)" onclick="pli_upload()" class="btn btn-outline-danger btn-block">
                                        <svg width="18" height="20" viewBox="0 0 18 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M17.0344 4.21564L13.2844 0.465637C13.1415 0.326345 12.9495 0.248887 12.75 0.250012H5.25C4.85218 0.250012 4.47064 0.408047 4.18934 0.689352C3.90804 0.970656 3.75 1.35219 3.75 1.75001V3.25001H2.25C1.85218 3.25001 1.47064 3.40805 1.18934 3.68935C0.908035 3.97066 0.75 4.35219 0.75 4.75001V18.25C0.75 18.6478 0.908035 19.0294 1.18934 19.3107C1.47064 19.592 1.85218 19.75 2.25 19.75H12.75C13.1478 19.75 13.5294 19.592 13.8107 19.3107C14.092 19.0294 14.25 18.6478 14.25 18.25V16.75H15.75C16.1478 16.75 16.5294 16.592 16.8107 16.3107C17.092 16.0294 17.25 15.6478 17.25 15.25V4.75001C17.2511 4.55048 17.1737 4.35851 17.0344 4.21564ZM12.75 18.25H2.25V4.75001H9.44062L12.75 8.05939V18.25ZM15.75 15.25H14.25V7.75001C14.2511 7.55048 14.1737 7.35851 14.0344 7.21564L10.2844 3.46564C10.1415 3.32635 9.94954 3.24889 9.75 3.25001H5.25V1.75001H12.4406L15.75 5.05939V15.25ZM10.5 12.25C10.5 12.4489 10.421 12.6397 10.2803 12.7803C10.1397 12.921 9.94891 13 9.75 13H5.25C5.05109 13 4.86032 12.921 4.71967 12.7803C4.57902 12.6397 4.5 12.4489 4.5 12.25C4.5 12.0511 4.57902 11.8603 4.71967 11.7197C4.86032 11.579 5.05109 11.5 5.25 11.5H9.75C9.94891 11.5 10.1397 11.579 10.2803 11.7197C10.421 11.8603 10.5 12.0511 10.5 12.25ZM10.5 15.25C10.5 15.4489 10.421 15.6397 10.2803 15.7803C10.1397 15.921 9.94891 16 9.75 16H5.25C5.05109 16 4.86032 15.921 4.71967 15.7803C4.57902 15.6397 4.5 15.4489 4.5 15.25C4.5 15.0511 4.57902 14.8603 4.71967 14.7197C4.86032 14.579 5.05109 14.5 5.25 14.5H9.75C9.94891 14.5 10.1397 14.579 10.2803 14.7197C10.421 14.8603 10.5 15.0511 10.5 15.25Z"
                                                fill="#EE5719"
                                            />
                                        </svg>
                                        Upload files
                                    </a>
                                </div>
                                <div id="tradepersionUploadfile" class="modal fade" role="dialog" >
                                    <div class="modal-dialog" style="width:700px;max-width:initial;height:500px;">
                                    <!-- Modal content-->
                                        <div class="modal-content">

                                            <div class="modal-body modeldropzone1">

                                            </div>

                                        </div>
                                    </div>
                                </div>
                               </div>
                            </div>
                            <div class="col-md-12 mt-3" id="uploaded_pli">
                                @foreach ($temp_public_liability_insurances as $temp_public_liability_insurance)
                                    <div class="d-inline mr-3">{{ $temp_public_liability_insurance->filename }}</div>
                                @endforeach
                               {{-- <div class="d-inline mr-3">abc.doc (3MB) <a href="#"><img src="assets/img/crose-btn.svg" alt=""> </a></div> --}}
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
                <div class="white_bg">
                   <div class="row">
                      <div class="col-md-12">
                         <h3>Contact information</h3>
                         <p>Who can customers contact if they have questions about your quotes?</p>
                      </div>
                      <div class="col-md-12">
                         <div class="row form_wrap mt-3">
                            <div class="col-md-12">
                               <div class="form-group">
                                  <input type="text" name="name" class="form-control" id="" placeholder="Your name*" value="{{ old('name') }}">
                               </div>
                            </div>
                            {{-- <input type="hidden" name="phone_code" value="" id="phone_code"> --}}
                            <div class="col-md-4">
                               <input type="text" name="phone_number" class="form-control col-md-10" id="phone" placeholder="Phone" value="{{ old('phone_number') }}">
                            </div>
                            <div class="col-md-4">
                               <div class="form-group">
                                  <input type="text" name="phone_office" class="form-control" id="phone_office" placeholder="Office number" value="{{ old('phone_office') }}">
                               </div>
                            </div>
                            <div class="col-md-4">
                               <div class="form-group">
                                  <input type="email" name="email" class="form-control" id="" placeholder="Email*" value="{{ old('email') }}">
                               </div>
                            </div>
                         </div>
                      </div>
                   </div>
                   <!--// END-->
                   <div class="row mt-4">
                      <div class="col-md-12">
                         <h3>What's your role in the company?</h3>
                      </div>
                      <div class="col-md-12">
                         <div class="row form_wrap mt-3">
                            <div class="col-md-6">
                               <select class="form-control" id="company_role" name="company_role">
                                 <option value="" {{ old('company_role') == "" ? "selected" : "" }}>Select your role</option>
                                 <option value="Director" {{ old('company_role') == "Director" ? "selected" : "" }}>Director</option>
                                 <option value="Tradesperson" {{ old('company_role') == "Tradesperson" ? "selected" : "" }}>Tradesperson</option>
                                 <option value="Secretary" {{ old('company_role') == "Secretary" ? "selected" : "" }}>Secretary</option>
                                  <option value="Other" {{ old('company_role') == "Other" ? "selected" : "" }}>Other</option>
                               </select>
                            </div>
                            <div class="col-md-6" id="other_designation">
                                @if (old('designation') || old('company_role') == 'Other')
                                    <div class="form-group">
                                        <input type="text" name="designation" class="form-control" id="" placeholder="Type your role" value="{{ old('designation') }}">
                                    </div>
                                @endif
                            </div>
                         </div>
                      </div>
                   </div>
                   <div class="col-md-12 mt-4">
                      <h3>Please upload a photo identification of yourself</h3>
                      <div class="row mt-4">
                         <div class="col-md-3">
                            <div class="form-group">
                               <button type="button" class="btn btn-outline-danger btn-block">
                                  <svg width="22" height="20" viewBox="0 0 22 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                     <path d="M18 6V4H16V2H18V0H20V2H22V4H20V6H18ZM2 20C1.45 20 0.979333 19.8043 0.588 19.413C0.196 19.021 0 18.55 0 18V6C0 5.45 0.196 4.97933 0.588 4.588C0.979333 4.196 1.45 4 2 4H5.15L7 2H13V4H7.875L6.05 6H2V18H18V9H20V18C20 18.55 19.8043 19.021 19.413 19.413C19.021 19.8043 18.55 20 18 20H2ZM10 16.5C11.25 16.5 12.3127 16.0627 13.188 15.188C14.0627 14.3127 14.5 13.25 14.5 12C14.5 10.75 14.0627 9.68733 13.188 8.812C12.3127 7.93733 11.25 7.5 10 7.5C8.75 7.5 7.68733 7.93733 6.812 8.812C5.93733 9.68733 5.5 10.75 5.5 12C5.5 13.25 5.93733 14.3127 6.812 15.188C7.68733 16.0627 8.75 16.5 10 16.5ZM10 14.5C9.3 14.5 8.70833 14.2583 8.225 13.775C7.74167 13.2917 7.5 12.7 7.5 12C7.5 11.3 7.74167 10.7083 8.225 10.225C8.70833 9.74167 9.3 9.5 10 9.5C10.7 9.5 11.2917 9.74167 11.775 10.225C12.2583 10.7083 12.5 11.3 12.5 12C12.5 12.7 12.2583 13.2917 11.775 13.775C11.2917 14.2583 10.7 14.5 10 14.5Z" fill="#EE5719"/>
                                  </svg>
                                  {{-- Take photo/video --}}
                                  Take photo
                               </button>
                            </div>
                         </div>
                         <div class="col-md-3">
                            <div class="form-group">
                               {{-- <a data-bs-toggle="modal" data-bs-target="#exampleModal2" class="btn btn-outline-danger btn-block"> --}}
                               {{-- <a data-bs-toggle="modal" data-bs-target="#traderImgDropzoneModal" class="btn btn-outline-danger btn-block"> --}}
                               <button type="button" class="btn btn-outline-danger btn-block" onclick="trader_photo_id_upload()">
                                  <svg width="18" height="20" viewBox="0 0 18 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                     <path d="M17.0344 4.21564L13.2844 0.465637C13.1415 0.326345 12.9495 0.248887 12.75 0.250012H5.25C4.85218 0.250012 4.47064 0.408047 4.18934 0.689352C3.90804 0.970656 3.75 1.35219 3.75 1.75001V3.25001H2.25C1.85218 3.25001 1.47064 3.40805 1.18934 3.68935C0.908035 3.97066 0.75 4.35219 0.75 4.75001V18.25C0.75 18.6478 0.908035 19.0294 1.18934 19.3107C1.47064 19.592 1.85218 19.75 2.25 19.75H12.75C13.1478 19.75 13.5294 19.592 13.8107 19.3107C14.092 19.0294 14.25 18.6478 14.25 18.25V16.75H15.75C16.1478 16.75 16.5294 16.592 16.8107 16.3107C17.092 16.0294 17.25 15.6478 17.25 15.25V4.75001C17.2511 4.55048 17.1737 4.35851 17.0344 4.21564ZM12.75 18.25H2.25V4.75001H9.44062L12.75 8.05939V18.25ZM15.75 15.25H14.25V7.75001C14.2511 7.55048 14.1737 7.35851 14.0344 7.21564L10.2844 3.46564C10.1415 3.32635 9.94954 3.24889 9.75 3.25001H5.25V1.75001H12.4406L15.75 5.05939V15.25ZM10.5 12.25C10.5 12.4489 10.421 12.6397 10.2803 12.7803C10.1397 12.921 9.94891 13 9.75 13H5.25C5.05109 13 4.86032 12.921 4.71967 12.7803C4.57902 12.6397 4.5 12.4489 4.5 12.25C4.5 12.0511 4.57902 11.8603 4.71967 11.7197C4.86032 11.579 5.05109 11.5 5.25 11.5H9.75C9.94891 11.5 10.1397 11.579 10.2803 11.7197C10.421 11.8603 10.5 12.0511 10.5 12.25ZM10.5 15.25C10.5 15.4489 10.421 15.6397 10.2803 15.7803C10.1397 15.921 9.94891 16 9.75 16H5.25C5.05109 16 4.86032 15.921 4.71967 15.7803C4.57902 15.6397 4.5 15.4489 4.5 15.25C4.5 15.0511 4.57902 14.8603 4.71967 14.7197C4.86032 14.579 5.05109 14.5 5.25 14.5H9.75C9.94891 14.5 10.1397 14.579 10.2803 14.7197C10.421 14.8603 10.5 15.0511 10.5 15.25Z" fill="#EE5719"/>
                                  </svg>
                                  Upload file(s)
                               </button>
                            </div>
                         </div>
                         <div class="col-md-12 mt-3" id="uploaded_trader_img">
                            @foreach ($temp_trader_images as $temp_trader_img)
                                <div class="d-inline mr-3">{{ $temp_trader_img->filename }}</div>
                            @endforeach
                        </div>
                      </div>
                   </div>
                </div>
                <div class="white_bg mt-5">
                   <div class="col-md-12">
                      <h3>Please provide proof of company address</h3>
                      <p>e.g. Bank statement, bank certificate, credit card statement, statement of fees, tax letter/bill, utility bill, broadband bill, landline phone bill </p>
                      <div class="row mt-4">
                         <div class="col-md-3">
                            <div class="form-group">
                               <button type="submit" class="btn btn-outline-danger btn-block">
                                  <svg width="22" height="20" viewBox="0 0 22 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                     <path d="M18 6V4H16V2H18V0H20V2H22V4H20V6H18ZM2 20C1.45 20 0.979333 19.8043 0.588 19.413C0.196 19.021 0 18.55 0 18V6C0 5.45 0.196 4.97933 0.588 4.588C0.979333 4.196 1.45 4 2 4H5.15L7 2H13V4H7.875L6.05 6H2V18H18V9H20V18C20 18.55 19.8043 19.021 19.413 19.413C19.021 19.8043 18.55 20 18 20H2ZM10 16.5C11.25 16.5 12.3127 16.0627 13.188 15.188C14.0627 14.3127 14.5 13.25 14.5 12C14.5 10.75 14.0627 9.68733 13.188 8.812C12.3127 7.93733 11.25 7.5 10 7.5C8.75 7.5 7.68733 7.93733 6.812 8.812C5.93733 9.68733 5.5 10.75 5.5 12C5.5 13.25 5.93733 14.3127 6.812 15.188C7.68733 16.0627 8.75 16.5 10 16.5ZM10 14.5C9.3 14.5 8.70833 14.2583 8.225 13.775C7.74167 13.2917 7.5 12.7 7.5 12C7.5 11.3 7.74167 10.7083 8.225 10.225C8.70833 9.74167 9.3 9.5 10 9.5C10.7 9.5 11.2917 9.74167 11.775 10.225C12.2583 10.7083 12.5 11.3 12.5 12C12.5 12.7 12.2583 13.2917 11.775 13.775C11.2917 14.2583 10.7 14.5 10 14.5Z" fill="#EE5719"/>
                                  </svg>
                                  {{-- Take photo/video --}}
                                  Take photo
                               </button>
                            </div>
                         </div>
                         <div class="col-md-3">
                            <div class="form-group">
                               {{-- <a data-bs-toggle="modal" data-bs-target="#exampleModal2" class="btn btn-outline-danger btn-block"> --}}
                               {{-- <a href="#" data-bs-toggle="modal" data-bs-target="#traderAddressModal" class="btn btn-outline-danger btn-block"> --}}
                               <button type="button" onclick="comp_addr_proof()" class="btn btn-outline-danger btn-block">
                                  <svg width="18" height="20" viewBox="0 0 18 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                     <path d="M17.0344 4.21564L13.2844 0.465637C13.1415 0.326345 12.9495 0.248887 12.75 0.250012H5.25C4.85218 0.250012 4.47064 0.408047 4.18934 0.689352C3.90804 0.970656 3.75 1.35219 3.75 1.75001V3.25001H2.25C1.85218 3.25001 1.47064 3.40805 1.18934 3.68935C0.908035 3.97066 0.75 4.35219 0.75 4.75001V18.25C0.75 18.6478 0.908035 19.0294 1.18934 19.3107C1.47064 19.592 1.85218 19.75 2.25 19.75H12.75C13.1478 19.75 13.5294 19.592 13.8107 19.3107C14.092 19.0294 14.25 18.6478 14.25 18.25V16.75H15.75C16.1478 16.75 16.5294 16.592 16.8107 16.3107C17.092 16.0294 17.25 15.6478 17.25 15.25V4.75001C17.2511 4.55048 17.1737 4.35851 17.0344 4.21564ZM12.75 18.25H2.25V4.75001H9.44062L12.75 8.05939V18.25ZM15.75 15.25H14.25V7.75001C14.2511 7.55048 14.1737 7.35851 14.0344 7.21564L10.2844 3.46564C10.1415 3.32635 9.94954 3.24889 9.75 3.25001H5.25V1.75001H12.4406L15.75 5.05939V15.25ZM10.5 12.25C10.5 12.4489 10.421 12.6397 10.2803 12.7803C10.1397 12.921 9.94891 13 9.75 13H5.25C5.05109 13 4.86032 12.921 4.71967 12.7803C4.57902 12.6397 4.5 12.4489 4.5 12.25C4.5 12.0511 4.57902 11.8603 4.71967 11.7197C4.86032 11.579 5.05109 11.5 5.25 11.5H9.75C9.94891 11.5 10.1397 11.579 10.2803 11.7197C10.421 11.8603 10.5 12.0511 10.5 12.25ZM10.5 15.25C10.5 15.4489 10.421 15.6397 10.2803 15.7803C10.1397 15.921 9.94891 16 9.75 16H5.25C5.05109 16 4.86032 15.921 4.71967 15.7803C4.57902 15.6397 4.5 15.4489 4.5 15.25C4.5 15.0511 4.57902 14.8603 4.71967 14.7197C4.86032 14.579 5.05109 14.5 5.25 14.5H9.75C9.94891 14.5 10.1397 14.579 10.2803 14.7197C10.421 14.8603 10.5 15.0511 10.5 15.25Z" fill="#EE5719"/>
                                  </svg>
                                  Upload file(s)
                               </button>
                               {{-- </a> --}}
                            </div>
                         </div>
                      </div>
                      <div class="col-md-12 mt-3 mb-4">
                         <div class="d-inline mr-3" id="uploaded_trader_addr">
                            @foreach ($temp_comp_addresses as $addr)
                                <div class="d-inline mr-3">{{ $addr->filename }}</div>
                            @endforeach
                         </div>
                      </div>
                   </div>
                   <div class="col-md-12">
                      <h3>Is your company VAT registered?</h3>
                      <div class="form-check-inline mt-2 mb-3">
                         <label class="form-check-label">
                         <input type="radio" name="vat_reg" value="1" class="form-check-input mr-2" {{ (old('vat_reg') && old('vat_reg')==1) ? 'checked' : ''}}>Yes
                         </label>
                      </div>
                      <div class="form-check-inline mt-2 mb-2">
                         <label class="form-check-label">
                         <input type="radio" name="vat_reg" value="0" class="form-check-input mr-2" {{ (old('vat_reg') && old('vat_reg')==0) ? 'checked' : ''}}>No
                         </label>
                      </div>
                      <div id="comp_vat_details" style="display: none">
                        <p>Please provide your UK VAT number<br>
                           (This is 9 or 12 numbers, sometimes with 'GB' at the start, like <u>123456789</u> or GB123456789)
                        </p>
                        <div class="gen-info mb-3 mt-3">
                           <div class="row">
                              <div class="col-md-10 col-12">
                                 <input type="text" name="vat_no" class="form-control pb-2" id="comp_vat_number" placeholder="Type company VAT number" value="{{ old('vat_no') }}">
                              </div>
                              <div class="col-md-2 col-12">
                                 <button type="button" class="btn btn-danger btn-block pull-right" onclick="verifyCompanyVat()">Verify</button>
                              </div>
                              <input type="hidden" name="vat_comp_name" id="vat_comp_nameid" value="">
                              <input type="hidden" name="vat_comp_address" id="vat_comp_addressid" value="">
                           </div>
                        </div>
                        <div id="compavatdetails">

                        </div>

                      </div>

                   </div>
                </div>
                <!--//-->
                <section>
                   <div class="container">
                      <div class="row">
                         <div class="col-md-12 text-center pt-5 mb-5 fmb_titel">
                            <h2>Additional information</h2>
                         </div>
                      </div>
                   </div>
                </section>
                <div class="white_bg">
                   <div class="row">
                      <div class="col-md-6">
                         <h3>Team photo(s)</h3>
                         <p>If you have photos of your team members please upload them so your customers can have greater trust in you.</p>
                         <div class="row mt-4">
                            <div class="col-md-6">
                               <div class="form-group">
                                  <button type="submit" class="btn btn-outline-danger btn-block">
                                     <svg width="22" height="20" viewBox="0 0 22 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M18 6V4H16V2H18V0H20V2H22V4H20V6H18ZM2 20C1.45 20 0.979333 19.8043 0.588 19.413C0.196 19.021 0 18.55 0 18V6C0 5.45 0.196 4.97933 0.588 4.588C0.979333 4.196 1.45 4 2 4H5.15L7 2H13V4H7.875L6.05 6H2V18H18V9H20V18C20 18.55 19.8043 19.021 19.413 19.413C19.021 19.8043 18.55 20 18 20H2ZM10 16.5C11.25 16.5 12.3127 16.0627 13.188 15.188C14.0627 14.3127 14.5 13.25 14.5 12C14.5 10.75 14.0627 9.68733 13.188 8.812C12.3127 7.93733 11.25 7.5 10 7.5C8.75 7.5 7.68733 7.93733 6.812 8.812C5.93733 9.68733 5.5 10.75 5.5 12C5.5 13.25 5.93733 14.3127 6.812 15.188C7.68733 16.0627 8.75 16.5 10 16.5ZM10 14.5C9.3 14.5 8.70833 14.2583 8.225 13.775C7.74167 13.2917 7.5 12.7 7.5 12C7.5 11.3 7.74167 10.7083 8.225 10.225C8.70833 9.74167 9.3 9.5 10 9.5C10.7 9.5 11.2917 9.74167 11.775 10.225C12.2583 10.7083 12.5 11.3 12.5 12C12.5 12.7 12.2583 13.2917 11.775 13.775C11.2917 14.2583 10.7 14.5 10 14.5Z" fill="#EE5719"/>
                                     </svg>
                                     {{-- Take photo/video --}}
                                     Take photo
                                  </button>
                               </div>
                            </div>
                            <div class="col-md-6">
                               <div class="form-group">
                                  {{-- <a data-bs-toggle="modal" data-bs-target="#exampleModal2" class="btn btn-outline-danger btn-block"> --}}
                                    {{-- <a href="#" data-bs-toggle="modal" data-bs-target="#teamPhotoModal" class="btn btn-outline-danger btn-block"> --}}
                                    <button type="button" onclick="team_photo_upload()" class="btn btn-outline-danger btn-block">
                                        <svg width="18" height="20" viewBox="0 0 18 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M17.0344 4.21564L13.2844 0.465637C13.1415 0.326345 12.9495 0.248887 12.75 0.250012H5.25C4.85218 0.250012 4.47064 0.408047 4.18934 0.689352C3.90804 0.970656 3.75 1.35219 3.75 1.75001V3.25001H2.25C1.85218 3.25001 1.47064 3.40805 1.18934 3.68935C0.908035 3.97066 0.75 4.35219 0.75 4.75001V18.25C0.75 18.6478 0.908035 19.0294 1.18934 19.3107C1.47064 19.592 1.85218 19.75 2.25 19.75H12.75C13.1478 19.75 13.5294 19.592 13.8107 19.3107C14.092 19.0294 14.25 18.6478 14.25 18.25V16.75H15.75C16.1478 16.75 16.5294 16.592 16.8107 16.3107C17.092 16.0294 17.25 15.6478 17.25 15.25V4.75001C17.2511 4.55048 17.1737 4.35851 17.0344 4.21564ZM12.75 18.25H2.25V4.75001H9.44062L12.75 8.05939V18.25ZM15.75 15.25H14.25V7.75001C14.2511 7.55048 14.1737 7.35851 14.0344 7.21564L10.2844 3.46564C10.1415 3.32635 9.94954 3.24889 9.75 3.25001H5.25V1.75001H12.4406L15.75 5.05939V15.25ZM10.5 12.25C10.5 12.4489 10.421 12.6397 10.2803 12.7803C10.1397 12.921 9.94891 13 9.75 13H5.25C5.05109 13 4.86032 12.921 4.71967 12.7803C4.57902 12.6397 4.5 12.4489 4.5 12.25C4.5 12.0511 4.57902 11.8603 4.71967 11.7197C4.86032 11.579 5.05109 11.5 5.25 11.5H9.75C9.94891 11.5 10.1397 11.579 10.2803 11.7197C10.421 11.8603 10.5 12.0511 10.5 12.25ZM10.5 15.25C10.5 15.4489 10.421 15.6397 10.2803 15.7803C10.1397 15.921 9.94891 16 9.75 16H5.25C5.05109 16 4.86032 15.921 4.71967 15.7803C4.57902 15.6397 4.5 15.4489 4.5 15.25C4.5 15.0511 4.57902 14.8603 4.71967 14.7197C4.86032 14.579 5.05109 14.5 5.25 14.5H9.75C9.94891 14.5 10.1397 14.579 10.2803 14.7197C10.421 14.8603 10.5 15.0511 10.5 15.25Z" fill="#EE5719"/>
                                        </svg>
                                        Upload files
                                    </button>
                               </div>
                            </div>
                            <div class="mt-3 mb-4" id="uploaded_team_photo">
                                @if($temp_team_imgs)
                                    @foreach ($temp_team_imgs as $temp_team_img)
                                        <div class="d-inline mr-3">
                                            <a href="#"><img src="{{ $temp_team_img->url }}" alt="" class="rectangle-img mb-1"> </a>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                         </div>
                      </div>
                      <div class="col-md-6">
                         <h3>Photo(s) of previous project(s)</h3>
                         <p>Show your future customers what you can do.</p>
                         <div class="row mt-4">
                            <div class="col-md-6">
                               <div class="form-group">
                                  <button type="submit" class="btn btn-outline-danger btn-block">
                                     <svg width="22" height="20" viewBox="0 0 22 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M18 6V4H16V2H18V0H20V2H22V4H20V6H18ZM2 20C1.45 20 0.979333 19.8043 0.588 19.413C0.196 19.021 0 18.55 0 18V6C0 5.45 0.196 4.97933 0.588 4.588C0.979333 4.196 1.45 4 2 4H5.15L7 2H13V4H7.875L6.05 6H2V18H18V9H20V18C20 18.55 19.8043 19.021 19.413 19.413C19.021 19.8043 18.55 20 18 20H2ZM10 16.5C11.25 16.5 12.3127 16.0627 13.188 15.188C14.0627 14.3127 14.5 13.25 14.5 12C14.5 10.75 14.0627 9.68733 13.188 8.812C12.3127 7.93733 11.25 7.5 10 7.5C8.75 7.5 7.68733 7.93733 6.812 8.812C5.93733 9.68733 5.5 10.75 5.5 12C5.5 13.25 5.93733 14.3127 6.812 15.188C7.68733 16.0627 8.75 16.5 10 16.5ZM10 14.5C9.3 14.5 8.70833 14.2583 8.225 13.775C7.74167 13.2917 7.5 12.7 7.5 12C7.5 11.3 7.74167 10.7083 8.225 10.225C8.70833 9.74167 9.3 9.5 10 9.5C10.7 9.5 11.2917 9.74167 11.775 10.225C12.2583 10.7083 12.5 11.3 12.5 12C12.5 12.7 12.2583 13.2917 11.775 13.775C11.2917 14.2583 10.7 14.5 10 14.5Z" fill="#EE5719"/>
                                     </svg>
                                     {{-- Take photo/video --}}
                                     Take photo
                                  </button>
                               </div>
                            </div>
                            <div class="col-md-6">
                               <div class="form-group">
                                  {{-- <a data-bs-toggle="modal" data-bs-target="#exampleModal2" class="btn btn-outline-danger btn-block"> --}}
                                  {{-- <a href="#" data-bs-toggle="modal" data-bs-target="#prevProjModal" class="btn btn-outline-danger btn-block"> --}}
                                  <button type="button" onclick="prev_proj_upload()" class="btn btn-outline-danger btn-block">
                                     <svg width="18" height="20" viewBox="0 0 18 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M17.0344 4.21564L13.2844 0.465637C13.1415 0.326345 12.9495 0.248887 12.75 0.250012H5.25C4.85218 0.250012 4.47064 0.408047 4.18934 0.689352C3.90804 0.970656 3.75 1.35219 3.75 1.75001V3.25001H2.25C1.85218 3.25001 1.47064 3.40805 1.18934 3.68935C0.908035 3.97066 0.75 4.35219 0.75 4.75001V18.25C0.75 18.6478 0.908035 19.0294 1.18934 19.3107C1.47064 19.592 1.85218 19.75 2.25 19.75H12.75C13.1478 19.75 13.5294 19.592 13.8107 19.3107C14.092 19.0294 14.25 18.6478 14.25 18.25V16.75H15.75C16.1478 16.75 16.5294 16.592 16.8107 16.3107C17.092 16.0294 17.25 15.6478 17.25 15.25V4.75001C17.2511 4.55048 17.1737 4.35851 17.0344 4.21564ZM12.75 18.25H2.25V4.75001H9.44062L12.75 8.05939V18.25ZM15.75 15.25H14.25V7.75001C14.2511 7.55048 14.1737 7.35851 14.0344 7.21564L10.2844 3.46564C10.1415 3.32635 9.94954 3.24889 9.75 3.25001H5.25V1.75001H12.4406L15.75 5.05939V15.25ZM10.5 12.25C10.5 12.4489 10.421 12.6397 10.2803 12.7803C10.1397 12.921 9.94891 13 9.75 13H5.25C5.05109 13 4.86032 12.921 4.71967 12.7803C4.57902 12.6397 4.5 12.4489 4.5 12.25C4.5 12.0511 4.57902 11.8603 4.71967 11.7197C4.86032 11.579 5.05109 11.5 5.25 11.5H9.75C9.94891 11.5 10.1397 11.579 10.2803 11.7197C10.421 11.8603 10.5 12.0511 10.5 12.25ZM10.5 15.25C10.5 15.4489 10.421 15.6397 10.2803 15.7803C10.1397 15.921 9.94891 16 9.75 16H5.25C5.05109 16 4.86032 15.921 4.71967 15.7803C4.57902 15.6397 4.5 15.4489 4.5 15.25C4.5 15.0511 4.57902 14.8603 4.71967 14.7197C4.86032 14.579 5.05109 14.5 5.25 14.5H9.75C9.94891 14.5 10.1397 14.579 10.2803 14.7197C10.421 14.8603 10.5 15.0511 10.5 15.25Z" fill="#EE5719"/>
                                     </svg>
                                     Upload files
                                  </button>
                               </div>
                            </div>
                            <div class="mt-3 mb-4" id="uploaded_prev_proj">
                                @if($temp_prev_projs)
                                    @foreach ($temp_prev_projs as $temp_prev_proj)
                                        <div class="d-inline mr-3">
                                            <a href="#"><img src="{{ $temp_prev_proj->url }}" class="rectangle-img mb-1" /></a>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                         </div>
                      </div>
                   </div>
                </div>
                <!--//-->
                <section>
                   <div class="container">
                      <div class="row">
                         <div class="col-md-12 text-center pt-5 mb-5 fmb_titel">
                            <h2>Coverage</h2>
                         </div>
                      </div>
                   </div>
                </section>
                <div class="white_bg">
                   <div class="col-md-12 mb-4">
                      <h3>Type of work you do</h3>
                   </div>
                   <div class="row">
                      <div class="col-md-4">
                         <nav class="nav-sidebar">
                            <ul class="nav tabs">
                              <?php $i=1; ?>

                              @foreach($works as $w)
                                @php
                                    $buildersubcategories = array_map(function($sw) {
                                        return (array) $sw;
                                    }, $w->buildersubcategories->toArray());
                                    $ids = array_column($buildersubcategories, 'id');
                                    $diff = array_intersect(old('subworktype') ? array_unique(old('subworktype')) : [], $ids);
                                @endphp
                                <li class="workchkboxsec @if($i==1) active @endif">
                                    <a href="#tab{{$i}}" data-toggle="tab" onclick="changeWorkActiveStatus(this)" @if ((count($diff) > 0))class="secondary-font-color" @endif>
                                        {{$w->builder_category_name}} <div class="pull-right">{{ (count($diff) > 0) ? count($diff) : '' }}</div>
                                    </a>
                                </li>
                               <?php $i++; ?>
                               @endforeach
                            </ul>
                         </nav>
                      </div>
                      <div class="col-md-8">
                         <div class="tab-content tab_wrappper" id="work_tab">
                            <div class="wrap">
                                <div class="search">
                                   <button type="button" class="searchButton" onclick="SearchWork()">
                                      <svg width="19" height="20" viewBox="0 0 19 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                         <path fill-rule="evenodd" clip-rule="evenodd" d="M8.59174 2.00025C7.01698 2.00025 5.50672 2.68507 4.3932 3.90406C3.27968 5.12305 2.65411 6.77635 2.65411 8.50025C2.65411 10.2242 3.27968 11.8775 4.3932 13.0964C5.50672 14.3154 7.01698 15.0003 8.59174 15.0003C10.1665 15.0003 11.6768 14.3154 12.7903 13.0964C13.9038 11.8775 14.5294 10.2242 14.5294 8.50025C14.5294 6.77635 13.9038 5.12305 12.7903 3.90406C11.6768 2.68507 10.1665 2.00025 8.59174 2.00025ZM0.827148 8.50025C0.827254 7.14485 1.12345 5.80912 1.69102 4.60451C2.25859 3.3999 3.08109 2.36135 4.08988 1.57549C5.09867 0.789633 6.2645 0.279263 7.49012 0.0869618C8.71573 -0.10534 9.96558 0.0260029 11.1354 0.470032C12.3052 0.914061 13.3611 1.6579 14.2149 2.63949C15.0687 3.62108 15.6957 4.81196 16.0435 6.11277C16.3914 7.41358 16.4501 8.7866 16.2147 10.1173C15.9792 11.448 15.4565 12.6977 14.6901 13.7623L18.0262 17.4143C18.1926 17.6029 18.2846 17.8555 18.2826 18.1177C18.2805 18.3799 18.1844 18.6307 18.015 18.8161C17.8457 19.0015 17.6166 19.1066 17.377 19.1089C17.1375 19.1112 16.9068 19.0104 16.7345 18.8283L13.3985 15.1763C12.2535 16.1642 10.8776 16.7794 9.42823 16.9514C7.97884 17.1233 6.5145 16.8451 5.20281 16.1485C3.89112 15.4519 2.78506 14.3651 2.01123 13.0126C1.2374 11.66 0.827051 10.0962 0.827148 8.50025ZM7.67826 5.00025C7.67826 4.73504 7.7745 4.48068 7.94581 4.29315C8.11712 4.10561 8.34947 4.00025 8.59174 4.00025C9.68195 4.00025 10.7275 4.47436 11.4984 5.31827C12.2693 6.16219 12.7024 7.30678 12.7024 8.50025C12.7024 8.76547 12.6062 9.01982 12.4348 9.20736C12.2635 9.3949 12.0312 9.50025 11.7889 9.50025C11.5466 9.50025 11.3143 9.3949 11.143 9.20736C10.9717 9.01982 10.8754 8.76547 10.8754 8.50025C10.8754 7.83721 10.6348 7.20133 10.2066 6.73249C9.77828 6.26365 9.19741 6.00025 8.59174 6.00025C8.34947 6.00025 8.11712 5.8949 7.94581 5.70736C7.7745 5.51982 7.67826 5.26547 7.67826 5.00025Z" fill="#6D717A"/>
                                      </svg>
                                   </button>
                                   <input type="text" class="searchTerm" placeholder="Find your services..." id="workSearch" onkeyup="SearchWork()">
                                </div>
                             </div>
                           <?php $i=1; ?>
                           @foreach($works as $w)
                            <div class="tab-pane text-style @if($i==1) active @endif" id="tab{{$i}}">
                               <div class="row">
                                 @foreach($w->buildersubcategories as $sw)
                                  <li class="col-6">
                                     <div class="form-check subworktypechk">
                                        <input type="checkbox" id="subwork{{$sw->id}}" class="form-check-input"  name="subworktype[]" value="{{$sw->id}}" {{ (old('subworktype') && in_array($sw->id, old('subworktype'))) ? 'checked': '' }} >
                                        <label class="form-check-label" for="subwork{{$sw->id}}">{{$sw->builder_subcategory_name}}</label>
                                     </div>
                                  </li>
                                  @endforeach
                               </div>
                            </div>
                            <?php $i++; ?>
                            @endforeach
                         </div>
                      </div>
                   </div>
                </div>
                <!--//-->
                <div class="white_bg mt-5">
                   <div class="col-md-12 mb-4">
                      <h3>Which areas do you cover?</h3>
                   </div>
                   <div class="row">
                      <div class="col-md-4">
                         <nav class="nav-sidebar">
                            <ul class="nav tabs">
                              <?php $j=1;?>
                             @foreach($areas as $a)
                                @php
                                    $buildersubareas = array_map(function($sa) {
                                        return (array) $sa;
                                    }, $a->subareas->toArray());
                                    $ids = array_column($buildersubareas, 'id');
                                    $diff = array_intersect(old('subareacovers') ? array_unique(old('subareacovers')) : [], $ids);
                                @endphp
                               <li class="areaschkboxsec @if($j == 1) active @endif">
                                  <a href="#tab0{{$j}}" data-toggle="tab" onclick="changeAreaActiveStatus(this)" @if ((count($diff) > 0))class="secondary-font-color" @endif>
                                     {{$a->area_type}}
                                     {{-- <div class="pull-right">{{count($a->subareas)}}</div> --}}
                                     <div class="pull-right">{{ (count($diff) > 0) ? count($diff) : '' }}</div>
                                  </a>
                               </li>
                               <?php $j++; ?>
                               @endforeach

                              {{-- <?//php $j=1;?>
                               @foreach ($counties as $county)
                                <li class="areaschkboxsec @if($j == 1) active @endif">
                                    <a href="#tab0{{$j}}" data-toggle="tab" onclick="changeAreaActiveStatus(this)" @if ((count($diff) > 0))class="secondary-font-color" @endif>
                                        {{ $county }}
                                    <!-- <div class="pull-right">{{count($a->subareas)}}</div> -->
                                    <div class="pull-right">{{ (count($diff) > 0) ? count($diff) : '' }}</div>
                                    </a>
                                </li>
                               <?//php $j++; ?>
                               @endforeach --}}
                            </ul>
                         </nav>
                      </div>
                      <div class="col-md-8">
                         <div class="tab-content tab_wrappper" id="area_tab">
                            <div class="wrap">
                                <div class="search">
                                   <button type="button" class="searchButton" onclick="SearchArea()">
                                      <svg width="19" height="20" viewBox="0 0 19 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                         <path fill-rule="evenodd" clip-rule="evenodd" d="M8.59174 2.00025C7.01698 2.00025 5.50672 2.68507 4.3932 3.90406C3.27968 5.12305 2.65411 6.77635 2.65411 8.50025C2.65411 10.2242 3.27968 11.8775 4.3932 13.0964C5.50672 14.3154 7.01698 15.0003 8.59174 15.0003C10.1665 15.0003 11.6768 14.3154 12.7903 13.0964C13.9038 11.8775 14.5294 10.2242 14.5294 8.50025C14.5294 6.77635 13.9038 5.12305 12.7903 3.90406C11.6768 2.68507 10.1665 2.00025 8.59174 2.00025ZM0.827148 8.50025C0.827254 7.14485 1.12345 5.80912 1.69102 4.60451C2.25859 3.3999 3.08109 2.36135 4.08988 1.57549C5.09867 0.789633 6.2645 0.279263 7.49012 0.0869618C8.71573 -0.10534 9.96558 0.0260029 11.1354 0.470032C12.3052 0.914061 13.3611 1.6579 14.2149 2.63949C15.0687 3.62108 15.6957 4.81196 16.0435 6.11277C16.3914 7.41358 16.4501 8.7866 16.2147 10.1173C15.9792 11.448 15.4565 12.6977 14.6901 13.7623L18.0262 17.4143C18.1926 17.6029 18.2846 17.8555 18.2826 18.1177C18.2805 18.3799 18.1844 18.6307 18.015 18.8161C17.8457 19.0015 17.6166 19.1066 17.377 19.1089C17.1375 19.1112 16.9068 19.0104 16.7345 18.8283L13.3985 15.1763C12.2535 16.1642 10.8776 16.7794 9.42823 16.9514C7.97884 17.1233 6.5145 16.8451 5.20281 16.1485C3.89112 15.4519 2.78506 14.3651 2.01123 13.0126C1.2374 11.66 0.827051 10.0962 0.827148 8.50025ZM7.67826 5.00025C7.67826 4.73504 7.7745 4.48068 7.94581 4.29315C8.11712 4.10561 8.34947 4.00025 8.59174 4.00025C9.68195 4.00025 10.7275 4.47436 11.4984 5.31827C12.2693 6.16219 12.7024 7.30678 12.7024 8.50025C12.7024 8.76547 12.6062 9.01982 12.4348 9.20736C12.2635 9.3949 12.0312 9.50025 11.7889 9.50025C11.5466 9.50025 11.3143 9.3949 11.143 9.20736C10.9717 9.01982 10.8754 8.76547 10.8754 8.50025C10.8754 7.83721 10.6348 7.20133 10.2066 6.73249C9.77828 6.26365 9.19741 6.00025 8.59174 6.00025C8.34947 6.00025 8.11712 5.8949 7.94581 5.70736C7.7745 5.51982 7.67826 5.26547 7.67826 5.00025Z" fill="#6D717A"/>
                                      </svg>
                                   </button>
                                   <input type="text" class="searchTerm" placeholder="Find your location..." onkeyup="SearchArea()"
                                   id="areaSearch">
                                </div>
                             </div>
                           <?php $j=1;?>
                            @foreach($areas as $a)
                            <div class="tab-pane @if($j == 1) active @endif text-style" id="tab0{{$j}}">
                               <div class="row tab_cont">
                                 @foreach($a->subareas as $ac)
                                  <li class="col-6">
                                     <div class="form-check areachkbx">
                                        <input type="checkbox" id="areacovers{{$ac->id}}" class="form-check-input"  name="subareacovers[]" value="{{$ac->id}}" {{ (old('subareacovers') && in_array($ac->id, old('subareacovers'))) ? 'checked': '' }}>
                                        <label class="form-check-label" for="areacovers{{$ac->id}}">{{$ac->sub_area_type}}</label>
                                     </div>
                                  </li>
                                  @endforeach

                               </div>
                            </div>
                            <?php $j++; ?>
                           @endforeach
                         </div>
                      </div>
                   </div>
                </div>
                <!--//-->
                <div class="form-group col-md-12 mt-5 text-center">
                   <button type="submit" class="btn btn-primary">Save and continue</button>
                </div>
             </div>
          </div>
          <!--// END-->
       </form>
    </div>
 </section>

 <!-- The Modal Upload Photo file-->
 <div class="modal fade select_address" id="takePhotoModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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

               <form method="POST" action="{{ route('capture-photo') }}" enctype="multipart/form-data">
                   @csrf
                       <div class="row">
                           <div class="col-md-12 supported_">
                               <div class="col-md-6">
                                   <div id="my_camera"></div>
                                   <br/>
                                   <input type=button value="Take Snapshot" onClick="take_snapshot()">
                                   <input type="hidden" name="image" class="image-tag" >
                               </div>
                               <div class="col-md-6">
                                   <div id="results">Your captured image will appear here...</div>
                               </div>
                               <div class="col-md-12 text-center">
                                   <br/>
                                   <button class="btn btn-success">Submit</button>
                               </div>
                           </div>
                       </div>
               </form>


           </div>
           <div class="modal-footer">
               <button type="button" class="btn btn-link" data-bs-dismiss="modal">Cancel</button>

           </div>
       </div>
   </div>
</div>
<!-- The Modal Upload Photo file END-->

<!-- The Modal Upload Video file-->
<div class="modal fade select_address" id="takeVideoModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                           <button class="btn btn-default"  id='gUMbtn'>Request Stream</button>
                       </div>
                       <div id='btns' style="display: none;">

                           <button  class="btn btn-default" id='start'>Start</button>
                           <button  class="btn btn-default" id='stop'>Stop</button>
                       </div>




                   </div>
               </div>
           </div>
           <div class="modal-footer">
               <button type="button" class="btn btn-link" data-bs-dismiss="modal">Cancel</button>

           </div>
       </div>
   </div>
</div>
<!-- The Modal Upload Video file END-->

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
<script src="{{ asset('frontend/dropzone/dropzone.js') }}"></script>
<script src="{{ asset('frontend/webcamjs/webcam.min.js') }}"></script>
<script src="{{ asset('frontend/webcamjs/video.js') }}"></script>
<script src="{{ asset('frontend/js/utils.js') }}"></script>
<script type="text/javascript">
    $(document).ready(function(){
        //   var selectedtel = $(".iti__selected-dial-code").text();
        //   $('#phone_code').val(selectedtel);

        // phone number setup
        let input = document.querySelector("#phone");
        let iti = window.intlTelInput(input, {
            separateDialCode: true,
            initialCountry: "gb",
        });

        let phone_office = document.querySelector("#phone_office");
        let office_iti = window.intlTelInput(phone_office, {
            separateDialCode: true,
            initialCountry: "gb",
        });

        if($('input[name=comp_reg_no]').val()){
            findcomp();
        }

        if($('input[name=vat_reg][value="1"]').attr('checked') == 'checked'){
            $('#comp_vat_details').css('display','block');
            if ($('#comp_vat_number').val()){
                verifyCompanyVat();
            }
        }



        $('#company-general-form').submit(function(event) {
            event.preventDefault();

            // Get Country Dial Code
            var countryData = iti.getSelectedCountryData();
            // var countryCode = countryData.dialCode;
            var countryCode = countryData.iso2;
            var phoneNumber = iti.getNumber();
            var officeNumber = office_iti.getNumber();

            var formData = $(this).serializeArray();
            formData.push({name: 'phone_code', value: countryCode});
            formData.push({name: 'phone_office_with_dial_code', value: officeNumber});



            $.each(formData, function(index, field) {
                $('<input>').attr({
                    type: 'hidden',
                    name: field.name,
                    value: field.value
                }).appendTo('#company-general-form');
            });

            document.querySelector('#company-general-form').submit();
        });
    });

//    input.addEventListener("countrychange", function() {
//       var selectedtel = $(".iti__selected-dial-code").text();
//       $('#phone_code').val(selectedtel);
//    });

    $('#summernote').summernote({
        //placeholder: 'FixMyBuild',
        tabsize: 2,
        height: 200,
        toolbar: [
        ['style', ['style']],
        ['font', ['bold', 'underline', 'clear']],
        ['color', ['color']],
        ['para', ['ul', 'ol', 'paragraph']],
        ['table', ['table']],
        ]
    });

        // Webcam.set({
        //     width: 490,
        //     height: 350,
        //     image_format: 'jpeg',
        //     jpeg_quality: 90
        // });

        // Webcam.attach('#my_camera');
        // Webcam.attach('#my_camera_video');

    function changeWorkActiveStatus(event) {
        $(".workchkboxsec").removeClass("active");
        $(event).closest(".workchkboxsec").addClass('active');
    }

    function changeAreaActiveStatus(event) {
        $(".areaschkboxsec").removeClass("active");
        $(event).closest(".areaschkboxsec").addClass('active');
    }

    function SearchWork() {
        var input = document.getElementById("workSearch");
        var filter = input.value.trim().toLowerCase();
        var nodes = document.getElementsByClassName('subworktypechk');

        for (i = 0; i < nodes.length; i++) {
            if (nodes[i].innerText.toLowerCase().includes(filter)) {
                $(nodes[i]).closest("li").show();
            } else {
                $(nodes[i]).closest("li").hide();
            }
        }
    }

    function SearchArea() {
        var input = document.getElementById("areaSearch");
        var filter = input.value.trim().toLowerCase();
        var nodes = document.getElementsByClassName('areachkbx');

        for (i = 0; i < nodes.length; i++) {
            if (nodes[i].innerText.toLowerCase().includes(filter)) {
                $(nodes[i]).closest("li").show();
            } else {
                $(nodes[i]).closest("li").hide();
            }
        }
    }

    function findcomp(){
        var company_id = $('#comp_reg_no').val();
        $.ajax
        ({
            type: "GET",
            url: "get-company-details",
            data: {company_id: company_id},
            success: function (data){
                data = JSON.parse(data);
                // console.log(data);
                if(data.errors){
                // $('#serchcompres').css('display', 'none');
                $('#serchcompres').hide();
                $('#findcomperror').html('<p style="color:red">Please enter correct Company Registation number</p>');
                }
                if(data.accounts){
                // $('#serchcompres').css('display', 'block');
                $('#serchcompres').show();
                $('#txt_comp_name').html(data.company_name);
                $('#comp_name').val(data.company_name);
                $('#txt_comp_address').html(data.registered_office_address.address_line_1+', '+data.registered_office_address.locality+', '+data.registered_office_address.country+', '+data.registered_office_address.postal_code);
                $('#comp_address').val(data.registered_office_address.address_line_1+', '+data.registered_office_address.locality+', '+data.registered_office_address.country+', '+data.registered_office_address.postal_code);
                }
            }
        });
    }

    $('input[type=radio][name=vat_reg]').change(function() {
        if (this.value == '1') {
            $('#comp_vat_details').show();
        }
        else if (this.value == '0') {
            $('#comp_vat_details').hide();
        }
    });

    function verifyCompanyVat(){
        var vat_number = $('#comp_vat_number').val();
        if(vat_number){
            vat_number = vat_number.replace(/\s+/g, "");
            vat_number = vat_number.replace(/\D/g,'');
            $.ajax
            ({
                type: "GET",
                url: "get-company-vat-details",
                data: {vat_number: vat_number},
                success: function (data){
                    data = JSON.parse(data);
                    if(data.target){
                        var comp_name = data.target.name;
                        var comp_addr = data.target.address.line1+', '+data.target.address.line2+', '+data.target.address.postcode;
                        $('#compavatdetails').html('<p><b>Company name:</b> '+comp_name+'</p><p><b>Company address:</b> '+comp_addr+'</p>');
                        $('#vat_comp_nameid').val(comp_name);
                        $('#vat_comp_addressid').val(comp_addr);
                    }else{
                        $('#compavatdetails').html('<p style="color:red">Provided UK VAT does not match a registered company</p>');
                        $('#vat_comp_nameid').val('');
                        $('#vat_comp_addressid').val('');
                    }
                }
            });
        }

    }

    $('#company_role').change(function(){
        //   console.log(this.value);
        if(this.value == 'Other'){
            $('#other_designation').html('<div class="form-group"><input type="text" name="designation" class="form-control" id="" placeholder="Type your role"></div>');
        } else {
            $('#other_designation').empty();
        }
    });

    $("input[name = 'vat_reg']").change(function(){
        if($(this).val() == 0) {
            $("#comp_vat_number").val('');
            $("#vat_comp_nameid").val('');
            $("#vat_comp_addressid").val('');
            $("#compavatdetails").empty();
        }
        // console.log("Changed");
    });

    //  For Uploading Company Logo
    function geturldata(e){
        var result = '<iframe  width="660" height="500"  src="'+e.currentTarget.href+'" frameborder="0" marginheight="0" marginwidth="0">Loading&amp;#8230;</iframe>';
        $("#companyLogoModal").modal('show');
        $(".comlogodropzone").html(result);
        e.preventDefault();
    }
    //End of company logo uploading

    function take_snapshot() {
        Webcam.snap( function(data_uri) {
            $(".image-tag").val(data_uri);
            document.getElementById('results').innerHTML = '<img src="'+data_uri+'"/>';
        } );
    }

    //  For Uploading Company File
    function geturldataupload(e){
        var result = '<iframe  width="660" height="500"  src="'+e.currentTarget.href+'" frameborder="0" marginheight="0" marginwidth="0">Loading&amp;#8230;</iframe>';
        $("#tradepersionUploadfile").modal('show');
        $(".modeldropzone1").html(result);
        e.preventDefault();
    }
    //End of company file uploading

    // Show Checked Work Numbers on Tab sidebar
    $("#work_tab .subworktypechk input[type='checkbox']").change( function() {
            let id = $(this).closest(".tab-pane").attr("id");
            let formatted_id = "#"+id;
            let checked_element = $(formatted_id +" input[type='checkbox']:checked").length;

            if( checked_element === 0 ){
                checked_element = '';
                $(`a[href='${formatted_id}']:link`).removeClass("secondary-font-color");
            } else {
                $(`a[href='${formatted_id}']:link`).addClass("secondary-font-color");
            }

            $(`a[href='${formatted_id}'] .pull-right`).text(checked_element);
        }
    );

    // Show Checked Area Numbers on Tab sidebar
    $("#area_tab .areachkbx input[type='checkbox']").change( function() {
        let id = $(this).closest(".tab-pane").attr("id");
        let formatted_id = "#"+id;
        let checked_element = $(formatted_id +" input[type='checkbox']:checked").length;
        if( checked_element === 0 ){
            checked_element = '';
            $(`a[href='${formatted_id}']:link`).removeClass("secondary-font-color");
        } else {
            $(`a[href='${formatted_id}']:link`).addClass("secondary-font-color");
        }

        $(`a[href='${formatted_id}'] .pull-right`).text(checked_element);
    });

    Dropzone.autoDiscover = false;

    // PreviewTemplate For Single File dropzone Starts
    var singleFilePreviewNode = document.querySelector("#singleFileTemplate");
    singleFilePreviewNode.id = "";
    var singleFilepreviewTemplate = singleFilePreviewNode.parentNode.innerHTML;
    singleFilePreviewNode.parentNode.removeChild(singleFilePreviewNode);
    // PreviewTemplate For Single File dropzone Starts

    // PreviewTemplate For Multiple File dropzone Starts
    var previewNode = document.querySelector("#template");
    previewNode.id = "";
    var previewTemplate = previewNode.parentNode.innerHTML;
    previewNode.parentNode.removeChild(previewNode);
    // PreviewTemplate For Multiple File dropzone Ends

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

    // Dropzone Js For Company Logo Starts
    function comp_logo_upload() {
        var url = "{{ route('tradesperson.tempTraderMedia') }}";
        var params = {
            file_related_to: 'company_logo',
            file_type: 'image',
        };
        var html = ` .gif .heic .jpeg, .jpg .png .svg .webp`;
        var acceptedFiles = "{{ config('const.dropzone_accepted_image') }}";
        var maxFileSize = {{ config('const.dropzone_max_file_size') }};
        var modal = "#companyLogoModal";

        // $(modal+' .accepted-file-list').html(html);
        $(modal+' .ext_').html(html);
        $(modal).modal('show');

        var dropzone = singleFileDropzone(url, params, acceptedFiles, maxFileSize, modal);

        dropzone.on("success", function(file, response) {
            let html = `<img src="${response.image_link}" alt="" class="square-img" id="uploaded_company_logo" />
                        <div class="d-inline ml-2">
                            <span id="uploaded_company_logo_details">${response.file_name}</span>
                        </div>`;
            $('#company_logo').html(html);
        });

        // dropzone.on("error", function(file, errorMessage, xhr) {
        //     console.log(file);
        //     console.log(errorMessage);
        //     console.log(xhr);
        // });
    }
    // Dropzone Js For Company Logo Ends


    // Dropzone Js For Company Logo Starts
    // let dropzone = new Dropzone("#company_logo_dropzone", {
    //     {{-- url: "{{ route('tradesperson.storeLogo') }}", --}}
    //     url: "{{ route('tradesperson.tempTraderMedia') }}",
    //     params: {
    //         file_related_to: 'company_logo',
    //         file_type: 'image',
    //     },
    //     uploadMultiple: false,
    //     maxFiles: 1,
    //     // maxFilesize: {{ env('CUSTOMER_PROFILE_IMAGE_SIZE') }},
    //     // acceptedFiles: "{{ env('CUSTOMER_PROFILE_IMAGE_ACCEPTED_FILE_TYPES') }}",
    //     maxFilesize: {{ config('const.dropzone_max_file_size') }},
    //     acceptedFiles: "{{ config('const.dropzone_accepted_image') }}",
    //     thumbnailWidth: 240,
    //     thumbnailHeight: 240,
    //     autoProcessQueue: false,
    //     previewsContainer: "#company_logo_dropzone",
    //     clickable: "#file_upload_btn",
    //     dictDefaultMessage: "Drag and drop a file here",
    //     init: function() {
    //         let dz = this;
    //         let uploadButton = $("#upload_avatar");

    //         this.on("addedfile", function(file) {
    //             if (this.files.length > 1) {
    //                 dz.removeFile(this.files[0]);
    //             }
    //             // $("#company_logo_dropzone").find(".dz-message").css("display", "none");
    //             // $(file.previewElement).find(".dz-error-mark, .dz-success-mark, .dz-error-message, .dz-progress").css("display", "none");
    //             $("#company_logo_dropzone").find(".dz-message").hide();
    //             $(file.previewElement).find(".dz-error-mark, .dz-success-mark, .dz-error-message, .dz-progress").show();
    //             updateUploadButton();
    //         });

    //         this.on("removedfile", function(file) {
    //             updateUploadButton();
    //         });

    //         this.on("thumbnail", function(file, dataUrl) {
    //             // $("#company_logo_dropzone").find(".dz-message").css("display", "none");
    //             // $(file.previewElement).find(".dz-error-mark, .dz-success-mark, .dz-error-message, .dz-progress").css("display", "none");
    //             // $(file.previewElement).find(".dz-image img").css({
    //             //     "border-radius": "5%",
    //             //     "transition": "none"
    //             // });
    //             $("#company_logo_dropzone").find(".dz-message").hide();
    //             $(file.previewElement).find(".dz-error-mark, .dz-success-mark, .dz-error-message, .dz-progress").hide();
    //             $(file.previewElement).find(".dz-image img").addClass("dropzone-preview-thumbnail");
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
    //             // $(file.previewElement).find(".dz-progress").css("display", "none");
    //             // $(file.previewElement).find(".dz-success-mark").css("display", "block");
    //             $(file.previewElement).find(".dz-progress").hide();
    //             $(file.previewElement).find(".dz-success-mark").show();
    //             if($('#uploaded_company_logo').length > 0) {
    //                 $('#uploaded_company_logo').attr('src', response.image_link);
    //                 $('#uploaded_company_logo_details').text(`${response.file_name}`);
    //             } else {
    //                 let html = `<img src="${response.image_link}" alt="" class="square-img" id="uploaded_company_logo" />
    //                             <div class="d-inline ml-2">
    //                                 <span id="uploaded_company_logo_details">${response.file_name}</span>
    //                             </div>`;
    //                 $('#company_logo').html(html);
    //             }
    //             updateUploadButton();
    //         });

    //         this.on("error", function(file, errorMessage) {
    //             // $(file.previewElement).find(".dz-progress").css("display", "none");
    //             // $(file.previewElement).find(".dz-error-message").text(errorMessage).css("display", "block");
    //             // $(file.previewElement).find(".dz-error-mark").css("display", "block");
    //             $(file.previewElement).find(".dz-progress").hide();
    //             $(file.previewElement).find(".dz-error-message").text(errorMessage).show();
    //             $(file.previewElement).find(".dz-error-mark").show();
    //             updateUploadButton();
    //         });

    //         function updateUploadButton() {
    //             let maxFileSize = dz.options.maxFilesize ? dz.options.maxFilesize * 1024 * 1024 : (2 * 1024 * 1024);
    //             let acceptedFileTypes = dz.options.acceptedFiles;
    //             $('.supported_ .invalid-file').empty();
    //             $('.supported_ .dropzone-messages').empty();

    //             let file = dz.files[0];

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
    //                         $('.supported_ .dropzone-messages').empty();
    //                         $('.dz-error-message').empty();
    //                         $('.dz-success-mark').empty();
    //                         $('.dz-error-mark').empty();
    //                         $('.dz-details').empty();
    //                         // $('.dz-message').css("display", "block");
    //                         $('.dz-message').show();
    //                         errorMessage.push("Invalid file type. Please select a valid file.");
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

    //         $("#companyLogoModal").on("hidden.bs.modal", function() {
    //             $("#company_logo_dropzone").find(".dz-message").show();
    //             $("#company_logo_dropzone .supported_ .invalid-file").empty();
    //             $("#company_logo_dropzone .supported_ .dropzone-messages").empty();
    //             dz.removeAllFiles();
    //         });
    //     }

    // });
    // Dropzone Js For Company Logo Ends

    // let pli_dropzone = new Dropzone("#pli_dropzone", {
    //     url: "{{-- route('tradesperson.storePLI') --}}",
    //     params: {
    //         file_related_to: 'public_liability_insurance',
    //         file_type: 'document',
    //     },
    //     uploadMultiple: false,
    //     maxFiles: 1,
    //     // maxFilesize: {{ env('CUSTOMER_PROFILE_IMAGE_SIZE') }},
    //     // acceptedFiles: "image/jpeg, image/png, image/svg+xml, image/webp, application/pdf",
    //     maxFilesize: {{ config('const.dropzone_max_file_size') }},
    //     acceptedFiles: "{{ config('const.dropzone_accepted_file') }}",
    //     thumbnailWidth: 240,
    //     thumbnailHeight: 240,
    //     autoProcessQueue: false,
    //     previewsContainer: "#pli_dropzone",
    //     clickable: "#pli_upload_btn",
    //     dictDefaultMessage: "",
    //     init: function() {
    //         let dz = this;
    //         let uploadButton = $("#upload_pli");

    //         this.on("addedfile", function(file) {
    //             if (this.files.length > 1) {
    //                 dz.removeFile(this.files[0]);
    //             }
    //             // $("#pli_dropzone").find(".dz-message").css("display", "none");
    //             // $(file.previewElement).find(".dz-error-mark, .dz-success-mark, .dz-error-message, .dz-progress").css("display", "none");
    //             $("#pli_dropzone").find(".dz-message").hide();
    //             $(file.previewElement).find(".dz-error-mark, .dz-success-mark, .dz-error-message, .dz-progress").hide();
    //             updateUploadButton();
    //         });

    //         this.on("removedfile", function(file) {
    //             updateUploadButton();
    //         });

    //         this.on("thumbnail", function(file, dataUrl) {
    //             // $("#pli_dropzone").find(".dz-message").css("display", "none");
    //             // $(file.previewElement).find(".dz-error-mark, .dz-success-mark, .dz-error-message, .dz-progress").css("display", "none");
    //             // $(file.previewElement).find(".dz-image img").css({
    //             //     "border-radius": "5%",
    //             //     "transition": "none"
    //             // });
    //             $("#pli_dropzone").find(".dz-message").hide();
    //             $(file.previewElement).find(".dz-error-mark, .dz-success-mark, .dz-error-message, .dz-progress").hide();
    //             $(file.previewElement).find(".dz-image img").addClass('dropzone-preview-thumbnail');
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
    //             let html = `<div class="d-inline mr-3">${response.file_name}</div>`;
    //             // $(file.previewElement).find(".dz-progress").css("display", "none");
    //             // $(file.previewElement).find(".dz-success-mark").css("display", "block");
    //             $(file.previewElement).find(".dz-progress").hide();
    //             $(file.previewElement).find(".dz-success-mark").show();
    //             $('#uploaded_pli').empty();
    //             $('#uploaded_pli').append(html);
    //             updateUploadButton();
    //         });

    //         this.on("error", function(file, errorMessage) {
    //             // $(file.previewElement).find(".dz-progress").css("display", "none");
    //             // $(file.previewElement).find(".dz-error-message").text(errorMessage).css("display", "block");
    //             // $(file.previewElement).find(".dz-error-mark").css("display", "block");
    //             $(file.previewElement).find(".dz-progress").hide();
    //             $(file.previewElement).find(".dz-error-message").text(errorMessage).show();
    //             $(file.previewElement).find(".dz-error-mark").show();
    //             updateUploadButton();
    //         });

    //         function updateUploadButton() {
    //             let maxFileSize = dz.options.maxFilesize ? dz.options.maxFilesize * 1024 * 1024 : (2 * 1024 * 1024);
    //             let acceptedFileTypes = dz.options.acceptedFiles;
    //             $('.supported_ .invalid-file').empty();
    //             $('.supported_ .dropzone-messages').empty();

    //             let file = dz.files[0];

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
    //                         $('.supported_ .dropzone-messages').empty();
    //                         $('.dz-error-message').empty();
    //                         $('.dz-success-mark').empty();
    //                         $('.dz-error-mark').empty();
    //                         $('.dz-details').empty();
    //                         // $('.dz-message').css("display", "block");
    //                         $('.dz-message').show();
    //                         errorMessage.push("Invalid file type. Please select a valid file.");
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

    //         $("#pliModal").on("hidden.bs.modal", function() {
    //             // $("#pli_dropzone").find(".dz-message").css("display", "block");
    //             $("#pli_dropzone").find(".dz-message").show();
    //             $("#pli_dropzone .supported_ .invalid-file").empty();
    //             $("#pli_dropzone .supported_ .dropzone-messages").empty();
    //             dz.removeAllFiles();
    //         });
    //     }

    // });
    // Dropzone Js For Public liability insurance Starts
    function callDropzone(url, params, acceptedFiles="{{ config('const.dropzone_accepted_file') }}", maxFileSize={{ config('const.dropzone_max_file_size') }}) {
        var multiFileDropzoneElement = document.querySelector("#multi_file_dropzone");
        var multiFileDropzone = multiFileDropzoneElement.dropzone;
        var thumbnailMapping = {
            'application/pdf': "{{ asset('frontend/img/pdf_logo.png') }}",
            'application/msword': "{{ asset('frontend/img/doc_logo.png') }}",
            'application/vnd.openxmlformats-officedocument.wordprocessingml.document': "{{ asset('frontend/img/doc_logo.png') }}",
        };

        // If a Dropzone instance doesn't exist, create a new one
        if (!multiFileDropzone) {
            multiFileDropzone = new Dropzone(multiFileDropzoneElement, {
                url: url,
                params: params,
                maxFilesize: maxFileSize,
                acceptedFiles: acceptedFiles,
                thumbnailWidth: 100,
                thumbnailHeight: 69,
                previewTemplate: previewTemplate,
                autoQueue: false,
                previewsContainer: "#previews",
                clickable: "#multi_file_upload_btn",
            });
        }

        // If a Dropzone instance exists, update the old instance
        multiFileDropzone.options.url = url;
        multiFileDropzone.options.params = params;

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
            if (progress == 100) {
                $(file.previewElement).find('.progress').hide();
            }
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

        });

        multiFileDropzone.on("removedfile", function(file) {
            if(multiFileDropzone.files.length == 0) {
                $('#file-upload-logo').show();
                $('#previews').addClass('d-none');
                $('#multi_file_dropzone.cpp_wrap').removeClass('uploading');
            }
        });

        // Setup the buttons for all transfers
        // The "add files" button doesn't need to be setup because the config
        // `clickable` has already been specified.
        document.querySelector("#upload_multiple_file").onclick = function() {
            multiFileDropzone.enqueueFiles(multiFileDropzone.getFilesWithStatus(Dropzone.ADDED));
        };

        // document.querySelector("#cancel_multiple_file_upload").onclick = function() {
        //     multiFileDropzone.removeAllFiles(true);
        // };

        $('#multiModal').on('hidden.bs.modal', function(e){
            multiFileDropzone.removeAllFiles(true);
        });

        return multiFileDropzone;
    }

    function pli_upload() {
        // var url = "{{-- route('tradesperson.storePLI') --}}";
        var url = "{{ route('tradesperson.tempTraderMedia') }}";
        var params = {
            file_related_to: 'public_liability_insurance',
            file_type: 'document',
        };
        let html = `<h6><strong>Images:</strong> .gif .heic .jpeg, .jpg .png .svg .webp</h6>
                    <h6><strong>Documents:</strong> .doc, .docx .odt .pdf .ppt, .pptx </h6>`;
        var acceptedFiles = "{{ config('const.trader_public_liability') }}";

        $('#multiModal .accepted-file-list').html(html);
        $('#multiModal').modal('show');

        var dropzone = callDropzone(url, params, acceptedFiles);

        dropzone.on("success", function(file, response) {
            let html = `<div class="d-inline mr-3">${response.file_name}</div>`;
            $('#uploaded_pli').append(html);
        });

        dropzone.on("error", function(file, errorMessage, xhr) {
            console.log(file);
            console.log(errorMessage);
            console.log(xhr);
        });
    }

    // Dropzone Js For Trader Image Identification Upload Starts
    // let trader_img_dropzone = new Dropzone("#trader_img_dropzone", {
    //     url: "{{-- route('tradesperson.storeTraderImg') --}}",
    //     params: {
    //         file_related_to: 'trader_img',
    //     },
    //     uploadMultiple: false,
    //     maxFiles: 1,
    //     // maxFilesize: {{ env('CUSTOMER_PROFILE_IMAGE_SIZE') }},
    //     // acceptedFiles: "image/jpeg, image/png, image/svg+xml, image/webp, application/pdf",
    //     maxFilesize: {{ config('const.dropzone_max_file_size') }},
    //     acceptedFiles: "{{ config('const.dropzone_accepted_file') }}",
    //     thumbnailWidth: 240,
    //     thumbnailHeight: 240,
    //     autoProcessQueue: false,
    //     previewsContainer: "#trader_img_dropzone",
    //     clickable: "#trader_img_upload_btn",
    //     dictDefaultMessage: "",
    //     init: function() {
    //         let dz = this;
    //         let uploadButton = $("#upload_trader_img");

    //         this.on("addedfile", function(file) {
    //             if (this.files.length > 1) {
    //                 dz.removeFile(this.files[0]);
    //             }
    //             $("#trader_img_dropzone").find(".dz-message").css("display", "none");
    //             // $(file.previewElement).find(".dz-error-mark, .dz-success-mark, .dz-error-message, .dz-progress").css("display", "none");
    //             $(file.previewElement).find(".dz-error-mark, .dz-success-mark, .dz-error-message, .dz-progress").hide();
    //             updateUploadButton();
    //         });

    //         this.on("removedfile", function(file) {
    //             updateUploadButton();
    //         });

    //         this.on("thumbnail", function(file, dataUrl) {
    //             // $("#trader_img_dropzone").find(".dz-message").css("display", "none");
    //             // $(file.previewElement).find(".dz-error-mark, .dz-success-mark, .dz-error-message, .dz-progress").css("display", "none");
    //             // $(file.previewElement).find(".dz-image img").css({
    //             //     "border-radius": "5%",
    //             //     "transition": "none"
    //             // });
    //             $("#trader_img_dropzone").find(".dz-message").hide();
    //             $(file.previewElement).find(".dz-error-mark, .dz-success-mark, .dz-error-message, .dz-progress").hide();
    //             $(file.previewElement).find(".dz-image img").addClass('dropzone-preview-thumbnail');
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
    //             let html = `<div class="d-inline mr-3">${response.file_name}</div>`;
    //             // $(file.previewElement).find(".dz-progress").css("display", "none");
    //             // $(file.previewElement).find(".dz-success-mark").css("display", "block");
    //             $(file.previewElement).find(".dz-progress").hide();
    //             $(file.previewElement).find(".dz-success-mark").show();
    //             $('#uploaded_trader_img').empty();
    //             $('#uploaded_trader_img').append(html);
    //             updateUploadButton();
    //         });

    //         this.on("error", function(file, errorMessage) {
    //             // $(file.previewElement).find(".dz-progress").css("display", "none");
    //             // $(file.previewElement).find(".dz-error-message").text(errorMessage).css("display", "block");
    //             // $(file.previewElement).find(".dz-error-mark").css("display", "block");
    //             $(file.previewElement).find(".dz-progress").hide();
    //             $(file.previewElement).find(".dz-error-message").text(errorMessage).show();
    //             $(file.previewElement).find(".dz-error-mark").show();
    //             updateUploadButton();
    //         });

    //         function updateUploadButton() {
    //             let maxFileSize = dz.options.maxFilesize ? dz.options.maxFilesize * 1024 * 1024 : (2 * 1024 * 1024);
    //             let acceptedFileTypes = dz.options.acceptedFiles;
    //             $('.supported_ .invalid-file').empty();
    //             $('.supported_ .dropzone-messages').empty();

    //             let file = dz.files[0];

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
    //                         $('.supported_ .dropzone-messages').empty();
    //                         $('.dz-error-message').empty();
    //                         $('.dz-success-mark').empty();
    //                         $('.dz-error-mark').empty();
    //                         $('.dz-details').empty();
    //                         // $('.dz-message').css("display", "block");
    //                         $('.dz-message').show();
    //                         errorMessage.push("Invalid file type. Please select a valid file.");
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

    //         $("#traderImgDropzoneModal").on("hidden.bs.modal", function() {
    //             // $("#trader_img_dropzone").find(".dz-message").css("display", "block");
    //             $("#trader_img_dropzone").find(".dz-message").show();
    //             $("#trader_img_dropzone .supported_ .invalid-file").empty();
    //             $("#trader_img_dropzone .supported_ .dropzone-messages").empty();
    //             dz.removeAllFiles();
    //         });
    //     }

    // });
    function trader_photo_id_upload() {
        // var url = "{{-- route('tradesperson.storeTraderImg') --}}";
        var url = "{{ route('tradesperson.tempTraderMedia') }}";
        var params = {
            file_related_to: 'trader_img',
            file_type: 'image',
        };
        let html = `<h6><strong>Images:</strong> .gif .heic .jpeg, .jpg .png .svg .webp</h6>`;
        var acceptedFiles = "{{ config('const.dropzone_accepted_image') }}";

        $('#multiModal .accepted-file-list').html(html);
        $('#multiModal').modal('show');

        var dropzone = callDropzone(url, params, acceptedFiles);

        dropzone.on("success", function(file, response) {
            let html = `<div class="d-inline mr-3">${response.file_name}</div>`;
            $('#uploaded_trader_img').append(html);
        });
    }
    // Dropzone Js For Trader Image Identification Upload Ends

    // Dropzone Js For Trader Address Proof Upload Starts
    // let trader_addr_dropzone = new Dropzone("#trader_addr_dropzone", {
    //     url: "{{-- route('tradesperson.storeCompAddr') --}}",
    //     params: {
    //         file_related_to: 'company_address',
    //     },
    //     uploadMultiple: false,
    //     maxFiles: 1,
    //     // maxFilesize: {{ env('CUSTOMER_PROFILE_IMAGE_SIZE') }},
    //     // acceptedFiles: "image/jpeg, image/png, image/svg+xml, image/webp, application/pdf",
    //     maxFilesize: {{ config('const.dropzone_max_file_size') }},
    //     acceptedFiles: "{{ config('const.dropzone_accepted_file') }}",
    //     thumbnailWidth: 240,
    //     thumbnailHeight: 240,
    //     autoProcessQueue: false,
    //     previewsContainer: "#trader_addr_dropzone",
    //     clickable: "#trader_addr_upload_btn",
    //     dictDefaultMessage: "",
    //     init: function() {
    //         let dz = this;
    //         let uploadButton = $("#upload_trader_addr");

    //         this.on("addedfile", function(file) {
    //             if (this.files.length > 1) {
    //                 dz.removeFile(this.files[0]);
    //             }
    //             // $("#trader_addr_dropzone").find(".dz-message").css("display", "none");
    //             // $(file.previewElement).find(".dz-error-mark, .dz-success-mark, .dz-error-message, .dz-progress").css("display", "none");
    //             $("#trader_addr_dropzone").find(".dz-message").hide();
    //             $(file.previewElement).find(".dz-error-mark, .dz-success-mark, .dz-error-message, .dz-progress").hide();
    //             updateUploadButton();
    //         });

    //         this.on("removedfile", function(file) {
    //             updateUploadButton();
    //         });

    //         this.on("thumbnail", function(file, dataUrl) {
    //             // $("#trader_addr_dropzone").find(".dz-message").css("display", "none");
    //             // $(file.previewElement).find(".dz-error-mark, .dz-success-mark, .dz-error-message, .dz-progress").css("display", "none");
    //             // $(file.previewElement).find(".dz-image img").css({
    //             //     "border-radius": "5%",
    //             //     "transition": "none"
    //             // });
    //             $("#trader_addr_dropzone").find(".dz-message").hide();
    //             $(file.previewElement).find(".dz-error-mark, .dz-success-mark, .dz-error-message, .dz-progress").hide();
    //             $(file.previewElement).find(".dz-image img").addClass('dropzone-preview-thumbnail');
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
    //             let html = `<div class="d-inline mr-3">${response.file_name}</div>`;
    //             // $(file.previewElement).find(".dz-progress").css("display", "none");
    //             // $(file.previewElement).find(".dz-success-mark").css("display", "block");
    //             $(file.previewElement).find(".dz-progress").hide();
    //             $(file.previewElement).find(".dz-success-mark").show();
    //             $('#uploaded_trader_addr').empty();
    //             $('#uploaded_trader_addr').append(html);
    //             updateUploadButton();
    //         });

    //         this.on("error", function(file, errorMessage) {
    //             // $(file.previewElement).find(".dz-progress").css("display", "none");
    //             // $(file.previewElement).find(".dz-error-message").text(errorMessage).css("display", "block");
    //             // $(file.previewElement).find(".dz-error-mark").css("display", "block");
    //             $(file.previewElement).find(".dz-progress").hide();
    //             $(file.previewElement).find(".dz-error-message").text(errorMessage).show();
    //             $(file.previewElement).find(".dz-error-mark").show();
    //             updateUploadButton();
    //         });

    //         function updateUploadButton() {
    //             let maxFileSize = dz.options.maxFilesize ? dz.options.maxFilesize * 1024 * 1024 : (2 * 1024 * 1024);
    //             let acceptedFileTypes = dz.options.acceptedFiles;
    //             $('.supported_ .invalid-file').empty();
    //             $('.supported_ .dropzone-messages').empty();

    //             let file = dz.files[0];

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
    //                         $('.supported_ .dropzone-messages').empty();
    //                         $('.dz-error-message').empty();
    //                         $('.dz-success-mark').empty();
    //                         $('.dz-error-mark').empty();
    //                         $('.dz-details').empty();
    //                         // $('.dz-message').css("display", "block");
    //                         $('.dz-message').show();
    //                         errorMessage.push("Invalid file type. Please select a valid file.");
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

    //         $("#traderImgDropzoneModal").on("hidden.bs.modal", function() {
    //             // $("#trader_img_dropzone").find(".dz-message").css("display", "block");
    //             $("#trader_img_dropzone").find(".dz-message").show();
    //             $("#trader_img_dropzone .supported_ .invalid-file").empty();
    //             $("#trader_img_dropzone .supported_ .dropzone-messages").empty();
    //             dz.removeAllFiles();
    //         });
    //     }

    // });
    function comp_addr_proof() {
        // var url = "{{-- route('tradesperson.storeCompAddr') --}}";
        var url = "{{ route('tradesperson.tempTraderMedia') }}";
        var params = {
            file_related_to: 'company_address',
            file_type: 'image',
        };
        let html = `<h6><strong>Images:</strong> .gif .heic .jpeg, .jpg .png .svg .webp</h6>`;
        var acceptedFiles = "{{ config('const.dropzone_accepted_image') }}";

        $('#multiModal .accepted-file-list').html(html);
        $('#multiModal').modal('show');

        var dropzone = callDropzone(url, params, acceptedFiles);

        dropzone.on("success", function(file, response) {
            let html = `<div class="d-inline mr-3">${response.file_name}</div>`;
            $('#uploaded_trader_addr').append(html);
        });
    }
    // Dropzone Js For Trader Address Proof Upload Ends

    // Dropzone Js For Team Photo Upload Starts
    // let team_photo_dropzone = new Dropzone("#team_photo_dropzone", {
    //     url: "{{-- route('tradesperson.storeTeamPhoto') --}}",
    //     params: {
    //         file_related_to: 'team_img',
    //         file_type: 'image',
    //     },
    //     maxFiles: 6,
    //     // maxFilesize: {{ env('CUSTOMER_PROFILE_IMAGE_SIZE') }},
    //     // acceptedFiles: "{{ env('CUSTOMER_PROFILE_IMAGE_ACCEPTED_FILE_TYPES') }}",
    //     maxFilesize: {{ config('const.dropzone_max_file_size') }},
    //     acceptedFiles: "{{ config('const.dropzone_accepted_image') }}",
    //     thumbnailWidth: 240,
    //     thumbnailHeight: 240,
    //     previewsContainer: "#team_photo_dropzone",
    //     clickable: "#team_photo_upload_btn",
    //     init: function() {
    //         let dz = this;

    //         $("#teamPhotoModal").on("hidden.bs.modal", function() {
    //             // $("#trader_img_dropzone").find(".dz-message").css("display", "block");
    //             $("#trader_img_dropzone").find(".dz-message").show();
    //             $("#trader_img_dropzone .supported_ .invalid-file").empty();
    //             $("#trader_img_dropzone .supported_ .dropzone-messages").empty();
    //             dz.removeAllFiles();
    //         });

    //         this.on("success", function(file, response) {
    //             // let html = `<div class="d-inline mr-3">${response.file_name}</div>`;
    //             let html = `<div class="d-inline mr-3"><a href="#"><img src="${response.image_link}" /></a></div>`;
    //             $('#uploaded_team_photo').append(html);
    //         });
    //     }
    // });
    function team_photo_upload() {
        // var url    = "{{-- route('tradesperson.storeTeamPhoto') --}}";
        var url = "{{ route('tradesperson.tempTraderMedia') }}";
        var params = {
            file_related_to: 'team_img',
            file_type: 'image',
        };
        var maxFileSize = {{ config('const.dropzone_max_file_size') }};
        var acceptedFiles = "{{ config('const.dropzone_accepted_image') }}";
        let html = `<h6><strong>Images:</strong> .gif .heic .jpeg, .jpg .png .svg .webp</h6>`;

        $('#multiModal .accepted-file-list').html(html);
        $('#multiModal').modal('show');

        var dropzone = callDropzone(url, params, acceptedFiles, maxFileSize);

        dropzone.on("success", function(file, response) {
            let html = `<div class="d-inline mr-3"><a href="#"><img src="${response.image_link}" class="rectangle-img mb-1" /></a></div>`;
            $('#uploaded_team_photo').append(html);
        });
    }
    // Dropzone Js For Team Photo Upload Ends


    // Dropzone Js For Previous Project Upload Starts
    // let prev_proj_dropzone = new Dropzone("#prev_proj_dropzone", {
    //     url: "{{-- route('tradesperson.storePrevProj') --}}",
    //     params: {
    //         file_related_to: 'prev_project_img',
    //         file_type: 'image',
    //     },
    //     maxFiles: 6,
    //     // maxFilesize: {{ env('CUSTOMER_PROFILE_IMAGE_SIZE') }},
    //     // acceptedFiles: "{{ env('CUSTOMER_PROFILE_IMAGE_ACCEPTED_FILE_TYPES') }}",
    //     maxFilesize: {{ config('const.dropzone_max_file_size') }},
    //     acceptedFiles: "{{ config('const.dropzone_accepted_image') }}",
    //     thumbnailWidth: 240,
    //     thumbnailHeight: 240,
    //     previewsContainer: "#prev_proj_dropzone",
    //     clickable: "#prev_proj_upload_btn",
    //     init: function() {
    //         let dz = this;

    //         $("#prevProjModal").on("hidden.bs.modal", function() {
    //             // $("#prev_proj_dropzone").find(".dz-message").css("display", "block");
    //             $("#prev_proj_dropzone").find(".dz-message").show();
    //             $("#prev_proj_dropzone .supported_ .invalid-file").empty();
    //             $("#prev_proj_dropzone .supported_ .dropzone-messages").empty();
    //             dz.removeAllFiles();
    //         });

    //         this.on("success", function(file, response) {
    //             // let html = `<div class="d-inline mr-3">${response.file_name}</div>`;
    //             let html = `<div class="d-inline mr-3"><a href="#"><img src="${response.image_link}" /></a></div>`;
    //             $('#uploaded_prev_proj').append(html);
    //         });
    //     }
    // });
    function prev_proj_upload() {
        // var url    = "{{-- route('tradesperson.storePrevProj') --}}";
        var url = "{{ route('tradesperson.tempTraderMedia') }}";
        var params = {
            file_related_to: 'prev_project_img',
            file_type: 'image',
        };
        var maxFileSize = {{ config('const.dropzone_max_file_size') }};
        var acceptedFiles = "{{ config('const.dropzone_accepted_image') }}";
        let html = `<h6><strong>Images:</strong> .gif .heic .jpeg, .jpg .png .svg .webp</h6>`;

        $('#multiModal .accepted-file-list').html(html);
        $('#multiModal').modal('show');

        var dropzone = callDropzone(url, params, acceptedFiles, maxFileSize);

        dropzone.on("success", function(file, response) {
            let html = `<div class="d-inline mr-3"><a href="#"><img src="${response.image_link}" class="rectangle-img mb-1" /></a></div>`;
            $('#uploaded_prev_proj').append(html);
        });
    }
    // Dropzone Js For Previous Project Upload Ends


</script>

@endpush



@endsection
