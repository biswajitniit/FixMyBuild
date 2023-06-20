@extends('layouts.app')

@section('content')
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
                <button type="button" class="btn btn-light" onclick="deleteFile()" id="confirmedDelete">Yes</button>
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">No</button>
            </div>
        </div>
    </div>
</div>
<!-- Delete Image Modal END -->

{{-- Team Photos Upload Modal Starts --}}
<div class="modal fade select_address" id="teamPhotoModal" tabindex="-1" aria-labelledby="teamPhotoModal" aria-hidden="true">
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
                    {{-- <div class="text-center upload_wrap">
                        <img src="{{ asset('frontend/img/upload.svg') }}" alt="">
                        <p>Drag and drop files here</p>
                        <h4>OR</h4>
                        <button type="button" class="btn btn-light mt-3" style="width:180px;">Browse files</button>
                    </div> --}}
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
</div>
{{-- Team Photos Upload Modal Ends --}}

{{-- Previous Project Upload Modal Starts --}}
<div class="modal fade select_address" id="prevProjModal" tabindex="-1" aria-labelledby="prevProjModal" aria-hidden="true">
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
                    {{-- <div class="text-center upload_wrap">
                        <img src="{{ asset('frontend/img/upload.svg') }}" alt="">
                        <p>Drag and drop files here</p>
                        <h4>OR</h4>
                        <button type="button" class="btn btn-light mt-3" style="width:180px;">Browse files</button>
                    </div> --}}
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
</div>
{{-- Previous Project Upload Modal Ends --}}

{{-- Public liability insurance Modal Starts --}}
<div class="modal fade select_address" id="pliModal" tabindex="-1" aria-labelledby="pliModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="pliModalLabel">Upload files</h5>
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
                    <form method="post" enctype="multipart/form-data" id="pli_dropzone" class="dropzone text-center upload_wrap cpp_wrap">
                        @csrf
                        <div class="dz-default dz-message">
                            <img src="{{ asset('frontend/img/upload.svg') }}" alt="" />
                            <p>Drag and drop a file here</p>
                            <h4>OR</h4>
                            <button type="button" id="pli_upload_btn" class="btn btn-light mt-3" style="width: 180px;">Browse files</button>
                        </div>
                    </form>
                </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-link" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-light" id="upload_pli">Upload</button>
            </div>
        </div>
    </div>
</div>
{{-- Public liability insurance Upload Modal Ends --}}

<!--Code area start-->
<section>
   <div class="container">
      <div class="row">
         <div class="col-md-12 text-center pt-5 fmb_titel">
            <h1>My profile</h1>
            <ol class="breadcrumb mb-5">
               <li class="breadcrumb-item">
                  <a href="{{route('home')}}">Home</a>
               </li>
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
               <li @if(Route::is('tradepersion.dashboard')) class="active" @endif>
                  <a href="{{route('tradepersion.dashboard')}}">Profile</a>
               </li>
               <li @if(Route::is('tradepersion.projects')) class="active" @endif>
                  <a href="{{route('tradepersion.projects')}}">Projects</a>
               </li>
               <li @if(Route::is('tradepersion.settings')) class="active" @endif>
                  <a href="{{route('tradepersion.settings')}}">Settings</a>
               </li>
               <li>
                  <a href="javascript:void(0)">Logout</a>
               </li>
            </ul>
         </div>
         <div class="col-md-9  dashboard_wrapper">
            <div class="blue-font-color mt-4 mb-5">
               <div class="row">
                  <div class="col-md-3 profile_pics">
                     <img src="@if($company_logo) {{ $company_logo->url }} @endif" alt="">
                     <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#profile_pics">
                        <img src="{{asset('frontend/img/edit-pics.svg')}}" alt="" class="edit-pics">
                     </a>
                     <!-- The Modal Change profile photo-->
                     {{-- <div class="modal fade select_address" id="profile_pics" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                           <div class="modal-content">
                              <div class="modal-header pb-0">
                                 <h5 class="modal-title" id="exampleModalLabel">Change profile photo</h5>
                                 <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                    <svg width="19" height="19" viewBox="0 0 19 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                                       <path d="M2.26683 18.5416L0.458496 16.7333L7.69183 9.49992L0.458496 2.26659L2.26683 0.458252L9.50016 7.69159L16.7335 0.458252L18.5418 2.26659L11.3085 9.49992L18.5418 16.7333L16.7335 18.5416L9.50016 11.3083L2.26683 18.5416Z" fill="black" />
                                    </svg>
                                 </button>
                              </div>
                              <div class="modal-body">
                                 <div class="row">
                                    <div class="col-md-12 supported_">
                                       <h5> Supported file type list: <div class="ext_">.gif .heic .jpeg, .jpg .png .svg .webp</div>
                                       </h5>
                                       <div class="text-center upload_wrap cpp_wrap">
                                          <img src="{{asset('frontend/img/upload.svg')}}" alt="">
                                          <p>Drag and drop files here</p>
                                          <h4>OR</h4>
                                          <button type="button" class="btn btn-light mt-3" style="width:180px;">Browse files</button>
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
                     </div> --}}
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
                                            <form method="post" enctype="multipart/form-data" id="avatar_dropzone" class="dropzone text-center upload_wrap cpp_wrap">
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
                    </div>
                     <!-- The Modal Change profile photo END-->
                  </div>
                  <div class="col-md-9">
                     <div class="row acme-ltd-wrap">
                        <div class="col-md-9">
                           <h4>Registration number: {{$trader_details->comp_reg_no}}</h4>
                           <h2>{{$trader_details->comp_name}}</h2>
                           <h5>{{$trader_details->comp_address}}</h5>
                        </div>
                        <div class="col-md-3 mt-4">
                           <a href="javascript:void(0)" class="btn btn-refresh" onclick="refreshPage()">Refresh</a>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <div class="white_bg mb-5">
               <div class="row">
                  <div class="col-md-12">
                     <h3>Trading name</h3>
                  </div>
                  <div class="col-md-12 mb-4">
                     <div style="display: block;" id="tradername">
                        <h2 class="company-name"><span id="txt-company-name">{{$trader_details->trader_name}}</span><span>
                              <a href="javascript:void(0)" onclick="showTradernameEdit()">
                                 <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M0.5 12.39V14.9223C0.5 15.1556 0.683333 15.3388 0.916667 15.3388H3.45C3.55833 15.3388 3.66667 15.2972 3.74167 15.2139L12.8417 6.12584L9.71667 3.00208L0.625 12.0901C0.541667 12.1734 0.5 12.2734 0.5 12.39ZM15.2583 2.5356L13.3083 0.58638C13.2312 0.509157 13.1397 0.447892 13.0389 0.406091C12.938 0.36429 12.83 0.342773 12.7208 0.342773C12.6117 0.342773 12.5036 0.36429 12.4028 0.406091C12.302 0.447892 12.2104 0.509157 12.1333 0.58638L10.6083 2.11077L13.7333 5.23452L15.2583 3.71013C15.3356 3.63307 15.3969 3.54153 15.4387 3.44076C15.4805 3.33999 15.502 3.23196 15.502 3.12287C15.502 3.01377 15.4805 2.90575 15.4387 2.80497C15.3969 2.7042 15.3356 2.61267 15.2583 2.5356Z" fill="#061A48" />
                                 </svg>
                              </a>
                           </span>
                        </h2>
                     </div>
                     <div style="display:none;" id="tradernameedit">
                        <h2 class="company-name">
                           <input type="text" value="{{$trader_details->trader_name}}" id="editTraderName">
                           <p id="editTraderNameResp"></p>
                        </h2>
                        <span class="acme_right">
                           <a href="javascript:void(0)" onclick="updateTraderName()">
                              <svg width="19" height="15" viewBox="0 0 19 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                 <path d="M18.8747 2.29199L6.37467 14.792L0.645508 9.06283L2.11426 7.59408L6.37467 11.8441L17.4059 0.823242L18.8747 2.29199Z" fill="#6D717A" />
                              </svg>
                           </a>
                           <a href="javascript:void(0)" id="closeTradename">
                              <svg width="15" height="15" viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                 <path fill-rule="evenodd" clip-rule="evenodd" d="M14.6363 1.71967C14.7254 1.6307 14.7961 1.52506 14.8444 1.40877C14.8926 1.29248 14.9175 1.16783 14.9176 1.04193C14.9176 0.916028 14.8929 0.791345 14.8448 0.674998C14.7967 0.558651 14.7261 0.452919 14.6372 0.363839C14.5482 0.274759 14.4426 0.204076 14.3263 0.155824C14.21 0.107573 14.0853 0.0826979 13.9594 0.0826205C13.8335 0.0825432 13.7088 0.107265 13.5925 0.155373C13.4761 0.203482 13.3704 0.274035 13.2813 0.363006L7.49967 6.14467L1.71967 0.363006C1.53977 0.183101 1.29576 0.0820312 1.04134 0.0820312C0.786915 0.0820313 0.542911 0.183101 0.363006 0.363006C0.183101 0.542911 0.0820313 0.786915 0.0820312 1.04134C0.0820312 1.29576 0.183101 1.53977 0.363006 1.71967L6.14467 7.49967L0.363006 13.2797C0.273926 13.3688 0.203264 13.4745 0.155054 13.5909C0.106844 13.7073 0.0820312 13.832 0.0820312 13.958C0.0820312 14.084 0.106844 14.2087 0.155054 14.3251C0.203264 14.4415 0.273926 14.5473 0.363006 14.6363C0.542911 14.8162 0.786915 14.9173 1.04134 14.9173C1.16732 14.9173 1.29206 14.8925 1.40845 14.8443C1.52484 14.7961 1.63059 14.7254 1.71967 14.6363L7.49967 8.85467L13.2813 14.6363C13.4612 14.816 13.7052 14.9169 13.9594 14.9167C14.2137 14.9166 14.4575 14.8154 14.6372 14.6355C14.8169 14.4556 14.9177 14.2117 14.9176 13.9574C14.9174 13.7031 14.8162 13.4594 14.6363 13.2797L8.85467 7.49967L14.6363 1.71967Z" fill="#6D717A" />
                              </svg>
                           </a>
                        </span>
                     </div>
                  </div>
                  <div class="col-md-12">
                     <h3>Description</h3>
                  </div>
                  <div class="mt-2 company-desp" style="display:block;" id="compdesc">
                    <div id="txtCompDesc">
                        {!! $trader_details->comp_description !!}
                    </div>
                     <a href="javascript:void(0)" class="change_" id="descChange">Change</a>
                  </div>
                  <div class="mt-2 company-desp" style="display:none;" id="compdescEdit">
                     <textarea id="summernote" name="comp_description">{{$trader_details->comp_description}}</textarea>
                     <p id="editTraderDescResp"></p>
                     <a href="javascript:void(0)" class="save_" onclick="updateTraderDesc()">Save</a>
                     <a href="javascript:void(0)" class="cancel_" id="descCancel">Cancel</a>
                  </div>
                  <div class="row">
                     <div class="col-md-6 mb-5 mt-3">
                        <h3>Team photo(s)</h3>
                        <div class="row">
                           <div class="pv_top mt-2" id="teamPhotosContainer">
                            @foreach($team_images as $team_img)
                            <div class="d-inline mr-2" id="teamImage-{{ $team_img->id }}">
                                <a href="javascript:void(0)" class="mb-1" onclick="confirmDeletePopup({{ $team_img->id }}, 'teamImage-{{ $team_img->id }}')">
                                   <img src="{{$team_img->url}}" alt="" class="rectangle-img">
                                   <div class="remove_img">
                                      <svg width="22" height="23" viewBox="0 0 22 23" fill="none" xmlns="http://www.w3.org/2000/svg">
                                         <path d="M3.28033 0.54L11.0003 8.26L18.6803 0.58C18.85 0.399435 19.0543 0.254989 19.2812 0.155324C19.508 0.0556597 19.7526 0.00282869 20.0003 0C20.5308 0 21.0395 0.210714 21.4145 0.585786C21.7896 0.960859 22.0003 1.46957 22.0003 2C22.005 2.2452 21.9595 2.48877 21.8666 2.71576C21.7738 2.94275 21.6355 3.14837 21.4603 3.32L13.6803 11L21.4603 18.78C21.79 19.1025 21.9832 19.5392 22.0003 20C22.0003 20.5304 21.7896 21.0391 21.4145 21.4142C21.0395 21.7893 20.5308 22 20.0003 22C19.7454 22.0106 19.4911 21.968 19.2536 21.8751C19.016 21.7821 18.8003 21.6408 18.6203 21.46L11.0003 13.74L3.30033 21.44C3.13134 21.6145 2.92945 21.7539 2.70633 21.85C2.4832 21.9461 2.24325 21.9971 2.00033 22C1.46989 22 0.961185 21.7893 0.586112 21.4142C0.211039 21.0391 0.000325413 20.5304 0.000325413 20C-0.00433758 19.7548 0.0411562 19.5112 0.134015 19.2842C0.226874 19.0572 0.36514 18.8516 0.540325 18.68L8.32032 11L0.540325 3.22C0.210695 2.89752 0.0174046 2.46082 0.000325413 2C0.000325413 1.46957 0.211039 0.960859 0.586112 0.585786C0.961185 0.210714 1.46989 0 2.00033 0C2.48033 0.006 2.94033 0.2 3.28033 0.54Z" fill="white" />
                                      </svg>
                                   </div>
                                </a>
                             </div>
                            @endforeach
                              {{-- <div class="d-inline mr-2">
                                 <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#Delete_wp">
                                    <img src="{{asset('frontend/img/Rectangle 63.jpg')}}" alt="">
                                    <div class="remove_img">
                                       <svg width="22" height="23" viewBox="0 0 22 23" fill="none" xmlns="http://www.w3.org/2000/svg">
                                          <path d="M3.28033 0.54L11.0003 8.26L18.6803 0.58C18.85 0.399435 19.0543 0.254989 19.2812 0.155324C19.508 0.0556597 19.7526 0.00282869 20.0003 0C20.5308 0 21.0395 0.210714 21.4145 0.585786C21.7896 0.960859 22.0003 1.46957 22.0003 2C22.005 2.2452 21.9595 2.48877 21.8666 2.71576C21.7738 2.94275 21.6355 3.14837 21.4603 3.32L13.6803 11L21.4603 18.78C21.79 19.1025 21.9832 19.5392 22.0003 20C22.0003 20.5304 21.7896 21.0391 21.4145 21.4142C21.0395 21.7893 20.5308 22 20.0003 22C19.7454 22.0106 19.4911 21.968 19.2536 21.8751C19.016 21.7821 18.8003 21.6408 18.6203 21.46L11.0003 13.74L3.30033 21.44C3.13134 21.6145 2.92945 21.7539 2.70633 21.85C2.4832 21.9461 2.24325 21.9971 2.00033 22C1.46989 22 0.961185 21.7893 0.586112 21.4142C0.211039 21.0391 0.000325413 20.5304 0.000325413 20C-0.00433758 19.7548 0.0411562 19.5112 0.134015 19.2842C0.226874 19.0572 0.36514 18.8516 0.540325 18.68L8.32032 11L0.540325 3.22C0.210695 2.89752 0.0174046 2.46082 0.000325413 2C0.000325413 1.46957 0.211039 0.960859 0.586112 0.585786C0.961185 0.210714 1.46989 0 2.00033 0C2.48033 0.006 2.94033 0.2 3.28033 0.54Z" fill="white" />
                                       </svg>
                                    </div>
                                 </a>
                              </div>
                              <div class="d-inline mr-2">
                                 <a href="javascript:void(0)">
                                    <img src="{{asset('frontend/img/Rectangle 62.jpg')}}" alt="">
                                    <div class="remove_img">
                                       <svg width="22" height="23" viewBox="0 0 22 23" fill="none" xmlns="http://www.w3.org/2000/svg">
                                          <path d="M3.28033 0.54L11.0003 8.26L18.6803 0.58C18.85 0.399435 19.0543 0.254989 19.2812 0.155324C19.508 0.0556597 19.7526 0.00282869 20.0003 0C20.5308 0 21.0395 0.210714 21.4145 0.585786C21.7896 0.960859 22.0003 1.46957 22.0003 2C22.005 2.2452 21.9595 2.48877 21.8666 2.71576C21.7738 2.94275 21.6355 3.14837 21.4603 3.32L13.6803 11L21.4603 18.78C21.79 19.1025 21.9832 19.5392 22.0003 20C22.0003 20.5304 21.7896 21.0391 21.4145 21.4142C21.0395 21.7893 20.5308 22 20.0003 22C19.7454 22.0106 19.4911 21.968 19.2536 21.8751C19.016 21.7821 18.8003 21.6408 18.6203 21.46L11.0003 13.74L3.30033 21.44C3.13134 21.6145 2.92945 21.7539 2.70633 21.85C2.4832 21.9461 2.24325 21.9971 2.00033 22C1.46989 22 0.961185 21.7893 0.586112 21.4142C0.211039 21.0391 0.000325413 20.5304 0.000325413 20C-0.00433758 19.7548 0.0411562 19.5112 0.134015 19.2842C0.226874 19.0572 0.36514 18.8516 0.540325 18.68L8.32032 11L0.540325 3.22C0.210695 2.89752 0.0174046 2.46082 0.000325413 2C0.000325413 1.46957 0.211039 0.960859 0.586112 0.585786C0.961185 0.210714 1.46989 0 2.00033 0C2.48033 0.006 2.94033 0.2 3.28033 0.54Z" fill="white" />
                                       </svg>
                                    </div>
                                 </a>
                              </div> --}}
                              <div class="d-inline mr-2" id="addTeamPhotos">
                                 <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#teamPhotoModal">
                                    <div class="add_">
                                       <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                          <path d="M10.334 23.3514V13.3554H0.333984V10.0234H10.334V0.0273438H13.6673V10.0234H23.6673V13.3554H13.6673V23.3514H10.334Z" fill="#EE5719" />
                                       </svg>
                                    </div>
                                 </a>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="col-md-6 mb-5 mt-3">
                        <h3>Photo(s) of previous project(s)</h3>
                        <div class="row">
                           <div class="pv_top mt-2" id="teamPhotos">
                            @foreach ($prev_project_images as $prev_project_img)
                                <div class="d-inline mr-2" id="prevProjectImage-{{ $prev_project_img->id }}">
                                    <a href="javascript:void(0)" class="mb-1" onclick="confirmDeletePopup({{ $prev_project_img->id }}, 'prevProjectImage-{{ $prev_project_img->id }}')">
                                    <img src="{{ $prev_project_img->url }}" alt="" class="rectangle-img">
                                    <div class="remove_img">
                                        <svg width="22" height="23" viewBox="0 0 22 23" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M3.28033 0.54L11.0003 8.26L18.6803 0.58C18.85 0.399435 19.0543 0.254989 19.2812 0.155324C19.508 0.0556597 19.7526 0.00282869 20.0003 0C20.5308 0 21.0395 0.210714 21.4145 0.585786C21.7896 0.960859 22.0003 1.46957 22.0003 2C22.005 2.2452 21.9595 2.48877 21.8666 2.71576C21.7738 2.94275 21.6355 3.14837 21.4603 3.32L13.6803 11L21.4603 18.78C21.79 19.1025 21.9832 19.5392 22.0003 20C22.0003 20.5304 21.7896 21.0391 21.4145 21.4142C21.0395 21.7893 20.5308 22 20.0003 22C19.7454 22.0106 19.4911 21.968 19.2536 21.8751C19.016 21.7821 18.8003 21.6408 18.6203 21.46L11.0003 13.74L3.30033 21.44C3.13134 21.6145 2.92945 21.7539 2.70633 21.85C2.4832 21.9461 2.24325 21.9971 2.00033 22C1.46989 22 0.961185 21.7893 0.586112 21.4142C0.211039 21.0391 0.000325413 20.5304 0.000325413 20C-0.00433758 19.7548 0.0411562 19.5112 0.134015 19.2842C0.226874 19.0572 0.36514 18.8516 0.540325 18.68L8.32032 11L0.540325 3.22C0.210695 2.89752 0.0174046 2.46082 0.000325413 2C0.000325413 1.46957 0.211039 0.960859 0.586112 0.585786C0.961185 0.210714 1.46989 0 2.00033 0C2.48033 0.006 2.94033 0.2 3.28033 0.54Z" fill="white" />
                                        </svg>
                                    </div>
                                    </a>
                                </div>
                            @endforeach
                              <div class="d-inline mr-2" id="addPrevProj">
                                 <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#prevProjModal">
                                    <div class="add_">
                                       <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                          <path d="M10.334 23.3514V13.3554H0.333984V10.0234H10.334V0.0273438H13.6673V10.0234H23.6673V13.3554H13.6673V23.3514H10.334Z" fill="#EE5719" />
                                       </svg>
                                    </div>
                                 </a>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <!--// END -->
            <div class="white_bg mb-5">
               <div class="row public_li">
                  <div class="col-md-6">
                     <h3>Public liability insurance</h3>
                     <h5>Held with: <span>INSURER LTD</span>
                     </h5>
                     <h5>Expires on: <span>12/12/2025</span>
                     </h5>
                  </div>
                  <div class="col-md-6 public_li_upload">
                     {{-- <div class="mb-3">
                        <a href="javascript:void(0)" class="btn-pli">pli1.pdf (3MB) <svg width="19" height="24" viewBox="0 0 19 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                              <path d="M17.3125 19.0003V22.3337H1.6875V19.0003H0.125V22.3337C0.125 22.7757 0.28962 23.1996 0.582646 23.5122C0.875671 23.8247 1.2731 24.0003 1.6875 24.0003H17.3125C17.7269 24.0003 18.1243 23.8247 18.4174 23.5122C18.7104 23.1996 18.875 22.7757 18.875 22.3337V19.0003H17.3125ZM17.3125 10.667L16.2109 9.49199L10.2812 15.8087V0.666992H8.71875V15.8087L2.78906 9.49199L1.6875 10.667L9.5 19.0003L17.3125 10.667Z" fill="#6D717A" />
                           </svg>
                        </a>
                        <a href="javascript:void(0)">
                           <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                              <path d="M17 17L1 1M17 1L1 17" stroke="#6D717A" stroke-width="2" stroke-linecap="round" />
                           </svg>
                        </a>
                     </div> --}}
                     @foreach ($public_liability_insurances as $public_liability_insurance)
                     <div class="mb-3" id="publicLiabilityInsurance-{{ $public_liability_insurance->id }}">
                        <a href="{{ $public_liability_insurance->url }}" class="btn-pli" target="_blank">
                            {{ Str::limit($public_liability_insurance->file_name, 15, '...') }}
                            <svg width="19" height="24" viewBox="0 0 19 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                              <path d="M17.3125 19.0003V22.3337H1.6875V19.0003H0.125V22.3337C0.125 22.7757 0.28962 23.1996 0.582646 23.5122C0.875671 23.8247 1.2731 24.0003 1.6875 24.0003H17.3125C17.7269 24.0003 18.1243 23.8247 18.4174 23.5122C18.7104 23.1996 18.875 22.7757 18.875 22.3337V19.0003H17.3125ZM17.3125 10.667L16.2109 9.49199L10.2812 15.8087V0.666992H8.71875V15.8087L2.78906 9.49199L1.6875 10.667L9.5 19.0003L17.3125 10.667Z" fill="#6D717A" />
                           </svg>
                        </a>
                        <a href="javascript:void(0)" onclick="confirmDeletePopup({{ $public_liability_insurance->id }}, 'publicLiabilityInsurance-{{ $public_liability_insurance->id }}')">
                           <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                              <path d="M17 17L1 1M17 1L1 17" stroke="#6D717A" stroke-width="2" stroke-linecap="round" />
                           </svg>
                        </a>
                     </div>
                     @endforeach
                     {{-- <div class="mb-3">
                        <a href="{{ $public_liability_insurance->url }}" class="btn-pli" target="_blank">
                            {{ Str::limit($public_liability_insurance->file_name, 15, '...') }}
                            <svg width="19" height="24" viewBox="0 0 19 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                              <path d="M17.3125 19.0003V22.3337H1.6875V19.0003H0.125V22.3337C0.125 22.7757 0.28962 23.1996 0.582646 23.5122C0.875671 23.8247 1.2731 24.0003 1.6875 24.0003H17.3125C17.7269 24.0003 18.1243 23.8247 18.4174 23.5122C18.7104 23.1996 18.875 22.7757 18.875 22.3337V19.0003H17.3125ZM17.3125 10.667L16.2109 9.49199L10.2812 15.8087V0.666992H8.71875V15.8087L2.78906 9.49199L1.6875 10.667L9.5 19.0003L17.3125 10.667Z" fill="#6D717A" />
                           </svg>
                        </a>
                        <a href="javascript:void(0)">
                           <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                              <path d="M17 17L1 1M17 1L1 17" stroke="#6D717A" stroke-width="2" stroke-linecap="round" />
                           </svg>
                        </a>
                     </div> --}}
                     <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#pliModal" id="addPLIdocs">Upload new file(s)</a>
                  </div>
               </div>
            </div>
            <!--// END -->
            <div class="white_bg mb-5">
               <div class="row contact_trading_">
                  <div class="col-md-12">
                     <h3>Contact </h3>
                  </div>
                  <div id="contactDetails" style="display:block">
                     <div class="row">
                        <div class="col-md-6">
                           <div class="mb-4">
                              <h6>Contact name</h6>
                              <h4 id="trader-contact-name">{{$trader_details->name}}</h4>
                           </div>
                           <div>
                              <h6>Mobile number</h6>
                              <div class="form-group  col-md-11 mt-4 pw_">
                                 <input type="text" class="clr-bg form-control" id="mobile" value="{{$trader_details->phone_number}}" readonly>
                                 <em>
                                    <a href="javascript:void(0)">
                                       <svg width="22" height="19" viewBox="0 0 22 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                                          <path d="M19.8 13V11.5C19.8 10.1 18.4 9 17 9C15.6 9 14.2 10.1 14.2 11.5V13C13.6 13 13 13.6 13 14.2V17.7C13 18.4 13.6 19 14.2 19H19.7C20.4 19 21 18.4 21 17.8V14.3C21 13.6 20.4 13 19.8 13ZM18.5 13H15.5V11.5C15.5 10.7 16.2 10.2 17 10.2C17.8 10.2 18.5 10.7 18.5 11.5V13ZM14 8C13.1 8.7 12.5 9.6 12.3 10.7C11.9 10.9 11.5 11 11 11C9.3 11 8 9.7 8 8C8 6.3 9.3 5 11 5C12.7 5 14 6.3 14 8ZM11 15.5C6 15.5 1.7 12.4 0 8C1.7 3.6 6 0.5 11 0.5C16 0.5 20.3 3.6 22 8C21.8 8.5 21.5 9 21.3 9.5C20.9 8.8 20.4 8.2 19.7 7.8C18 4.5 14.7 2.5 11 2.5C7.2 2.5 3.8 4.6 2.2 8C3.9 11.4 7.3 13.5 11 13.5H11.1C11 13.7 11 14 11 14.2V15.5Z" fill="#BDBDBD" />
                                       </svg>
                                    </a>
                                 </em>
                                 <div class="no_dissible"></div>
                              </div>
                           </div>
                        </div>
                        <div class="col-md-6">
                           <div class="mb-4">
                              <h6>Email</h6>
                              <h4 id="trader-email">{{$trader_details->email}}</h4>
                           </div>
                           <div>
                              <h6>Office number</h6>
                              <div class="form-group  col-md-11 mt-4 pw_">
                                 <input type="text" class="clr-bg form-control" id="phone" value="{{$trader_details->phone_office}}" readonly>
                                 <!-- <em><a href="javascript:void(0)"><svg width="22" height="19" viewBox="0 0 22 19" fill="none"
                                                                                                            xmlns="http://www.w3.org/2000/svg"><path d="M19.8 13V11.5C19.8 10.1 18.4 9 17 9C15.6 9 14.2 10.1 14.2 11.5V13C13.6 13 13 13.6 13 14.2V17.7C13 18.4 13.6 19 14.2 19H19.7C20.4 19 21 18.4 21 17.8V14.3C21 13.6 20.4 13 19.8 13ZM18.5 13H15.5V11.5C15.5 10.7 16.2 10.2 17 10.2C17.8 10.2 18.5 10.7 18.5 11.5V13ZM14 8C13.1 8.7 12.5 9.6 12.3 10.7C11.9 10.9 11.5 11 11 11C9.3 11 8 9.7 8 8C8 6.3 9.3 5 11 5C12.7 5 14 6.3 14 8ZM11 15.5C6 15.5 1.7 12.4 0 8C1.7 3.6 6 0.5 11 0.5C16 0.5 20.3 3.6 22 8C21.8 8.5 21.5 9 21.3 9.5C20.9 8.8 20.4 8.2 19.7 7.8C18 4.5 14.7 2.5 11 2.5C7.2 2.5 3.8 4.6 2.2 8C3.9 11.4 7.3 13.5 11 13.5H11.1C11 13.7 11 14 11 14.2V15.5Z" fill="#BDBDBD" /></svg></a></em><div class="no_dissible"></div> -->
                              </div>
                           </div>
                        </div>
                        <a href="javascript:void(0)" class="contact-change" id="changeContact">Has your contact changed?</a>
                     </div>
                  </div>
                  <div class="row" id="contactDetailsEdit" style="display:none">
                     <div class="col-md-6">
                        <div class="mb-4">
                           <h6>Contact name</h6>
                           <div class="form-group  col-md-12 pw_ pw2_">
                              <input type="text" class="form-control" value="{{$trader_details->name}}" id="editContactName">
                              <em>
                                 <a href="javascript:void(0)">
                                    <svg width="23" height="18" viewBox="0 0 23 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                       <path d="M22.5 13L17.5 18L14 14.5L15.5 13L17.5 15L21 11.5L22.5 13ZM11 5C11.7956 5 12.5587 5.31607 13.1213 5.87868C13.6839 6.44129 14 7.20435 14 8C14 8.79565 13.6839 9.55871 13.1213 10.1213C12.5587 10.6839 11.7956 11 11 11C10.2044 11 9.44129 10.6839 8.87868 10.1213C8.31607 9.55871 8 8.79565 8 8C8 7.20435 8.31607 6.44129 8.87868 5.87868C9.44129 5.31607 10.2044 5 11 5ZM11 0.5C16 0.5 20.27 3.61 22 8C21.75 8.65 21.44 9.26 21.08 9.85C20.4949 9.496 19.8516 9.24882 19.18 9.12L19.82 8C19.0117 6.34969 17.7567 4.95925 16.1975 3.98675C14.6383 3.01424 12.8376 2.49868 11 2.49868C9.1624 2.49868 7.36165 3.01424 5.80248 3.98675C4.24331 4.95925 2.98825 6.34969 2.18 8C2.98844 9.65006 4.24357 11.0402 5.80273 12.0125C7.36189 12.9848 9.16254 13.5001 11 13.5L12.21 13.43C12.07 13.93 12 14.46 12 15V15.46L11 15.5C6 15.5 1.73 12.39 0 8C1.73 3.61 6 0.5 11 0.5Z" fill="#EE5719" />
                                    </svg>
                                 </a>
                              </em>
                           </div>
                        </div>
                        <div>
                           <h6>Mobile number</h6>
                           <div class="form-group  col-md-12 pw_ pw2_">
                              <input type="text" class="form-control" value="{{$trader_details->phone_number}}" id="editContactMobile">
                              <em>
                                 <a href="javascript:void(0)">
                                    <svg width="23" height="18" viewBox="0 0 23 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                       <path d="M22.5 13L17.5 18L14 14.5L15.5 13L17.5 15L21 11.5L22.5 13ZM11 5C11.7956 5 12.5587 5.31607 13.1213 5.87868C13.6839 6.44129 14 7.20435 14 8C14 8.79565 13.6839 9.55871 13.1213 10.1213C12.5587 10.6839 11.7956 11 11 11C10.2044 11 9.44129 10.6839 8.87868 10.1213C8.31607 9.55871 8 8.79565 8 8C8 7.20435 8.31607 6.44129 8.87868 5.87868C9.44129 5.31607 10.2044 5 11 5ZM11 0.5C16 0.5 20.27 3.61 22 8C21.75 8.65 21.44 9.26 21.08 9.85C20.4949 9.496 19.8516 9.24882 19.18 9.12L19.82 8C19.0117 6.34969 17.7567 4.95925 16.1975 3.98675C14.6383 3.01424 12.8376 2.49868 11 2.49868C9.1624 2.49868 7.36165 3.01424 5.80248 3.98675C4.24331 4.95925 2.98825 6.34969 2.18 8C2.98844 9.65006 4.24357 11.0402 5.80273 12.0125C7.36189 12.9848 9.16254 13.5001 11 13.5L12.21 13.43C12.07 13.93 12 14.46 12 15V15.46L11 15.5C6 15.5 1.73 12.39 0 8C1.73 3.61 6 0.5 11 0.5Z" fill="#EE5719" />
                                    </svg>
                                 </a>
                              </em>
                           </div>
                        </div>
                     </div>
                     <div class="col-md-6">
                        <div class="mb-4">
                           <h6>Email</h6>
                           <div class="form-group  col-md-12 pw_ pw2_">
                              <input type="text" class="form-control" value="{{$trader_details->email}}" id="editContactEmail">
                              <em>
                                 <a href="javascript:void(0)">
                                    <svg width="23" height="18" viewBox="0 0 23 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                       <path d="M22.5 13L17.5 18L14 14.5L15.5 13L17.5 15L21 11.5L22.5 13ZM11 5C11.7956 5 12.5587 5.31607 13.1213 5.87868C13.6839 6.44129 14 7.20435 14 8C14 8.79565 13.6839 9.55871 13.1213 10.1213C12.5587 10.6839 11.7956 11 11 11C10.2044 11 9.44129 10.6839 8.87868 10.1213C8.31607 9.55871 8 8.79565 8 8C8 7.20435 8.31607 6.44129 8.87868 5.87868C9.44129 5.31607 10.2044 5 11 5ZM11 0.5C16 0.5 20.27 3.61 22 8C21.75 8.65 21.44 9.26 21.08 9.85C20.4949 9.496 19.8516 9.24882 19.18 9.12L19.82 8C19.0117 6.34969 17.7567 4.95925 16.1975 3.98675C14.6383 3.01424 12.8376 2.49868 11 2.49868C9.1624 2.49868 7.36165 3.01424 5.80248 3.98675C4.24331 4.95925 2.98825 6.34969 2.18 8C2.98844 9.65006 4.24357 11.0402 5.80273 12.0125C7.36189 12.9848 9.16254 13.5001 11 13.5L12.21 13.43C12.07 13.93 12 14.46 12 15V15.46L11 15.5C6 15.5 1.73 12.39 0 8C1.73 3.61 6 0.5 11 0.5Z" fill="#EE5719" />
                                    </svg>
                                 </a>
                              </em>
                           </div>
                        </div>
                        <div>
                           <h6>Office number</h6>
                           <div class="form-group  col-md-12 pw_ pw2_">
                              <input type="text" class="form-control" value="{{$trader_details->phone_office}}" id="editContactOfficeMobile">
                              <em>
                                 <a href="javascript:void(0)">
                                    <svg width="23" height="18" viewBox="0 0 23 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                       <path d="M22.5 13L17.5 18L14 14.5L15.5 13L17.5 15L21 11.5L22.5 13ZM11 5C11.7956 5 12.5587 5.31607 13.1213 5.87868C13.6839 6.44129 14 7.20435 14 8C14 8.79565 13.6839 9.55871 13.1213 10.1213C12.5587 10.6839 11.7956 11 11 11C10.2044 11 9.44129 10.6839 8.87868 10.1213C8.31607 9.55871 8 8.79565 8 8C8 7.20435 8.31607 6.44129 8.87868 5.87868C9.44129 5.31607 10.2044 5 11 5ZM11 0.5C16 0.5 20.27 3.61 22 8C21.75 8.65 21.44 9.26 21.08 9.85C20.4949 9.496 19.8516 9.24882 19.18 9.12L19.82 8C19.0117 6.34969 17.7567 4.95925 16.1975 3.98675C14.6383 3.01424 12.8376 2.49868 11 2.49868C9.1624 2.49868 7.36165 3.01424 5.80248 3.98675C4.24331 4.95925 2.98825 6.34969 2.18 8C2.98844 9.65006 4.24357 11.0402 5.80273 12.0125C7.36189 12.9848 9.16254 13.5001 11 13.5L12.21 13.43C12.07 13.93 12 14.46 12 15V15.46L11 15.5C6 15.5 1.73 12.39 0 8C1.73 3.61 6 0.5 11 0.5Z" fill="#EE5719" />
                                    </svg>
                                 </a>
                              </em>
                           </div>
                        </div>
                     </div>
                     <p id="editTraderContactResp"></p>
                     <div class="col-12">
                        <a href="javascript:void(0)" class="save_" onclick="updateTraderContactInfo()">Save</a>
                        <a href="javascript:void(0)" class="cancel_" id="cancelContactDetails">Cancel</a>
                     </div>
                  </div>
               </div>
            </div>
            <!--// END -->
            <div class="tell_about ukvat-number mb-5">
               <div class="row">
                  <div class="col-md-12">
                     <h5>UK VAT number</h5>
                  </div>
                  <div class="col-md-12" id="vatno">
                     <h2>
                        @if ($trader_details->vat_no)
                            <span>{{$trader_details->vat_no}}</span>
                        @else
                            <span>Add a VAT number</span>
                        @endif
                        <a href="javascript:void(0)" id="changeVAT">
                           <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                              <path d="M0.5 12.8558V15.3881C0.5 15.6214 0.683333 15.8046 0.916667 15.8046H3.45C3.55833 15.8046 3.66667 15.763 3.74167 15.6797L12.8417 6.59166L9.71667 3.4679L0.625 12.5559C0.541667 12.6392 0.5 12.7392 0.5 12.8558ZM15.2583 3.00142L13.3083 1.0522C13.2312 0.974978 13.1397 0.913713 13.0389 0.871911C12.938 0.83011 12.83 0.808594 12.7208 0.808594C12.6117 0.808594 12.5036 0.83011 12.4028 0.871911C12.302 0.913713 12.2104 0.974978 12.1333 1.0522L10.6083 2.57659L13.7333 5.70035L15.2583 4.17595C15.3356 4.09889 15.3969 4.00735 15.4387 3.90658C15.4805 3.80581 15.502 3.69778 15.502 3.58869C15.502 3.47959 15.4805 3.37157 15.4387 3.27079C15.3969 3.17002 15.3356 3.07849 15.2583 3.00142Z" fill="#061A48" />
                           </svg>
                        </a>
                     </h2>
                  </div>
                  <div class="row" style="display:none" id="vatnoEdit">
                     <div class="col-md-8 col-8">
                        <h2>
                           <input type="text" value="{{$trader_details->vat_no}}" id="editVatno">
                        </h2>
                        <p id="editTraderVatResp"></p>
                     </div>
                     <div class="col-md-2 col-4 vat-edit">
                         {{-- <a href="javascript:void(0)" onclick="updateVat()"> --}}
                         <a href="javascript:void(0)" onclick="verifyAndUpdateVat()">
                         <svg width="19" height="15" viewBox="0 0 19 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                              <path d="M18.8737 2.29199L6.3737 14.792L0.644531 9.06283L2.11328 7.59408L6.3737 11.8441L17.4049 0.823242L18.8737 2.29199Z" fill="#061A48" />
                           </svg>
                        </a>
                        <a href="javascript:void(0)" id="closeVAT">
                           <svg width="15" height="15" viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                              <path fill-rule="evenodd" clip-rule="evenodd" d="M14.6363 1.71967C14.7254 1.6307 14.7961 1.52506 14.8444 1.40877C14.8926 1.29248 14.9175 1.16783 14.9176 1.04193C14.9176 0.916028 14.8929 0.791345 14.8448 0.674998C14.7967 0.558651 14.7261 0.452919 14.6372 0.363839C14.5482 0.274759 14.4426 0.204076 14.3263 0.155824C14.21 0.107573 14.0853 0.0826979 13.9594 0.0826205C13.8335 0.0825432 13.7088 0.107265 13.5925 0.155373C13.4761 0.203482 13.3704 0.274035 13.2813 0.363006L7.49967 6.14467L1.71967 0.363006C1.53977 0.183101 1.29576 0.0820312 1.04134 0.0820312C0.786915 0.0820313 0.542911 0.183101 0.363006 0.363006C0.183101 0.542911 0.0820313 0.786915 0.0820312 1.04134C0.0820312 1.29576 0.183101 1.53977 0.363006 1.71967L6.14467 7.49967L0.363006 13.2797C0.273926 13.3688 0.203264 13.4745 0.155054 13.5909C0.106844 13.7073 0.0820312 13.832 0.0820312 13.958C0.0820312 14.084 0.106844 14.2087 0.155054 14.3251C0.203264 14.4415 0.273926 14.5473 0.363006 14.6363C0.542911 14.8162 0.786915 14.9173 1.04134 14.9173C1.16732 14.9173 1.29206 14.8925 1.40845 14.8443C1.52484 14.7961 1.63059 14.7254 1.71967 14.6363L7.49967 8.85467L13.2813 14.6363C13.4612 14.816 13.7052 14.9169 13.9594 14.9167C14.2137 14.9166 14.4575 14.8154 14.6372 14.6355C14.8169 14.4556 14.9177 14.2117 14.9176 13.9574C14.9174 13.7031 14.8162 13.4594 14.6363 13.2797L8.85467 7.49967L14.6363 1.71967Z" fill="#061A48" />
                           </svg>
                        </a>
                     </div>
                  </div>
               </div>
            </div>
            <!--//-->
            <?php
            $traderselected = array();
            $areaselected = array();
            ?>
            <div class="white_bg mb-5">
               <div class="row work-area-wrap">
                  <div class="col-md-6">
                     <h3>Type of work undertaken</h3>
                     <ol id="work-list">
                        @foreach($trader_work as $t)
                        <?php array_push($traderselected, $t->buildersubcategory_id); ?>
                        <li>{{$t->buildersubcategory->builder_subcategory_name}}</li>
                        @endforeach
                     </ol>
                     <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#type-of-work">View more & update</a>

                     <!-- The Modal Work Selection-->
                     <div class="modal fade select_address" id="type-of-work" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-xl">
                           <div class="modal-content">
                              <div class="modal-header">
                                 <h5 class="modal-title" id="exampleModalLabel">Type of work you do</h5>
                                 <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                    <svg width="19" height="19" viewBox="0 0 19 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                                       <path d="M2.26683 18.5416L0.458496 16.7333L7.69183 9.49992L0.458496 2.26659L2.26683 0.458252L9.50016 7.69159L16.7335 0.458252L18.5418 2.26659L11.3085 9.49992L18.5418 16.7333L16.7335 18.5416L9.50016 11.3083L2.26683 18.5416Z" fill="black"/>
                                    </svg>
                                 </button>
                              </div>
                              <div class="modal-body">
                                 <div class="row">
                                    <div class="col-md-4">
                                       <nav class="nav-sidebar">
                                          <ul class="nav tabs">
                                             <?php $i=1; ?>
                                             @foreach($works as $w)
                                             <li class="workchkboxsec @if($i==1) active @endif"><a href="#tab{{$i}}" data-toggle="tab">{{$w->builder_category_name}} <div class="pull-right">{{-- count($w->buildersubcategories) --}}</div></a></li>
                                             <?php $i++; ?>
                                             @endforeach
                                           </ul>
                                       </nav>
                                    </div>
                                    <div class="col-md-8">
                                       <div class="tab-content tab_wrappper" id="work_tab">
                                          <?php $i=1; ?>
                           @foreach($works as $w)
                            <div class="tab-pane text-style @if($i==1) active @endif" id="tab{{$i}}">
                               <div class="wrap">
                                  <div class="search">
                                     <button type="submit" class="searchButton">
                                        <svg width="19" height="20" viewBox="0 0 19 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                           <path fill-rule="evenodd" clip-rule="evenodd" d="M8.59174 2.00025C7.01698 2.00025 5.50672 2.68507 4.3932 3.90406C3.27968 5.12305 2.65411 6.77635 2.65411 8.50025C2.65411 10.2242 3.27968 11.8775 4.3932 13.0964C5.50672 14.3154 7.01698 15.0003 8.59174 15.0003C10.1665 15.0003 11.6768 14.3154 12.7903 13.0964C13.9038 11.8775 14.5294 10.2242 14.5294 8.50025C14.5294 6.77635 13.9038 5.12305 12.7903 3.90406C11.6768 2.68507 10.1665 2.00025 8.59174 2.00025ZM0.827148 8.50025C0.827254 7.14485 1.12345 5.80912 1.69102 4.60451C2.25859 3.3999 3.08109 2.36135 4.08988 1.57549C5.09867 0.789633 6.2645 0.279263 7.49012 0.0869618C8.71573 -0.10534 9.96558 0.0260029 11.1354 0.470032C12.3052 0.914061 13.3611 1.6579 14.2149 2.63949C15.0687 3.62108 15.6957 4.81196 16.0435 6.11277C16.3914 7.41358 16.4501 8.7866 16.2147 10.1173C15.9792 11.448 15.4565 12.6977 14.6901 13.7623L18.0262 17.4143C18.1926 17.6029 18.2846 17.8555 18.2826 18.1177C18.2805 18.3799 18.1844 18.6307 18.015 18.8161C17.8457 19.0015 17.6166 19.1066 17.377 19.1089C17.1375 19.1112 16.9068 19.0104 16.7345 18.8283L13.3985 15.1763C12.2535 16.1642 10.8776 16.7794 9.42823 16.9514C7.97884 17.1233 6.5145 16.8451 5.20281 16.1485C3.89112 15.4519 2.78506 14.3651 2.01123 13.0126C1.2374 11.66 0.827051 10.0962 0.827148 8.50025ZM7.67826 5.00025C7.67826 4.73504 7.7745 4.48068 7.94581 4.29315C8.11712 4.10561 8.34947 4.00025 8.59174 4.00025C9.68195 4.00025 10.7275 4.47436 11.4984 5.31827C12.2693 6.16219 12.7024 7.30678 12.7024 8.50025C12.7024 8.76547 12.6062 9.01982 12.4348 9.20736C12.2635 9.3949 12.0312 9.50025 11.7889 9.50025C11.5466 9.50025 11.3143 9.3949 11.143 9.20736C10.9717 9.01982 10.8754 8.76547 10.8754 8.50025C10.8754 7.83721 10.6348 7.20133 10.2066 6.73249C9.77828 6.26365 9.19741 6.00025 8.59174 6.00025C8.34947 6.00025 8.11712 5.8949 7.94581 5.70736C7.7745 5.51982 7.67826 5.26547 7.67826 5.00025Z" fill="#6D717A"/>
                                        </svg>
                                     </button>
                                     <input type="text" class="searchTerm" placeholder="Search your Work" id="workSearch" onkeyup="SearchWork()">
                                  </div>
                               </div>
                               <div class="row">
                                 @foreach($w->buildersubcategories as $sw)
                                  <li class="col-6">
                                     <div class="form-check subworktypechk">
                                        <input type="checkbox" id="subwork{{$sw->id}}" class="form-check-input"  name="subworktype[]" value="{{$sw->id}}" @if(in_array($sw->id, $traderselected)){ checked }@endif>
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
                              <div class="modal-footer">
                                 <button type="button" class="btn btn-link" data-bs-dismiss="modal">Cancel</button>
                                 <button type="button" class="btn btn-light" onclick="updatebuildercat()">Save</button>
                              </div>
                           </div>
                        </div>
                     </div>
                     <!-- The Modal Work Selection END-->

                  </div>
                  <div class="col-md-6">
                     <h3>Areas covered</h3>
                     <ol id="area-list">
                        @foreach($trader_area as $ta)
                        <?php array_push($areaselected, $ta->sub_area_cover_id); ?>
                        <li>{{$ta->subareas->sub_area_type}}</li>
                        @endforeach
                     </ol>
                     <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#areas-covered-work">View more & update</a>
                  </div>
                  <div class="modal fade select_address" id="areas-covered-work" tabindex="-1" aria-labelledby="exampleModalLabel1" aria-hidden="true">
                     <div class="modal-dialog modal-xl">
                        <div class="modal-content">
                           <div class="modal-header">
                              <h5 class="modal-title" id="exampleModalLabel1">Which areas do you cover?</h5>
                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                 <svg width="19" height="19" viewBox="0 0 19 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M2.26683 18.5416L0.458496 16.7333L7.69183 9.49992L0.458496 2.26659L2.26683 0.458252L9.50016 7.69159L16.7335 0.458252L18.5418 2.26659L11.3085 9.49992L18.5418 16.7333L16.7335 18.5416L9.50016 11.3083L2.26683 18.5416Z" fill="black"/>
                                 </svg>
                              </button>
                           </div>
                           <div class="modal-body">
                              <div class="row">
                                 <div class="col-md-4">
                                    <nav class="nav-sidebar">
                                       <ul class="nav tabs">
                                          <?php $j=1;?>
                                         @foreach($areas as $a)
                                           <li class="areaschkboxsec @if($j == 1) active @endif">
                                              <a href="#tab0{{$j}}" data-toggle="tab">
                                                 {{$a->area_type}}
                                                 <div class="pull-right">{{-- count($a->subareas) --}}</div>
                                              </a>
                                           </li>
                                           <?php $j++; ?>
                                           @endforeach
                                        </ul>
                                    </nav>
                                 </div>
                                 <div class="col-md-8">
                                    <div class="tab-content tab_wrappper" id="area_tab">
                                       <?php $j=1;?>
                                       @foreach($areas as $a)
                                       <div class="tab-pane @if($j == 1) active @endif text-style" id="tab0{{$j}}">
                                          <div class="wrap">
                                             <div class="search">
                                                <button type="submit" class="searchButton">
                                                   <svg width="19" height="20" viewBox="0 0 19 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                      <path fill-rule="evenodd" clip-rule="evenodd" d="M8.59174 2.00025C7.01698 2.00025 5.50672 2.68507 4.3932 3.90406C3.27968 5.12305 2.65411 6.77635 2.65411 8.50025C2.65411 10.2242 3.27968 11.8775 4.3932 13.0964C5.50672 14.3154 7.01698 15.0003 8.59174 15.0003C10.1665 15.0003 11.6768 14.3154 12.7903 13.0964C13.9038 11.8775 14.5294 10.2242 14.5294 8.50025C14.5294 6.77635 13.9038 5.12305 12.7903 3.90406C11.6768 2.68507 10.1665 2.00025 8.59174 2.00025ZM0.827148 8.50025C0.827254 7.14485 1.12345 5.80912 1.69102 4.60451C2.25859 3.3999 3.08109 2.36135 4.08988 1.57549C5.09867 0.789633 6.2645 0.279263 7.49012 0.0869618C8.71573 -0.10534 9.96558 0.0260029 11.1354 0.470032C12.3052 0.914061 13.3611 1.6579 14.2149 2.63949C15.0687 3.62108 15.6957 4.81196 16.0435 6.11277C16.3914 7.41358 16.4501 8.7866 16.2147 10.1173C15.9792 11.448 15.4565 12.6977 14.6901 13.7623L18.0262 17.4143C18.1926 17.6029 18.2846 17.8555 18.2826 18.1177C18.2805 18.3799 18.1844 18.6307 18.015 18.8161C17.8457 19.0015 17.6166 19.1066 17.377 19.1089C17.1375 19.1112 16.9068 19.0104 16.7345 18.8283L13.3985 15.1763C12.2535 16.1642 10.8776 16.7794 9.42823 16.9514C7.97884 17.1233 6.5145 16.8451 5.20281 16.1485C3.89112 15.4519 2.78506 14.3651 2.01123 13.0126C1.2374 11.66 0.827051 10.0962 0.827148 8.50025ZM7.67826 5.00025C7.67826 4.73504 7.7745 4.48068 7.94581 4.29315C8.11712 4.10561 8.34947 4.00025 8.59174 4.00025C9.68195 4.00025 10.7275 4.47436 11.4984 5.31827C12.2693 6.16219 12.7024 7.30678 12.7024 8.50025C12.7024 8.76547 12.6062 9.01982 12.4348 9.20736C12.2635 9.3949 12.0312 9.50025 11.7889 9.50025C11.5466 9.50025 11.3143 9.3949 11.143 9.20736C10.9717 9.01982 10.8754 8.76547 10.8754 8.50025C10.8754 7.83721 10.6348 7.20133 10.2066 6.73249C9.77828 6.26365 9.19741 6.00025 8.59174 6.00025C8.34947 6.00025 8.11712 5.8949 7.94581 5.70736C7.7745 5.51982 7.67826 5.26547 7.67826 5.00025Z" fill="#6D717A"/>
                                                   </svg>
                                                </button>
                                                <input type="text" class="searchTerm" placeholder="Search your Area" onkeyup="SearchArea()"
                                                id="areaSearch">
                                             </div>
                                          </div>
                                          <div class="row tab_cont">
                                             @foreach($a->subareas as $ac)
                                             <li class="col-6">
                                                <div class="form-check areachkbx">
                                                   <input type="checkbox" id="areacovers{{$ac->id}}" class="form-check-input"  name="subareacovers[]" value="{{$ac->id}}" @if(in_array($ac->id, $areaselected)){ checked }@endif>
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
                           <div class="modal-footer">
                              <button type="button" class="btn btn-link" data-bs-dismiss="modal">Cancel</button>
                              <button type="button" class="btn btn-light" onclick="updateTraderArea()">Save</button>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <!--// END -->
            <div class="white_bg mb-5">
               <div class="row contingency-wrap">
                  <div class="col-md-12">
                     <h3>Contingency</h3>
                     <h5>Contingency is the amount, as a percentage of the total cost, that covers your unexpected cost increases. This can be specified individually on each of your estimates. By default, the following percentage will be used.</h5>
                  </div>
                  <div class="row mt-1 gen-info" id="contingency">
                     <div class="col-4 col-md-1">
                        <h6>Default</h6>
                     </div>
                     <div class="col-2 pr-0">
                        <input type="text" class="form-control border-bottom-0 clr-bg" value="{{$trader_details->contingency}}" readonly>
                     </div>
                     <div class="col-6 pl-0">
                        <h6 class="font-44">% </h6>
                        <a href="javascript:void(0)" id="openEditContingency">
                           <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                              <path d="M0.5 12.5443V15.0766C0.5 15.3099 0.683333 15.4931 0.916667 15.4931H3.45C3.55833 15.4931 3.66667 15.4515 3.74167 15.3682L12.8417 6.28013L9.71667 3.15638L0.625 12.2444C0.541667 12.3277 0.5 12.4277 0.5 12.5443ZM15.2583 2.6899L13.3083 0.740676C13.2312 0.663454 13.1397 0.602189 13.0389 0.560388C12.938 0.518587 12.83 0.49707 12.7208 0.49707C12.6117 0.49707 12.5036 0.518587 12.4028 0.560388C12.302 0.602189 12.2104 0.663454 12.1333 0.740676L10.6083 2.26507L13.7333 5.38882L15.2583 3.86443C15.3356 3.78737 15.3969 3.69583 15.4387 3.59506C15.4805 3.49429 15.502 3.38626 15.502 3.27716C15.502 3.16807 15.4805 3.06004 15.4387 2.95927C15.3969 2.8585 15.3356 2.76696 15.2583 2.6899Z" fill="#061A48" />
                           </svg>
                        </a>
                     </div>
                  </div>
                  <div class="row mt-1 gen-info" style="display: none;" id="contingencyEdit">
                     <div class="col-4 col-md-1">
                        <h6>Default</h6>
                     </div>
                     <div class="col-2 pr-0">
                        <input type="text" class="form-control border-bottom-0" value="{{$trader_details->contingency}}" id="editContigencyval">
                     </div>
                     <div class="col-6 pl-0">
                        <h6 class="font-44">% </h6>
                        <a href="javascript:void(0)" onclick="updateContingency()">
                           <svg width="19" height="15" viewBox="0 0 19 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                              <path d="M18.8737 2.29199L6.3737 14.792L0.644531 9.06283L2.11328 7.59408L6.3737 11.8441L17.4049 0.823242L18.8737 2.29199Z" fill="#061A48" />
                           </svg>
                        </a>
                        <a href="javascript:void(0)" id="closecontingencyEdit">
                           <svg width="15" height="15" viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                              <path fill-rule="evenodd" clip-rule="evenodd" d="M14.6363 1.71967C14.7254 1.6307 14.7961 1.52506 14.8444 1.40877C14.8926 1.29248 14.9175 1.16783 14.9176 1.04193C14.9176 0.916028 14.8929 0.791345 14.8448 0.674998C14.7967 0.558651 14.7261 0.452919 14.6372 0.363839C14.5482 0.274759 14.4426 0.204076 14.3263 0.155824C14.21 0.107573 14.0853 0.0826979 13.9594 0.0826205C13.8335 0.0825432 13.7088 0.107265 13.5925 0.155373C13.4761 0.203482 13.3704 0.274035 13.2813 0.363006L7.49967 6.14467L1.71967 0.363006C1.53977 0.183101 1.29576 0.0820312 1.04134 0.0820312C0.786915 0.0820313 0.542911 0.183101 0.363006 0.363006C0.183101 0.542911 0.0820313 0.786915 0.0820312 1.04134C0.0820312 1.29576 0.183101 1.53977 0.363006 1.71967L6.14467 7.49967L0.363006 13.2797C0.273926 13.3688 0.203264 13.4745 0.155054 13.5909C0.106844 13.7073 0.0820312 13.832 0.0820312 13.958C0.0820312 14.084 0.106844 14.2087 0.155054 14.3251C0.203264 14.4415 0.273926 14.5473 0.363006 14.6363C0.542911 14.8162 0.786915 14.9173 1.04134 14.9173C1.16732 14.9173 1.29206 14.8925 1.40845 14.8443C1.52484 14.7961 1.63059 14.7254 1.71967 14.6363L7.49967 8.85467L13.2813 14.6363C13.4612 14.816 13.7052 14.9169 13.9594 14.9167C14.2137 14.9166 14.4575 14.8154 14.6372 14.6355C14.8169 14.4556 14.9177 14.2117 14.9176 13.9574C14.9174 13.7031 14.8162 13.4594 14.6363 13.2797L8.85467 7.49967L14.6363 1.71967Z" fill="#061A48" />
                           </svg>
                        </a>
                     </div>
                     <p id="contigencyResp"></p>
                  </div>
               </div>
            </div>
            <!--// END -->
            <div class="white_bg">
               <div class="row bank-account-wrap" id="bankdetails">
                  <div class="col-md-9">
                     <h3>Your bank account</h3>
                  </div>
                  <div class="col-md-3">
                     <h4 id="bnkAccType">{{$trader_details->bnk_account_type}}</h4>
                  </div>
                  <div class="col-md-6 mt-3">
                     <h6>Account holder’s name</h6>
                     <h5 id="accHolderName">{{$trader_details->bnk_account_name}}</h5>
                  </div>
                  <div class="col-md-6 mt-3">
                     <h6>Sort code </h6>
                     <h5 id="sortCode">{{$trader_details->bnk_sort_code}}</h5>
                  </div>
                  <div class="col-md-12 mt-3">
                     <h6>Account number </h6>
                     <h5 id="accNum">{{$trader_details->bnk_account_number}}</h5>
                  </div>
                  <div class="col-md-12 mt-3">
                     <h2>
                        <svg width="35" height="43" viewBox="0 0 35 43" fill="none" xmlns="http://www.w3.org/2000/svg">
                           <path d="M34.375 19.625C34.375 30.0312 27.175 39.7625 17.5 42.125C7.825 39.7625 0.625 30.0312 0.625 19.625V8.375L17.5 0.875L34.375 8.375V19.625ZM17.5 38.375C24.5312 36.5 30.625 28.1375 30.625 20.0375V10.8125L17.5 4.9625L4.375 10.8125V20.0375C4.375 28.1375 10.4688 36.5 17.5 38.375ZM13.75 30.875L6.25 23.375L8.89375 20.7313L13.75 25.5688L26.1063 13.2125L28.75 15.875" fill="#6D717A" />
                        </svg> I confirm that the account belongs to myself/my company and the about details are correct.
                     </h2>
                  </div>
                  <a href="javascript:void(0)" id="bankdetailsChange">Has your bank account changed?</a>
               </div>
               <!--// END -->
               <div class="row bank-account-wrap" style="display: none;" id="bankdetailsEdit">
                  <div class="col-md-9">
                     <h3>Your bank account</h3>
                  </div>
                  <div class="col-md-3">
                     <select name="" id="editAccountType" class="form-control">
                        <option value="Personal" @if($trader_details->bnk_account_type == 'Personal') selected @endif>Personal account</option>
                        <option value="Business" @if($trader_details->bnk_account_type == 'Business') selected @endif>Business account</option>
                     </select>
                  </div>
                  <div class="col-md-6">
                     <h6>Account holder’s name</h6>
                     <input type="text" class="form-control" value="{{$trader_details->bnk_account_name}}" id="editAccountHolder">
                  </div>
                  <div class="col-md-6">
                     <h6>Sort code </h6>
                     <input type="text" class="form-control" value="{{$trader_details->bnk_sort_code}}" id="editAccountCode">
                  </div>
                  <div class="col-md-6">
                     <h6>Account number </h6>
                     <input type="text" class="form-control" value="{{$trader_details->bnk_account_number}}" id="editAccountNum">
                  </div>
                  <div class="col-md-12 mt-2">
                     <div class="form-group form-check">
                        <label class="form-check-label">
                           <input class="form-check-input" type="checkbox" id="accountInfoCheck" value="1">I confirm that the account belongs to myself/my company and the about details are correct. </label>
                     </div>
                     <p id="accountResp"></p>
                     <div class="col-12 mt-3">
                        <a href="javascript:void(0)" class="save_" onclick="updateAccountInfo()">Save</a>
                        <a href="javascript:void(0)" class="cancel_" id="cancelBankdetails">Cancel</a>
                     </div>
                     <a href="javascript:void(0)"></a>
                  </div>
               </div>
               <!--// END -->
            </div>
            <!--// END col-9 -->
         </div>
      </div>
      <!--// END-->
   </div>
</section>
<!--Code area end-->
@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
<script src="{{ asset('frontend/dropzone/dropzone.js') }}"></script>
<script>
   $('#summernote').summernote({
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
    // Phone Number With Flag For Display
    let mobile = document.querySelector("#mobile");
    let disp_iti = window.intlTelInput(mobile, {
        separateDialCode: true,
        allowDropdown: false,
        preferredCountries: ["gb"]
    });
    let mobile_num = "{{ $trader_details->phone_number }}";
    let iso2code = "{{ $trader_details->phone_code }}";
    disp_iti.setCountry(iso2code);
    disp_iti.setNumber(mobile_num);

    // Phone Number With Flag For Edit
    let edit_mobile = document.querySelector("#editContactMobile");
    let edit_iti = window.intlTelInput(edit_mobile, {
        separateDialCode: true,
        allowDropdown: true,
        preferredCountries: ["gb"]
    });
    // edit_iti.setNumber(`+${mobile_code} ${mobile_num}`);
    edit_iti.setCountry(iso2code);
    edit_iti.setNumber(mobile_num);

   function showTradernameEdit(){
      $('#tradername').hide();
      $('#tradernameedit').show();
      $('#editTraderName').val($('#txt-company-name').text());
   }
   $('#closeTradename').click(function(){
      $('#tradernameedit').hide();$('#tradername').show();
   });
   $('#descChange').click(function(){
      $('#compdesc').hide(); $('#compdescEdit').show();
   });
   $('#descCancel').click(function(){
      $('#compdescEdit').hide(); $('#compdesc').show();
   });
   $('#changeContact').click(function(){
      $('#contactDetails').hide();
      $('#contactDetailsEdit').show();
      $('#editContactName').val($('#trader-contact-name').text());
      $('#editContactEmail').val($('#trader-email').text());
      $('#editContactMobile').val($('#mobile').val());
      $('#editContactOfficeMobile').val($('#phone').val());
   });
   $('#cancelContactDetails').click(function(){
      $('#contactDetailsEdit').hide();$('#contactDetails').show();
   });
   $('#changeVAT').click(function(){
      $('#vatno').hide();
      $('#editVatno').val($('#vatno h2 span').text());
      $('#vatnoEdit').show();
   });
   $('#closeVAT').click(function(){
      $('#vatnoEdit').hide();
      $('#vatno').show();
      $('#editTraderVatResp').empty();
   });
   $('#openEditContingency').click(function(){
      $('#contingency').hide();$('#contingencyEdit').show();
   });
   $('#closecontingencyEdit').click(function(){
      $('#contingencyEdit').hide();$('#contingency').show();
   });
   $('#bankdetailsChange').click(function(){
      $('#bankdetails').hide();$('#bankdetailsEdit').show();
   });
   $('#cancelBankdetails').click(function(){
      $('#bankdetailsEdit').hide();$('#bankdetails').show();
   });

   function refreshPage(){
      location.reload();
   }

   $('.workchkboxsec').click(function(){
      $(".workchkboxsec").removeClass("active");
      $(this).addClass('active');
   });

   $('.areaschkboxsec').click(function(){
      $(".areaschkboxsec").removeClass("active");
      $(this).addClass('active');
   });

   $.ajaxSetup({
         headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
         }
      });
   function updateTraderName(){
      var tradername = $('#editTraderName').val();
      $.ajax
         ({
            type: "POST",
            url: "{{ route('tradesperson.updateTraderName') }}",
            data: {tradername: tradername},
            success: function (data){
               if(data.status == 1){
                  $('#editTraderNameResp').removeClass('error');
                  $('#editTraderNameResp').empty();
                  $('#txt-company-name').text(tradername);
                  $('#tradernameedit').hide();
                  $('#tradername').show();
               }else{
                  $('#editTraderNameResp').addClass('error');
                  $('#editTraderNameResp').html(data.message);
               }
            }
         });
   }
   function updateTraderDesc(){
      var desc = $('textarea[name="comp_description"]').val();
      $.ajax
         ({
            type: "POST",
            url: "{{ route('tradesperson.updateTraderDesc') }}",
            data: {traderdesc: desc},
            success: function (data){
               if(data.status == 1){
                //   $('#editTraderDescResp').addClass('success');
                //   $('#editTraderDescResp').html(data.message);
                //   setTimeout(function() {location.reload();}, 2000);
                  $('#editTraderDescResp').empty();
                  $('#compdescEdit').hide();
                  $('#txtCompDesc').html(data.description);
                  $('#compdesc').show();
               }else{
                  $('#editTraderDescResp').addClass('error');
                  $('#editTraderDescResp').html(data.message);
               }
            }
         });
   }
   function updateTraderContactInfo(){
      var countryData = edit_iti.getSelectedCountryData();
      var countryCode = countryData.iso2;
      var contactName = $('#editContactName').val();
      var contactMobile = $('#editContactMobile').val();
    //   console.log(contactMobile);
      var contactEmail = $('#editContactEmail').val();
      var contactOfficeMobile = $('#editContactOfficeMobile').val();
      $.ajax
         ({
            type: "POST",
            url: "{{ route('tradesperson.updateTraderContactInfo') }}",
            data: {contactName: contactName, contactMobile: contactMobile, countryCode: countryCode, contactEmail: contactEmail, contactOfficeMobile: contactOfficeMobile},
            success: function (data){
               if(data.status == 1){
                //   $('#editTraderContactResp').addClass('success');
                  $('#editTraderContactResp').empty();
                  $('#contactDetailsEdit').hide();
                  $('#trader-contact-name').text(data.contact_name);
                  $('#trader-email').text(data.email);
                  disp_iti.setNumber(`${data.phone}`);
                  disp_iti.setCountry(`${data.phone_code}`);
                  $('#phone').val(data.office_phone);
                  $('#contactDetails').show();
                //   setTimeout(function() {location.reload();}, 2000);
               }else{
                  $('#editTraderContactResp').addClass('error');
                  $('#editTraderContactResp').html(data.message);
               }
            }
         });
   }
   function updateVat(){
      var vatno = $('#editVatno').val();
      $.ajax
         ({
            type: "POST",
            url: "updateVatInfo",
            data: {vatno: vatno},
            success: function (data){
               if(data.status == 1){
                $('#editTraderVatResp').removeClass('error');
                $('#editTraderVatResp').empty();
                $('#vatnoEdit').hide();
                $('#vatno h2 span').text(vatno);
                $('#vatno').show();
               }else{
                  $('#editTraderVatResp').addClass('error');
                  $('#editTraderVatResp').html(data.message);
               }
            }
         });
   }

//     function verifyCompanyVat(){
//         var vat_number = $('#comp_vat_number').val();
//         if(vat_number){
//             vat_number = vat_number.replace(/\s+/g, "");
//             vat_number = vat_number.replace(/\D/g,'');
//             $.ajax
//             ({
//                 type: "GET",
//                 url: "get-company-vat-details",
//                 data: {vat_number: vat_number},
//                 success: function (data){
//                     data = JSON.parse(data);
//                     if(data.target){
//                         var comp_name = data.target.name;
//                         var comp_addr = data.target.address.line1+', '+data.target.address.line2+', '+data.target.address.postcode;
//                         $('#compavatdetails').html('<p><b>Company name:</b> '+comp_name+'</p><p><b>Company address:</b> '+comp_addr+'</p>');
//                         $('#vat_comp_nameid').val(comp_name);
//                         $('#vat_comp_addressid').val(comp_addr);
//                     }else{
//                         $('#compavatdetails').html('<p style="color:red">Provided UK VAT does not match a registered company</p>');
//                         $('#vat_comp_nameid').val('');
//                         $('#vat_comp_addressid').val('');
//                     }
//                 }
//             });
//         }
//     }

    function verifyAndUpdateVat() {
        var vat_number = $('#editVatno').val();
        if(vat_number) {
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
                        updateVat();
                    }else{
                        $('#editTraderVatResp').html('<p class="text-danger">Provided UK VAT does not match a registered company</p>');
                    }
                }
            });
        }
    }

   function updateContingency(){
      var contigencyval = $('#editContigencyval').val();
      $.ajax
         ({
            type: "POST",
            url: "updateContingency",
            data: {contigencyval: contigencyval},
            success: function (data){
               if(data.status == 1){
                //   console.log(contigencyval);
                  $('#contigencyResp').empty();
                  $('#contingency input').val(contigencyval);
                  $('#contingencyEdit').hide();
                  $('#contingency').show();
               }else{
                  $('#contigencyResp').addClass('error');
                  $('#contigencyResp').html(data.message);
               }
            }
         });
   }
   function updateAccountInfo() {
    if ($('#accountInfoCheck').is(':checked')) {
        var accountType = $('#editAccountType').val();
        var accountHolder = $('#editAccountHolder').val();
        var accountCode = $('#editAccountCode').val();
        var accountNum = $('#editAccountNum').val();
        $.ajax
            ({
                type: "POST",
                url: "{{ route('tradesperson.updateAccount') }}",
                data: {accountType: accountType, accountHolder: accountHolder, accountCode: accountCode, accountNum: accountNum},
                success: function (data){
                if(data.status == 1){
                    //   $('#accountResp').addClass('success');
                    //   $('#accountResp').html(data.message);
                    //   setTimeout(function() {location.reload();}, 2000);
                    $('#accNum').text(accountNum);
                    $('#sortCode').text(accountCode);
                    $('#accHolderName').text(accountHolder);
                    $('#bnkAccType').text(accountType);
                    $('#bankdetailsEdit').hide();
                    $('#bankdetails').show();
                }else{
                    $('#accountResp').addClass('error');
                    $('#accountResp').html(data.message);
                }
                }
            });
    }else{
        $('#accountResp').addClass('error');
        $('#accountResp').html("Please confirm that the account belongs to myself/my company and the about details are correct.");
    }

   }

   function updatebuildercat(){
      var list = $("input[name='subworktype[]']:checked").map(function () {
         return this.value;
      }).get();
      $.ajax
         ({
            type: "POST",
            url: "{{ route('tradesperson.updateWorkType') }}",
            data: {worktype: list},
            success: function (data){
                let html = '';
                for(let work of data.works)
                    html += `<li>${work}</li>`
                $('#work-list').empty();
                $('#work-list').html(html);
                $('#type-of-work').modal('hide');
            }
         });
   }

   function updateTraderArea(){
      var list = $("input[name='subareacovers[]']:checked").map(function () {
         return this.value;
      }).get();
      $.ajax
         ({
            type: "POST",
            url: "{{ route('tradesperson.updateTraderArea') }}",
            data: {areatype: list},
            success: function (data){
                let html = '';
                for(let area of data.areas)
                    html += `<li>${area}</li>`
                $('#area-list').empty();
                $('#area-list').html(html);
                $('#areas-covered-work').modal('hide');
            }
         });
   }

    // Dropzone Js For Company Logo Upload Starts
    Dropzone.autoDiscover = false;
    let dropzone = new Dropzone("#avatar_dropzone", {
        url: "{{ route('tradesperson.updateCompLogo') }}",
        uploadMultiple: false,
        maxFiles: 1,
        maxFilesize: {{ env('CUSTOMER_PROFILE_IMAGE_SIZE') }},
        acceptedFiles: "{{ env('CUSTOMER_PROFILE_IMAGE_ACCEPTED_FILE_TYPES') }}",
        thumbnailWidth: 240,
        thumbnailHeight: 240,
        autoProcessQueue: false,
        previewsContainer: ".dropzone",
        clickable: "#file_upload_btn",
        dictDefaultMessage: "Drag and drop a file here",
        init: function() {
            let dz = this;
            let uploadButton = $("#upload_avatar");

            this.on("addedfile", function(file) {
                if (this.files.length > 1) {
                    dz.removeFile(this.files[0]);
                }
                updateUploadButton();
            });

            this.on("removedfile", function(file) {
                updateUploadButton();
            });

            this.on("thumbnail", function(file, dataUrl) {
                $("#avatar_dropzone").find(".dz-message").hide();
                $(file.previewElement).find(".dz-error-mark, .dz-success-mark, .dz-error-message, .dz-progress").hide();
                updateUploadButton();
            });

            this.on("sending", function(file, xhr, formData) {
                // $(file.previewElement).find(".dz-progress").css({"display": "block","position": "relative"});
                uploadButton.prop("disabled", true);
            });

            this.on("uploadprogress", function(file, progress) {
                if (file.upload) {
                    // $(file.previewElement).find(".dz-progress").css({"display": "block","position": "relative"});
                    uploadButton.prop("disabled", true);
                }
            });

            this.on("success", function(file, response) {
                $(file.previewElement).find(".dz-progress").hide();
                $(file.previewElement).find(".dz-success-mark").show();
                $('.profile_pics > img').attr('src', response.image_link);
                $('.reg_ img').attr('src', response.image_link);
                $('#profile_pics').modal('hide');

                updateUploadButton();
            });

            this.on("error", function(file, errorMessage) {
                $(file.previewElement).find(".dz-progress").hide();
                $(file.previewElement).find(".dz-error-message").text(errorMessage).show();
                $(file.previewElement).find(".dz-error-mark").show();
                updateUploadButton();
            });

            function updateUploadButton() {
                let maxFileSize = dz.options.maxFilesize ? dz.options.maxFilesize * 1024 * 1024 : (2 * 1024 * 1024);
                // let acceptedFileTypes = dz.options.acceptedFiles ? dz.options.acceptedFiles.split(',').map(type => type.trim()) : ['.gif', '.jpg', '.jpeg', '.png', '.svg', '.webp', '.heic'];
                let acceptedFileTypes = dz.options.acceptedFiles;
                $('.supported_ .invalid-file').empty();

                let file = dz.files[0];
                if(file)
                    // console.log(file.type);

                if (dz.files.length > 0) {
                    let file = dz.files[0];
                    if (file.size <= maxFileSize && acceptedFileTypes.includes(file.type)) {
                        uploadButton.prop("disabled", false);
                    } else {
                        let errorMessage = [];
                        let errorMessages = '<ul>';
                        if (file.size > maxFileSize) {
                            errorMessage.push("File size exceeds the maximum limit.");
                        }
                        if(!(acceptedFileTypes.includes(file.type))) {
                            $('.supported_ .invalid-file').empty();
                            $('.dz-error-message').empty();
                            $('.dz-success-mark').empty();
                            $('.dz-error-mark').empty();
                            $('.dz-details').empty();
                            $('.dz-message').show();
                            errorMessage.push("Invalid file type. Please select a valid file.");
                        } else{

                        }
                        $.each(errorMessage, function(key, errorMessage) {
                            errorMessages += `<li> ${errorMessage} </li>`;
                        });

                        errorMessages += '</ul>';
                        $('.supported_ .invalid-file').html(errorMessages);
                        uploadButton.prop("disabled", true);
                    }
                } else {
                    uploadButton.prop("disabled", true);
                }
            }



            uploadButton.click(function() {
                if (dz.files.length > 0) {
                    dz.processQueue();
                }
            });

            $("#profile_pics").on("hidden.bs.modal", function() {
                $("#avatar_dropzone").find(".dz-message").show();
                $("#profile_pics .supported_ .invalid-file").empty();
                dz.removeAllFiles();
            });
        }

    });
    // Dropzone Js For Company Logo Upload Ends

   // Dropzone Js For Public liability insurance Starts
    // let pli_dropzone = new Dropzone("#pli_dropzone", {
    //     url: "{{ route('tradesperson.storeTraderFile') }}",
    //     params: {
    //         file_related_to: 'public_liability_insurance',
    //         file_type: 'document',
    //     },
    //     uploadMultiple: false,
    //     maxFiles: 1,
    //     maxFilesize: {{ env('CUSTOMER_PROFILE_IMAGE_SIZE') }},
    //     acceptedFiles: "image/jpeg, image/png, image/svg+xml, image/webp, application/pdf",
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
    let pli_dropzone = new Dropzone("#pli_dropzone", {
        url: "{{ route('tradesperson.storeTraderFile') }}",
        params: {
            file_related_to: 'public_liability_insurance',
            file_type: 'document',
        },
        maxFiles: 6,
        maxFilesize: {{ env('CUSTOMER_PROFILE_IMAGE_SIZE') }},
        acceptedFiles: "image/jpeg, image/png, image/svg+xml, image/webp, application/pdf",
        thumbnailWidth: 240,
        thumbnailHeight: 240,
        previewsContainer: "#pli_dropzone",
        clickable: "#pli_upload_btn",
        dictDefaultMessage: "",
        init: function() {
            let dz = this;

            $("#pliModal").on("hidden.bs.modal", function() {
                $("#pli_dropzone").find(".dz-message").show();
                $("#pli_dropzone .supported_ .invalid-file").empty();
                $("#pli_dropzone .supported_ .dropzone-messages").empty();
                dz.removeAllFiles();
            });

            this.on("success", function(file, response) {
                let html = `<div class="mb-3" id="publicLiabilityInsurance-${response.file.id}">
                        <a href="${response.file.url}" class="btn-pli" target="_blank">
                            ${truncateString(response.file.file_name, 15)}
                            <svg width="19" height="24" viewBox="0 0 19 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                              <path d="M17.3125 19.0003V22.3337H1.6875V19.0003H0.125V22.3337C0.125 22.7757 0.28962 23.1996 0.582646 23.5122C0.875671 23.8247 1.2731 24.0003 1.6875 24.0003H17.3125C17.7269 24.0003 18.1243 23.8247 18.4174 23.5122C18.7104 23.1996 18.875 22.7757 18.875 22.3337V19.0003H17.3125ZM17.3125 10.667L16.2109 9.49199L10.2812 15.8087V0.666992H8.71875V15.8087L2.78906 9.49199L1.6875 10.667L9.5 19.0003L17.3125 10.667Z" fill="#6D717A" />
                           </svg>
                        </a>
                        <a href="javascript:void(0)" onclick="confirmDeletePopup(${response.file.id}, 'publicLiabilityInsurance-${response.file.id}')">
                           <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                              <path d="M17 17L1 1M17 1L1 17" stroke="#6D717A" stroke-width="2" stroke-linecap="round" />
                           </svg>
                        </a>
                     </div>`;

                $(html).insertBefore('#addPLIdocs');
                $('#pliModal').modal('hide');
            });
        }

    });
    // Dropzone Js For Public liability insurance Ends

    // Dropzone Js For Team Photo Upload Starts
    let team_photo_dropzone = new Dropzone("#team_photo_dropzone", {
        url: "{{ route('tradesperson.storeTraderFile') }}",
        params: {
            file_related_to: 'team_img',
            file_type: 'image',
        },
        maxFiles: 6,
        maxFilesize: {{ env('CUSTOMER_PROFILE_IMAGE_SIZE') }},
        acceptedFiles: "{{ env('CUSTOMER_PROFILE_IMAGE_ACCEPTED_FILE_TYPES') }}",
        thumbnailWidth: 240,
        thumbnailHeight: 240,
        previewsContainer: "#team_photo_dropzone",
        clickable: "#team_photo_upload_btn",
        init: function() {
            let dz = this;

            $("#teamPhotoModal").on("hidden.bs.modal", function() {
                // $("#trader_img_dropzone").find(".dz-message").css("display", "block");
                $("#trader_img_dropzone").find(".dz-message").show();
                $("#trader_img_dropzone .supported_ .invalid-file").empty();
                $("#trader_img_dropzone .supported_ .dropzone-messages").empty();
                dz.removeAllFiles();
            });

            this.on("success", function(file, response) {
                let html = `<div class="d-inline mr-2" id="teamImage-${response.file.id}">
                                <a href="javascript:void(0)" class="mb-1" onclick="confirmDeletePopup(${response.file.id}, 'teamImage-${response.file.id}')">
                                   <img src="${response.file.url}" alt="" class="rectangle-img">
                                   <div class="remove_img">
                                      <svg width="22" height="23" viewBox="0 0 22 23" fill="none" xmlns="http://www.w3.org/2000/svg">
                                         <path d="M3.28033 0.54L11.0003 8.26L18.6803 0.58C18.85 0.399435 19.0543 0.254989 19.2812 0.155324C19.508 0.0556597 19.7526 0.00282869 20.0003 0C20.5308 0 21.0395 0.210714 21.4145 0.585786C21.7896 0.960859 22.0003 1.46957 22.0003 2C22.005 2.2452 21.9595 2.48877 21.8666 2.71576C21.7738 2.94275 21.6355 3.14837 21.4603 3.32L13.6803 11L21.4603 18.78C21.79 19.1025 21.9832 19.5392 22.0003 20C22.0003 20.5304 21.7896 21.0391 21.4145 21.4142C21.0395 21.7893 20.5308 22 20.0003 22C19.7454 22.0106 19.4911 21.968 19.2536 21.8751C19.016 21.7821 18.8003 21.6408 18.6203 21.46L11.0003 13.74L3.30033 21.44C3.13134 21.6145 2.92945 21.7539 2.70633 21.85C2.4832 21.9461 2.24325 21.9971 2.00033 22C1.46989 22 0.961185 21.7893 0.586112 21.4142C0.211039 21.0391 0.000325413 20.5304 0.000325413 20C-0.00433758 19.7548 0.0411562 19.5112 0.134015 19.2842C0.226874 19.0572 0.36514 18.8516 0.540325 18.68L8.32032 11L0.540325 3.22C0.210695 2.89752 0.0174046 2.46082 0.000325413 2C0.000325413 1.46957 0.211039 0.960859 0.586112 0.585786C0.961185 0.210714 1.46989 0 2.00033 0C2.48033 0.006 2.94033 0.2 3.28033 0.54Z" fill="white" />
                                      </svg>
                                   </div>
                                </a>
                            </div>`;
                $("#teamPhotoModal").modal('hide');
                $(html).insertBefore('#addTeamPhotos');
            });
        }
    });
    // Dropzone Js For Team Photo Upload Ends


    // Dropzone Js For Previous Project Upload Starts
    let prev_proj_dropzone = new Dropzone("#prev_proj_dropzone", {
        url: "{{ route('tradesperson.storeTraderFile') }}",
        params: {
            file_related_to: 'prev_project_img',
            file_type: 'image',
        },
        maxFiles: 6,
        maxFilesize: {{ env('CUSTOMER_PROFILE_IMAGE_SIZE') }},
        acceptedFiles: "{{ env('CUSTOMER_PROFILE_IMAGE_ACCEPTED_FILE_TYPES') }}",
        thumbnailWidth: 240,
        thumbnailHeight: 240,
        previewsContainer: "#prev_proj_dropzone",
        clickable: "#prev_proj_upload_btn",
        init: function() {
            let dz = this;

            $("#prevProjModal").on("hidden.bs.modal", function() {
                // $("#prev_proj_dropzone").find(".dz-message").css("display", "block");
                $("#prev_proj_dropzone").find(".dz-message").show();
                $("#prev_proj_dropzone .supported_ .invalid-file").empty();
                $("#prev_proj_dropzone .supported_ .dropzone-messages").empty();
                dz.removeAllFiles();
            });

            this.on("success", function(file, response) {
                let html = `<div class="d-inline mr-2" id="prevProjectImage-${response.file.id}">
                                    <a href="javascript:void(0)" class="mb-1" onclick="confirmDeletePopup(${response.file.id}, 'prevProjectImage-${response.file.id}')">
                                    <img src="${response.file.url}" alt="" class="rectangle-img">
                                    <div class="remove_img">
                                        <svg width="22" height="23" viewBox="0 0 22 23" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M3.28033 0.54L11.0003 8.26L18.6803 0.58C18.85 0.399435 19.0543 0.254989 19.2812 0.155324C19.508 0.0556597 19.7526 0.00282869 20.0003 0C20.5308 0 21.0395 0.210714 21.4145 0.585786C21.7896 0.960859 22.0003 1.46957 22.0003 2C22.005 2.2452 21.9595 2.48877 21.8666 2.71576C21.7738 2.94275 21.6355 3.14837 21.4603 3.32L13.6803 11L21.4603 18.78C21.79 19.1025 21.9832 19.5392 22.0003 20C22.0003 20.5304 21.7896 21.0391 21.4145 21.4142C21.0395 21.7893 20.5308 22 20.0003 22C19.7454 22.0106 19.4911 21.968 19.2536 21.8751C19.016 21.7821 18.8003 21.6408 18.6203 21.46L11.0003 13.74L3.30033 21.44C3.13134 21.6145 2.92945 21.7539 2.70633 21.85C2.4832 21.9461 2.24325 21.9971 2.00033 22C1.46989 22 0.961185 21.7893 0.586112 21.4142C0.211039 21.0391 0.000325413 20.5304 0.000325413 20C-0.00433758 19.7548 0.0411562 19.5112 0.134015 19.2842C0.226874 19.0572 0.36514 18.8516 0.540325 18.68L8.32032 11L0.540325 3.22C0.210695 2.89752 0.0174046 2.46082 0.000325413 2C0.000325413 1.46957 0.211039 0.960859 0.586112 0.585786C0.961185 0.210714 1.46989 0 2.00033 0C2.48033 0.006 2.94033 0.2 3.28033 0.54Z" fill="white" />
                                        </svg>
                                    </div>
                                    </a>
                                </div>`;

                $(html).insertBefore('#addPrevProj');
                $('#prevProjModal').modal('hide');
            });
        }
    });
    // Dropzone Js For Previous Project Upload Ends

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
    });

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

    function changeWorkActiveStatus(event) {
        $(".workchkboxsec").removeClass("active");
        $(event).closest(".workchkboxsec").addClass('active');
    }

    function changeAreaActiveStatus(event) {
        $(".areaschkboxsec").removeClass("active");
        $(event).closest(".areaschkboxsec").addClass('active');
    }

    function confirmDeletePopup(file, divId){
        $('#Delete_wp').modal('show');
        $('#confirmedDelete').attr('data-file', file);
        $('#confirmedDelete').attr('data-div-id', divId);
    }

    function deleteFile(){
        let file = $('#confirmedDelete').attr('data-file');
        let divId = "#" + $('#confirmedDelete').attr('data-div-id');
        $.ajax
         ({
            type: "POST",
            url: "{{ route('tradesperson.deleteTraderFile') }}",
            data: {file: file},
            success: function (data){
                if(data.response == 'success'){
                    $(divId).remove();
                    $('#Delete_wp').modal('hide');
                } else {
                    $('#Delete_wp .modal-body h4.text-danger').text("Oops! Failed To delete the file");
                }
            },
            error: function (xhr, status, error) {
                $('#Delete_wp .modal-body h4.text-danger').text("Oops! Failed To delete the file");
            }
         });
    }

    $('#Delete_wp').on('hidden.bs.modal', function (e) {
        $('#Delete_wp .modal-body h4.text-danger').text('');
        $('#confirmedDelete').attr('data-file', '');
        $('#confirmedDelete').attr('data-div-id', '');
    });

    function truncateString(str, num) {
        if (str.length > num)
            return str.slice(0, num) + "...";
        else
            return str;
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

</script>
@endpush
@endsection
