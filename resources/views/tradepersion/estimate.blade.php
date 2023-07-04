@extends('layouts.app')

@section('content')
    <!--Code area start-->
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
                    <button class="btn btn-light" type="submit" id="capture_photo_upload">Upload</button>
                    <button type="button" class="btn btn-link btn-close" data-bs-dismiss="modal" id="close_image_modal">Close</button>
                  </div>
                </form>
              </div>
            </div>
    </div>
    <!-- The Modal Upload Photo file END-->

    <section>
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center pt-5 fmb_titel">
                    <h1>Write Estimate</h1>
                    <ol class="breadcrumb mb-5">
                        <li class="breadcrumb-item">
                            <a href="index.html">Home</a>
                        </li>
                        <li class="breadcrumb-item"><a href="projects-tradesperson.html">Project list</a></li>
                        <li class="breadcrumb-item active" aria-current="page">New estimate</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>
    <!--Code area end-->
    <!--Code area start-->
    <section class="pb-5">
        <div class="container">
            <form action="{{ route('tradepersion.p_estimate') }}" method="post">
                @csrf
                <input type="hidden" name="project_id" value="{{ $project_id }}" />
                <div class="row mb-5">
                    <div class="col-md-10 offset-md-1">
                        <div class="tell_about pl-details">
                            <div class="row">
                                <div class="col-md-6">
                                    <h5>Customer’s project name</h5>
                                </div>
                                <div class="col-md-6">
                                    <h2>Renovate my house</h2>
                                </div>
                            </div>
                            <div class="row mt-4">
                                <div class="col-md-6">
                                    <h5>Location</h5>
                                </div>
                                <div class="col-md-6">
                                    <h2>London</h2>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--// END-->
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
                <section>
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12 text-center pt-5 mb-5 fmb_titel">
                                <h2>Create tasks</h2>
                            </div>
                        </div>
                    </div>
                </section>
                <div class="row">
                    <div class="col-md-10 offset-md-1">
                        <div class="white_bg mb-5 create-task-wp">
                                <div class="col-12">
                                    <div class="form-check mb-2">
                                        <input type="radio" class="form-check-input mb" id="Fully_describe"
                                            name="describe_mode" value="Fully_describe" checked>
                                        <h5>Please describe fully each task that needs to be undertaken.</h5>
                                    </div>
                                </div>
                            <div class="row" id="for_task">
                                <div class="row task-wrap">
                                    <div class="col-md-1">
                                        <svg width="27" height="25" viewBox="0 0 27 25" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M12.5013 24.5832C10.8298 24.5832 9.25894 24.2658 7.7888 23.631C6.31866 22.997 5.03984 22.1363 3.95234 21.0488C2.86484 19.9613 2.00411 18.6825 1.37014 17.2123C0.735358 15.7422 0.417969 14.1714 0.417969 12.4998C0.417969 10.8283 0.735358 9.25748 1.37014 7.78734C2.00411 6.3172 2.86484 5.03838 3.95234 3.95088C5.03984 2.86338 6.31866 2.00224 7.7888 1.36746C9.25894 0.73349 10.8298 0.416504 12.5013 0.416504C13.8103 0.416504 15.0489 0.607823 16.2169 0.990462C17.385 1.3731 18.4624 1.90678 19.4492 2.5915L17.6971 4.3738C16.9319 3.89046 16.1162 3.51266 15.2503 3.24038C14.3843 2.96891 13.468 2.83317 12.5013 2.83317C9.82283 2.83317 7.5423 3.77446 5.65972 5.65705C3.77633 7.54043 2.83464 9.82136 2.83464 12.4998C2.83464 15.1783 3.77633 17.4592 5.65972 19.3426C7.5423 21.2252 9.82283 22.1665 12.5013 22.1665C13.1457 22.1665 13.7701 22.1061 14.3742 21.9853C14.9784 21.8644 15.5624 21.6932 16.1263 21.4717L17.9388 23.3144C17.1131 23.7172 16.2471 24.0294 15.3409 24.2509C14.4346 24.4724 13.4881 24.5832 12.5013 24.5832ZM20.9596 22.1665V18.5415H17.3346V16.1248H20.9596V12.4998H23.3763V16.1248H27.0013V18.5415H23.3763V22.1665H20.9596ZM10.8096 18.0582L5.67422 12.9228L7.36589 11.2311L10.8096 14.6748L22.893 2.5613L24.5846 4.25296L10.8096 18.0582Z"
                                                fill="#061A48"></path>
                                        </svg>
                                    </div>
                                    <div class="col-md-4">
                                        <h2>Task 1</h2>
                                        <p>Please describe fully each task that needs to be undertaken.</p>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <textarea class="form-control" name="task1" placeholder="1. Remove existing... 2. Install new..."></textarea>
                                        </div>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">
                                                    <svg width="13" height="18" viewBox="0 0 13 18" fill="none"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                            d="M12.4297 18H0.160156V15.668H12.418L12.4297 18ZM8.60938 10.9688H0.113281V8.68359H8.60938V10.9688ZM4.8125 5.82422L5.08203 13.0898C5.08984 13.8398 4.95312 14.5117 4.67188 15.1055C4.39844 15.6914 3.94531 16.1523 3.3125 16.4883L1.17969 15.668C1.4375 15.6055 1.63281 15.4414 1.76562 15.1758C1.90625 14.9023 2 14.5859 2.04688 14.2266C2.10156 13.8594 2.12891 13.5156 2.12891 13.1953L1.88281 5.82422C1.88281 4.74609 2.10547 3.82813 2.55078 3.07031C3.00391 2.30469 3.625 1.71875 4.41406 1.3125C5.20312 0.90625 6.10938 0.703125 7.13281 0.703125C8.21875 0.703125 9.14062 0.902344 9.89844 1.30078C10.6562 1.69922 11.2344 2.25391 11.6328 2.96484C12.0312 3.66797 12.2305 4.48828 12.2305 5.42578H9.39453C9.39453 4.83984 9.28516 4.375 9.06641 4.03125C8.84766 3.67969 8.55859 3.42578 8.19922 3.26953C7.84766 3.11328 7.46484 3.03516 7.05078 3.03516C6.62891 3.03516 6.24609 3.14062 5.90234 3.35156C5.56641 3.5625 5.30078 3.875 5.10547 4.28906C4.91016 4.70312 4.8125 5.21484 4.8125 5.82422Z"
                                                            fill="black" />
                                                    </svg>
                                                </span>
                                            </div>
                                            <input type="text" name="amount1" id="amount1" class="form-control"
                                                onchange="calculate_amount()" onkeyup="calculate_amount()"
                                                placeholder="Type price for task 1">
                                        </div>
                                    </div>
                                    <div class="col-md-1">
                                        <!-- <a href="#">
                            <svg width="17" height="17" viewBox="0 0 17 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                              <path d="M16.8193 2.23594L14.763 0.179688L8.49948 6.44323L2.23594 0.179688L0.179688 2.23594L6.44323 8.49948L0.179688 14.763L2.23594 16.8193L8.49948 10.5557L14.763 16.8193L16.8193 14.763L10.5557 8.49948L16.8193 2.23594Z" fill="#6D717A" />
                            </svg>
                          </a> -->
                                    </div>
                                </div>
                                <div class="row task-wrap">
                                    <div class="col-md-1">
                                        <svg width="27" height="25" viewBox="0 0 27 25" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M12.5013 24.5832C10.8298 24.5832 9.25894 24.2658 7.7888 23.631C6.31866 22.997 5.03984 22.1363 3.95234 21.0488C2.86484 19.9613 2.00411 18.6825 1.37014 17.2123C0.735358 15.7422 0.417969 14.1714 0.417969 12.4998C0.417969 10.8283 0.735358 9.25748 1.37014 7.78734C2.00411 6.3172 2.86484 5.03838 3.95234 3.95088C5.03984 2.86338 6.31866 2.00224 7.7888 1.36746C9.25894 0.73349 10.8298 0.416504 12.5013 0.416504C13.8103 0.416504 15.0489 0.607823 16.2169 0.990462C17.385 1.3731 18.4624 1.90678 19.4492 2.5915L17.6971 4.3738C16.9319 3.89046 16.1162 3.51266 15.2503 3.24038C14.3843 2.96891 13.468 2.83317 12.5013 2.83317C9.82283 2.83317 7.5423 3.77446 5.65972 5.65705C3.77633 7.54043 2.83464 9.82136 2.83464 12.4998C2.83464 15.1783 3.77633 17.4592 5.65972 19.3426C7.5423 21.2252 9.82283 22.1665 12.5013 22.1665C13.1457 22.1665 13.7701 22.1061 14.3742 21.9853C14.9784 21.8644 15.5624 21.6932 16.1263 21.4717L17.9388 23.3144C17.1131 23.7172 16.2471 24.0294 15.3409 24.2509C14.4346 24.4724 13.4881 24.5832 12.5013 24.5832ZM20.9596 22.1665V18.5415H17.3346V16.1248H20.9596V12.4998H23.3763V16.1248H27.0013V18.5415H23.3763V22.1665H20.9596ZM10.8096 18.0582L5.67422 12.9228L7.36589 11.2311L10.8096 14.6748L22.893 2.5613L24.5846 4.25296L10.8096 18.0582Z"
                                                fill="#061A48"></path>
                                        </svg>
                                    </div>
                                    <div class="col-md-4">
                                        <h2>Task 2</h2>
                                        <p>Please describe fully each task that needs to be undertaken.</p>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <textarea class="form-control" name="task2" placeholder="1. Remove existing... 2. Install new..."></textarea>
                                        </div>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">
                                                    <svg width="13" height="18" viewBox="0 0 13 18"
                                                        fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                            d="M12.4297 18H0.160156V15.668H12.418L12.4297 18ZM8.60938 10.9688H0.113281V8.68359H8.60938V10.9688ZM4.8125 5.82422L5.08203 13.0898C5.08984 13.8398 4.95312 14.5117 4.67188 15.1055C4.39844 15.6914 3.94531 16.1523 3.3125 16.4883L1.17969 15.668C1.4375 15.6055 1.63281 15.4414 1.76562 15.1758C1.90625 14.9023 2 14.5859 2.04688 14.2266C2.10156 13.8594 2.12891 13.5156 2.12891 13.1953L1.88281 5.82422C1.88281 4.74609 2.10547 3.82813 2.55078 3.07031C3.00391 2.30469 3.625 1.71875 4.41406 1.3125C5.20312 0.90625 6.10938 0.703125 7.13281 0.703125C8.21875 0.703125 9.14062 0.902344 9.89844 1.30078C10.6562 1.69922 11.2344 2.25391 11.6328 2.96484C12.0312 3.66797 12.2305 4.48828 12.2305 5.42578H9.39453C9.39453 4.83984 9.28516 4.375 9.06641 4.03125C8.84766 3.67969 8.55859 3.42578 8.19922 3.26953C7.84766 3.11328 7.46484 3.03516 7.05078 3.03516C6.62891 3.03516 6.24609 3.14062 5.90234 3.35156C5.56641 3.5625 5.30078 3.875 5.10547 4.28906C4.91016 4.70312 4.8125 5.21484 4.8125 5.82422Z"
                                                            fill="black" />
                                                    </svg>
                                                </span>
                                            </div>
                                            <input type="text" class="form-control" id="amount2" name="amount2"
                                                onchange="calculate_amount()" onkeyup="calculate_amount()"
                                                placeholder="Type price for task 2">
                                        </div>
                                    </div>
                                    {{-- <div class="col-md-1">
                                        <span class="remove-row">
                                            <svg width="17" height="17" viewBox="0 0 17 17" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M16.8193 2.23594L14.763 0.179688L8.49948 6.44323L2.23594 0.179688L0.179688 2.23594L6.44323 8.49948L0.179688 14.763L2.23594 16.8193L8.49948 10.5557L14.763 16.8193L16.8193 14.763L10.5557 8.49948L16.8193 2.23594Z"
                                                    fill="#6D717A" />
                                            </svg>
                                        </span>
                                    </div> --}}
                                </div>
                                {{-- for add more --}}
                                <div id="new_add"></div>
                                <input type="hidden" value="2" id="total_field" name="total_field">

                                <div class="form-group col-md-12 mt-2 mb-5 text-center pre_">
                                    <button type="button" class="btn btn-light mr-3" onclick="addMore()"><i class="fa fa-plus"></i> Add new</button>
                                </div>


                                <!--//-->
                            </div>
                            <div id='unable_to_desc_div'>
                                <div class="form-check mb-3">
                                    <input type="radio" class="form-check-input mb" id="Unable_to_describe" name="describe_mode" value="Unable_to_describe" {{ old('describe_mode') == 'Unable_to_describe' ? 'checked' : '' }}>
                                    <h5>I am unable to describe the work required.</h5>
                                </div>

                                <div class="unable-work">
                                    <div class="row mb-3">
                                        <div class="col-md-5">
                                            <div class="form-check mb-2">
                                                <input type="radio" class="form-check-input mb" id="forMore" name="unable_to_describe_type" value="Need_more_info" {{ old('unable_to_describe_type') == 'Need_more_info' ? 'checked' : '' }} >
                                                <h5>I need more information</h5>
                                                <p>Please write here what additional information you need.
                                                    This will be sent directly to the customer.</p>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <textarea class="form-control" id="typeHere" name="typeHere" placeholder="Type here..." disabled></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-12">
                                            <div class="form-check mb-2">
                                                <input type="radio" class="form-check-input mb" id="radiox1" name="unable_to_describe_type" value="Do_not_undertake_project_type" {{ old('unable_to_describe_type') == 'Do_not_undertake_project_type' ? 'checked' : '' }}>
                                                <h5>I do not undertake this type of project.</h5>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-12">
                                            <div class="form-check mb-2">
                                                <input type="radio" class="form-check-input mb" id="radiox2" name="unable_to_describe_type" value="Do_not_cover_location" {{ old('unable_to_describe_type') == 'Do_not_cover_location' ? 'checked' : '' }}>
                                                <h5>I do not cover the customer’s location.</h5>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row" id="for_photos">
                                <div class="col-md-12 mt-3 mb-3">
                                    <h3>Product photo(s)</h3>
                                </div>
                                {{-- <div class="col-md-3">
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-outline-danger btn-block">
                                            <svg width="22" height="20" viewBox="0 0 22 20" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M18 6V4H16V2H18V0H20V2H22V4H20V6H18ZM2 20C1.45 20 0.979333 19.8043 0.588 19.413C0.196 19.021 0 18.55 0 18V6C0 5.45 0.196 4.97933 0.588 4.588C0.979333 4.196 1.45 4 2 4H5.15L7 2H13V4H7.875L6.05 6H2V18H18V9H20V18C20 18.55 19.8043 19.021 19.413 19.413C19.021 19.8043 18.55 20 18 20H2ZM10 16.5C11.25 16.5 12.3127 16.0627 13.188 15.188C14.0627 14.3127 14.5 13.25 14.5 12C14.5 10.75 14.0627 9.68733 13.188 8.812C12.3127 7.93733 11.25 7.5 10 7.5C8.75 7.5 7.68733 7.93733 6.812 8.812C5.93733 9.68733 5.5 10.75 5.5 12C5.5 13.25 5.93733 14.3127 6.812 15.188C7.68733 16.0627 8.75 16.5 10 16.5ZM10 14.5C9.3 14.5 8.70833 14.2583 8.225 13.775C7.74167 13.2917 7.5 12.7 7.5 12C7.5 11.3 7.74167 10.7083 8.225 10.225C8.70833 9.74167 9.3 9.5 10 9.5C10.7 9.5 11.2917 9.74167 11.775 10.225C12.2583 10.7083 12.5 11.3 12.5 12C12.5 12.7 12.2583 13.2917 11.775 13.775C11.2917 14.2583 10.7 14.5 10 14.5Z"
                                                    fill="#EE5719" />
                                            </svg> Take photo/video </button>
                                    </div>
                                </div> --}}
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <a data-bs-toggle="modal" data-bs-target="#exampleModal4" id="gUMbtn1" class="btn btn-outline-danger btn-block">
                                            <svg width="22" height="20" viewBox="0 0 22 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M18 6V4H16V2H18V0H20V2H22V4H20V6H18ZM2 20C1.45 20 0.979333 19.8043 0.588 19.413C0.196 19.021 0 18.55 0 18V6C0 5.45 0.196 4.97933 0.588 4.588C0.979333 4.196 1.45 4 2 4H5.15L7 2H13V4H7.875L6.05 6H2V18H18V9H20V18C20 18.55 19.8043 19.021 19.413 19.413C19.021 19.8043 18.55 20 18 20H2ZM10 16.5C11.25 16.5 12.3127 16.0627 13.188 15.188C14.0627 14.3127 14.5 13.25 14.5 12C14.5 10.75 14.0627 9.68733 13.188 8.812C12.3127 7.93733 11.25 7.5 10 7.5C8.75 7.5 7.68733 7.93733 6.812 8.812C5.93733 9.68733 5.5 10.75 5.5 12C5.5 13.25 5.93733 14.3127 6.812 15.188C7.68733 16.0627 8.75 16.5 10 16.5ZM10 14.5C9.3 14.5 8.70833 14.2583 8.225 13.775C7.74167 13.2917 7.5 12.7 7.5 12C7.5 11.3 7.74167 10.7083 8.225 10.225C8.70833 9.74167 9.3 9.5 10 9.5C10.7 9.5 11.2917 9.74167 11.775 10.225C12.2583 10.7083 12.5 11.3 12.5 12C12.5 12.7 12.2583 13.2917 11.775 13.775C11.2917 14.2583 10.7 14.5 10 14.5Z"
                                                    fill="#EE5719"
                                                />
                                            </svg>
                                            Take a photo
                                        </a>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        {{-- <a data-bs-toggle="modal" data-bs-target="#exampleModal2" class="btn btn-outline-danger btn-block"> --}}
                                            <button type="button" onclick="product_photo_upload()" class="btn btn-outline-danger btn-block">
                                            <svg width="18" height="20" viewBox="0 0 18 20" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M17.0344 4.21564L13.2844 0.465637C13.1415 0.326345 12.9495 0.248887 12.75 0.250012H5.25C4.85218 0.250012 4.47064 0.408047 4.18934 0.689352C3.90804 0.970656 3.75 1.35219 3.75 1.75001V3.25001H2.25C1.85218 3.25001 1.47064 3.40805 1.18934 3.68935C0.908035 3.97066 0.75 4.35219 0.75 4.75001V18.25C0.75 18.6478 0.908035 19.0294 1.18934 19.3107C1.47064 19.592 1.85218 19.75 2.25 19.75H12.75C13.1478 19.75 13.5294 19.592 13.8107 19.3107C14.092 19.0294 14.25 18.6478 14.25 18.25V16.75H15.75C16.1478 16.75 16.5294 16.592 16.8107 16.3107C17.092 16.0294 17.25 15.6478 17.25 15.25V4.75001C17.2511 4.55048 17.1737 4.35851 17.0344 4.21564ZM12.75 18.25H2.25V4.75001H9.44062L12.75 8.05939V18.25ZM15.75 15.25H14.25V7.75001C14.2511 7.55048 14.1737 7.35851 14.0344 7.21564L10.2844 3.46564C10.1415 3.32635 9.94954 3.24889 9.75 3.25001H5.25V1.75001H12.4406L15.75 5.05939V15.25ZM10.5 12.25C10.5 12.4489 10.421 12.6397 10.2803 12.7803C10.1397 12.921 9.94891 13 9.75 13H5.25C5.05109 13 4.86032 12.921 4.71967 12.7803C4.57902 12.6397 4.5 12.4489 4.5 12.25C4.5 12.0511 4.57902 11.8603 4.71967 11.7197C4.86032 11.579 5.05109 11.5 5.25 11.5H9.75C9.94891 11.5 10.1397 11.579 10.2803 11.7197C10.421 11.8603 10.5 12.0511 10.5 12.25ZM10.5 15.25C10.5 15.4489 10.421 15.6397 10.2803 15.7803C10.1397 15.921 9.94891 16 9.75 16H5.25C5.05109 16 4.86032 15.921 4.71967 15.7803C4.57902 15.6397 4.5 15.4489 4.5 15.25C4.5 15.0511 4.57902 14.8603 4.71967 14.7197C4.86032 14.579 5.05109 14.5 5.25 14.5H9.75C9.94891 14.5 10.1397 14.579 10.2803 14.7197C10.421 14.8603 10.5 15.0511 10.5 15.25Z"
                                                    fill="#EE5719" />
                                            </svg>
                                            Upload photos
                                        {{-- </a> --}}
                                    </div>
                                    <!-- The Modal Upload files-->
                                    {{-- <div class="modal fade select_address" id="exampleModal2" tabindex="-1"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Upload files</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close">
                                                        <svg width="19" height="19" viewBox="0 0 19 19"
                                                            fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path
                                                                d="M2.26683 18.5416L0.458496 16.7333L7.69183 9.49992L0.458496 2.26659L2.26683 0.458252L9.50016 7.69159L16.7335 0.458252L18.5418 2.26659L11.3085 9.49992L18.5418 16.7333L16.7335 18.5416L9.50016 11.3083L2.26683 18.5416Z"
                                                                fill="black" />
                                                        </svg>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <div class="col-md-6 supported_">
                                                            <h4>Supported file type list:</h4>
                                                            <h6>
                                                                <strong>Images:</strong> .gif .heic .jpeg, .jpg .png .svg
                                                                .webp
                                                            </h6>
                                                            <h6>
                                                                <strong>Documents:</strong> .doc, .docx .key .odt .pdf .ppt,
                                                                .pptx, .pps, .ppsx .xls, .xlsx
                                                            </h6>
                                                            <h6>
                                                                <strong>Audio:</strong> .mp3 .m4a .ogg .wav
                                                            </h6>
                                                            <h6>
                                                                <strong>Video:</strong> .avi .mpg .mp4, .m4v .mov .ogv .vtt
                                                                .wmv .3gp .3g2
                                                            </h6>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="text-center upload_wrap">
                                                                <img src="assets/img/upload.svg" alt="">
                                                                <p>Drag and drop files here</p>
                                                                <h4>OR</h4>
                                                                <button type="button" class="btn btn-light mt-3"
                                                                    style="width:180px;">Browse files</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-link"
                                                        data-bs-dismiss="modal">Cancel</button>
                                                    <button type="button" class="btn btn-light">Upload</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div> --}}
                                    <!-- The Modal Upload files END-->
                                </div>
                                {{-- <div class="col-md-6 mt-2">
                                    <div class="d-inline mr-3">abc.doc (3MB) <a href="#">
                                            <img src="assets/img/crose-btn.svg" alt="">
                                        </a>
                                    </div>
                                    <div class="d-inline mr-3">xyz.jpg (6MB) <a href="#">
                                            <img src="assets/img/crose-btn.svg" alt="">
                                        </a>
                                    </div>
                                </div> --}}
                                <div class="mt-3 mb-4 pv_top" id="uploaded_product_photo"></div>
                            </div>

                        </div>
                    </div>
                </div>
                <!--// END-->
                <div class="row">
                    <div class="col-md-10 offset-md-1">
                        <div class="white_bg mb-5" id="div_for_calculate_estimate">
                            <div class="row">
                                <div class="col-md-6 vat_">
                                    <div class="col-md-12">
                                        <div class="form-check form-switch">
                                            <div class="switchToggle">
                                                <input type="checkbox" id="toogle1" name="covers_customers_all_needs"
                                                    value="1" {{ old('covers_customers_all_needs') ? 'checked' : '' }}>
                                                <label for="toogle1">Toggle</label>
                                            </div>
                                            <label class="form-check-label" for="mySwitch">Does the above list of tasks
                                                cover all of the work the customer requested?</label>
                                        </div>
                                    </div>
                                    <!--//-->
                                    <div class="col-md-12">
                                        <div class="form-check form-switch">
                                            <div class="switchToggle">
                                                <input type="checkbox" id="toogle2" name="payment_required_upfront"
                                                    value="1" {{ old('payment_required_upfront') ? 'checked' : '' }}>
                                                <label for="toogle2">Toggle</label>
                                            </div>
                                            <label class="form-check-label" for="mySwitch">Would you like to charge the customer an additional payment upfront?</label>
                                        </div>
                                    </div>
                                    <!--//-->
                                    <div class="col-md-12">
                                        <div class="form-check form-switch">
                                            <div class="switchToggle">
                                                <input type="checkbox" id="toogle3" name="apply_vat" value="1" {{ old('apply_vat') ? 'checked' : '' }}>
                                                <label for="toogle3">Toggle</label>
                                            </div>
                                            <label class="form-check-label" for="mySwitch">Apply VAT @ {{ config('const.vat_charge') }}%?</label>
                                        </div>
                                    </div>
                                    <!--//-->
                                </div>
                                <div class="col-md-5 offset-md-1 total_price_">
                                    <div class="row mb-3">
                                        <div class="col-4">
                                            <h5>Contingency:</h5>
                                        </div>
                                        <div class="col-3 pr-0">
                                            <input type="text" class="form-control pull-left"
                                                id="percentage_contingency" name='contingency'
                                                onchange="calculate_amount()" onkeyup="calculate_amount()" value="{{ old('contingency') ?? $default_contingency }}">
                                        </div>
                                        <div class="col-3 pl-0">
                                            <h5>%</h5>
                                        </div>
                                    </div>
                                    <h6>Total price excluding contingency</h6>
                                    <div class="mb-4 price_ec" id="price_exclude_contigency">£0.00</div>
                                    <h6>Total price including contingency</h6>
                                    <div class="mb-4 price_ec" id="price_include_contigency">£0.00</div>
                                    <div id="vat_price">
                                        <h6>Total price including contingency and VAT</h6>
                                        <div class="mb-4 price_ec" id="price_include_vat">£0.00</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--// END-->
                <div class="row">
                    <div class="col-md-10 offset-md-1" id="div_for_initial_payment">
                        <div class="white_bg mb-5 initial-payment">
                            <div class="row" id="for_initial_pay_hide">
                                    <div class="col-md-12">
                                        <h3>Additional payment upfront</h3>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="row">
                                            <div class="col-2 pr-0">
                                                <div class="form-check mt-2">
                                                    <input type="radio" class="form-check-input" id="radio1" name="initial_payment_type" value="percentage" checked>
                                                </div>
                                            </div>
                                            <div class="col-8">
                                                <div class="row total_price_">
                                                    <div class="col-4 pl-0 pr-0">
                                                        <input type="text" class="form-control pull-left" id="initial_payment_percentage" name="initial_payment_percentage" onkeyup="calculate_amount()" value="{{ old('initial_payment_percentage') }}">
                                                    </div>
                                                    <div class="col-2 pl-0">
                                                        <h5>%</h5>
                                                    </div>
                                                    <div class="col-3">
                                                        <span id="initial_payment1">(£0.00)</span>
                                                        <input name="initial_payment_calculated_percentage" type="hidden" />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <h4>Or</h4>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="row task-wrap p-0">
                                            <div class="col-1">
                                                <div class="form-check mt-2">
                                                    <input type="radio" class="form-check-input" id="radio1" name="initial_payment_type" value="fixed_amount">
                                                </div>
                                            </div>
                                            <div class="col-9">
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">
                                                            <svg width="13" height="18" viewBox="0 0 13 18"
                                                                fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <path
                                                                    d="M12.4297 18H0.160156V15.668H12.418L12.4297 18ZM8.60938 10.9688H0.113281V8.68359H8.60938V10.9688ZM4.8125 5.82422L5.08203 13.0898C5.08984 13.8398 4.95312 14.5117 4.67188 15.1055C4.39844 15.6914 3.94531 16.1523 3.3125 16.4883L1.17969 15.668C1.4375 15.6055 1.63281 15.4414 1.76562 15.1758C1.90625 14.9023 2 14.5859 2.04688 14.2266C2.10156 13.8594 2.12891 13.5156 2.12891 13.1953L1.88281 5.82422C1.88281 4.74609 2.10547 3.82813 2.55078 3.07031C3.00391 2.30469 3.625 1.71875 4.41406 1.3125C5.20312 0.90625 6.10938 0.703125 7.13281 0.703125C8.21875 0.703125 9.14062 0.902344 9.89844 1.30078C10.6562 1.69922 11.2344 2.25391 11.6328 2.96484C12.0312 3.66797 12.2305 4.48828 12.2305 5.42578H9.39453C9.39453 4.83984 9.28516 4.375 9.06641 4.03125C8.84766 3.67969 8.55859 3.42578 8.19922 3.26953C7.84766 3.11328 7.46484 3.03516 7.05078 3.03516C6.62891 3.03516 6.24609 3.14062 5.90234 3.35156C5.56641 3.5625 5.30078 3.875 5.10547 4.28906C4.91016 4.70312 4.8125 5.21484 4.8125 5.82422Z"
                                                                    fill="black"></path>
                                                            </svg>
                                                        </span>
                                                    </div>
                                                    <input type="text" class="form-control" name="initial_payment_amount" placeholder="Type Price" value="{{ old('initial_payment_amount') }}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="row form_wrap mt-3">
                                        <h3 class="mt-4">Available to start</h3>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <select name="for_start_date" class="form-control" id="for_start_date" onchange="getDate()">
                                                    <option value="now" {{ old('for_start_date') == 'now' ? 'selected' : '' }}>Now</option>
                                                    <option value="one_week" {{ old('for_start_date') == 'one_week' ? 'selected' : '' }}>Next one week</option>
                                                    <option value="two_three_weeks" {{ old('for_start_date') == 'two_three_weeks' ? 'selected' : '' }}>2-3 weeks time</option>
                                                    <option value="specific_date" {{ old('for_start_date') == 'specific_date' ? 'selected' : '' }}>On a specific date</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input type="date" class="form-control" id="project_start_date" name="project_start_date" placeholder="DD MM YYYY" style="display: none;" value="{{ old('project_start_date') }}">
                                            </div>
                                        </div>
                                        <h3 class="mt-4">Total time required to complete the project (including
                                            contingency)</h3>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input type="text" class="form-control" id=""
                                                    placeholder="Type time" name="total_time" value="{{ old('total_time') }}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <select name="total_time_type" class="form-control" id="">
                                                    <option value="minutes" {{ old('total_time_type') == 'minutes' ? 'selected' : '' }}>minutes</option>
                                                    <option value="Hours" {{ old('total_time_type') == 'Hours' ? 'selected' : '' }} >hours</option>
                                                    <option value="days" {{ old('total_time_type') == 'days' ? 'selected' : '' }} >days</option>
                                                    <option value="weeks" {{ old('total_time_type') == 'weeks' ? 'selected' : '' }} >weeks</option>
                                                    <option value="months" {{ old('total_time_type') == 'months' ? 'selected' : '' }} >months</option>
                                                </select>
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
                        <div class="white_bg" id="terms_conditions">
                            <div class="row">
                                <div class="col-md-12">
                                    <h3>Terms and conditions</h3>
                                    {{-- <textarea name="termsconditions" id="summernote"></textarea> --}}
                                    <textarea name="termsconditions" class="form-control">{{ old('termsconditions') }}</textarea>
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
    </section>
    <!--Code area end-->
@endsection
@push('scripts')
    <!-- Main JS -->
    {{-- <script src="assets/js/main.js"></script> --}}
    {{-- <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script> --}}
    <script src="{{ asset('frontend/dropzone/dropzone.js') }}"></script>
    <script src="{{ asset('frontend/webcamjs/webcam.min.js') }}"></script>
    <script src="{{ asset('frontend/webcamjs/video.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
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
        .catch(function(err) { console.log(err.name + ": " + err.message); });
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


        // $('#summernote').summernote({
        //     // placeholder: 'FixMyBuild',
        //     tabsize: 2,
        //     height: 200,
        //     toolbar: [
        //         ['style', ['style']],
        //         ['font', ['bold', 'underline', 'clear']],
        //         ['color', ['color']],
        //         ['para', ['ul', 'ol', 'paragraph']],
        //         ['table', ['table']],
        //     ]
        // });

        // $(document).ready(function() {
        //     $(".remove-row").click(function(e) {
        //         var last_field = parseInt($('#total_field').val())
        //         if (last_field > 2) {
        //             $('#new_' + last_field).remove();
        //             $('#total_field').val(last_field - 1);
        //         }
        //     });
        // });

        function addMore() {
            var new_field = parseInt($('#total_field').val()) + 1;
            var new_input = `<div class="row task-wrap" id="new_${new_field}">
                    <div class="col-md-1">
                      <svg width="27" height="25" viewBox="0 0 27 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M12.5013 24.5832C10.8298 24.5832 9.25894 24.2658 7.7888 23.631C6.31866 22.997 5.03984 22.1363 3.95234 21.0488C2.86484 19.9613 2.00411 18.6825 1.37014 17.2123C0.735358 15.7422 0.417969 14.1714 0.417969 12.4998C0.417969 10.8283 0.735358 9.25748 1.37014 7.78734C2.00411 6.3172 2.86484 5.03838 3.95234 3.95088C5.03984 2.86338 6.31866 2.00224 7.7888 1.36746C9.25894 0.73349 10.8298 0.416504 12.5013 0.416504C13.8103 0.416504 15.0489 0.607823 16.2169 0.990462C17.385 1.3731 18.4624 1.90678 19.4492 2.5915L17.6971 4.3738C16.9319 3.89046 16.1162 3.51266 15.2503 3.24038C14.3843 2.96891 13.468 2.83317 12.5013 2.83317C9.82283 2.83317 7.5423 3.77446 5.65972 5.65705C3.77633 7.54043 2.83464 9.82136 2.83464 12.4998C2.83464 15.1783 3.77633 17.4592 5.65972 19.3426C7.5423 21.2252 9.82283 22.1665 12.5013 22.1665C13.1457 22.1665 13.7701 22.1061 14.3742 21.9853C14.9784 21.8644 15.5624 21.6932 16.1263 21.4717L17.9388 23.3144C17.1131 23.7172 16.2471 24.0294 15.3409 24.2509C14.4346 24.4724 13.4881 24.5832 12.5013 24.5832ZM20.9596 22.1665V18.5415H17.3346V16.1248H20.9596V12.4998H23.3763V16.1248H27.0013V18.5415H23.3763V22.1665H20.9596ZM10.8096 18.0582L5.67422 12.9228L7.36589 11.2311L10.8096 14.6748L22.893 2.5613L24.5846 4.25296L10.8096 18.0582Z" fill="#061A48"></path>
                      </svg>
                    </div>
                    <div class="col-md-4">
                      <h2>Task ${new_field}</h2>
                      <p>Please describe fully each task that needs to be undertaken.</p>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <textarea class="form-control" name="task${new_field}" placeholder="1. Remove existing... 2. Install new..."></textarea>
                      </div>
                      <div class="input-group mb-3">
                        <div class="input-group-prepend">
                          <span class="input-group-text">
                            <svg width="13" height="18" viewBox="0 0 13 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                              <path d="M12.4297 18H0.160156V15.668H12.418L12.4297 18ZM8.60938 10.9688H0.113281V8.68359H8.60938V10.9688ZM4.8125 5.82422L5.08203 13.0898C5.08984 13.8398 4.95312 14.5117 4.67188 15.1055C4.39844 15.6914 3.94531 16.1523 3.3125 16.4883L1.17969 15.668C1.4375 15.6055 1.63281 15.4414 1.76562 15.1758C1.90625 14.9023 2 14.5859 2.04688 14.2266C2.10156 13.8594 2.12891 13.5156 2.12891 13.1953L1.88281 5.82422C1.88281 4.74609 2.10547 3.82813 2.55078 3.07031C3.00391 2.30469 3.625 1.71875 4.41406 1.3125C5.20312 0.90625 6.10938 0.703125 7.13281 0.703125C8.21875 0.703125 9.14062 0.902344 9.89844 1.30078C10.6562 1.69922 11.2344 2.25391 11.6328 2.96484C12.0312 3.66797 12.2305 4.48828 12.2305 5.42578H9.39453C9.39453 4.83984 9.28516 4.375 9.06641 4.03125C8.84766 3.67969 8.55859 3.42578 8.19922 3.26953C7.84766 3.11328 7.46484 3.03516 7.05078 3.03516C6.62891 3.03516 6.24609 3.14062 5.90234 3.35156C5.56641 3.5625 5.30078 3.875 5.10547 4.28906C4.91016 4.70312 4.8125 5.21484 4.8125 5.82422Z" fill="black" />
                            </svg>
                          </span>
                        </div>
                        <input type="text" name="amount${new_field}" id="amount${new_field}" class="form-control" onchange="calculate_amount()" onkeyup="calculate_amount()" placeholder="Type price for task ${new_field}">
                      </div>
                    </div>
                    <div class="col-md-1">
                      <span class="remove-row">
                        <svg width="17" height="17" viewBox="0 0 17 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                          <path d="M16.8193 2.23594L14.763 0.179688L8.49948 6.44323L2.23594 0.179688L0.179688 2.23594L6.44323 8.49948L0.179688 14.763L2.23594 16.8193L8.49948 10.5557L14.763 16.8193L16.8193 14.763L10.5557 8.49948L16.8193 2.23594Z" fill="#6D717A" />
                        </svg>
                      </span>
                    </div>
                  </div>`;
            $('#new_add').append(new_input);
            $('#total_field').val(new_field);

            $(".remove-row").click(function(e) {
                var last_field = parseInt($('#total_field').val())
                if (last_field > 2) {
                    $('#new_' + last_field).remove();
                    $('#total_field').val(last_field - 1);
                }
            });
        }


        function remove() {

        }

        function needMoreInfo() {
            // const forClick = document.getElementById("forMore");
            // const textBox = document.getElementById("typeHere");
            // if (forClick.clicked == false) {
            //     textBox.disabled = true;
            // } else {
            //     textBox.disabled = false;
            // }
            if ( $('#forMore').is(':checked') ) {
                $('#typeHere').prop('disabled', false);
            }
            else {
                $('#typeHere').prop('disabled', true);
            }
        }


        function calculate_amount() {
            let sum = 0;
            var initial_payment = parseFloat(document.getElementById("initial_payment_percentage").value);

            const amount_from_addmore = document.getElementById("new_".$new_field);
            for (let i = 1; i <= $('#total_field').val(); i++) {
                sum += Number($('#amount' + i).val());
                $("#price_exclude_contigency").text("£" + sum.toFixed(2));
            }
            var percentage_contingency = $("#percentage_contingency").val() ?? 0;
            var total_price_including_contingency = (sum * percentage_contingency / 100) + sum;
            var total_price_including_vat = ((total_price_including_contingency * {{ config('const.vat_charge') }}) / 100) +
                total_price_including_contingency;

            $("#price_include_contigency").text("£" + total_price_including_contingency.toFixed(2));
            $("#price_include_vat").text("£" + total_price_including_vat.toFixed(2));

            var initial_payment_percentage = 0
            if (isNaN(initial_payment) != true) {
                if (!document.getElementById('toogle3').checked) {
                    initial_payment_percentage = (parseFloat(total_price_including_contingency) * initial_payment / 100);
                } else {
                    initial_payment_percentage = (parseFloat(total_price_including_vat) * initial_payment / 100);
                }
            }

            $("#initial_payment1").text("(£" + initial_payment_percentage.toFixed(2) + ")");
            $("input[name='initial_payment_calculated_percentage']").val(initial_payment_percentage.toFixed(2));
        }

        // $(document).ready(function() {
        //     $("#vat_price").hide();
        // });

        $('#toogle3').change(function() {
            // if (this.checked) {
            //     $("#vat_price").show();
            //     calculate_amount();
            // } else {
            //     $("#vat_price").hide();
            //     calculate_amount();
            // }
            showAndUpdateVatPrice();
        });

        function showAndUpdateVatPrice() {
            if ($('#toogle3').prop('checked'))
                $("#vat_price").show();
            else
                $("#vat_price").hide();
            calculate_amount();
        }

        // $(document).ready(function() {
        //     $("#for_initial_pay_hide").hide();
        // });

        $('#toogle2').change(function() {
            // if (this.checked) {
            //     $("#for_initial_pay_hide").show();
            //     calculate_amount();
            // } else {
            //     $("#for_initial_pay_hide").hide();
            //     calculate_amount();
            // }
            showInitialPayment();
        });

        function showInitialPayment() {
            if ($('#toogle2').prop('checked'))
                $("#for_initial_pay_hide").show();
            else
                $("#for_initial_pay_hide").hide();
            calculate_amount();
        }

        function getDate() {
            let e = document.getElementById('for_start_date');
            const date = new Date();
            let currentDay = String(date.getDate()).padStart(2, '0');
            let currentMonth = String(date.getMonth() + 1).padStart(2, "0");
            let currentYear = date.getFullYear();
            let currentDate = `${currentYear}-${currentMonth}-${currentDay}`;
            let project_start_date = document.getElementById('project_start_date');
            let futureDate;
            if (e.value === 'specific_date') {
                document.getElementById('project_start_date').style.display = 'block';
            } else {
                document.getElementById('project_start_date').style.display = 'none';

            }
        }

        $(document).ready(function() {
            fetchProductImages();
            // $("#for_initial_pay_hide").hide();
            $("#vat_price").hide();
            $('input[name="unable_to_describe_type"]').prop('disabled', true); // Disable the Unable to describe work radio buttons by default

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
                        $("#capture_photo_upload").html('<i class="fa fa-circle-o-notch fa-spin"></i> Upload');
                        $("#capture_photo_upload").prop('disabled', true);
                        var formData = new FormData($("#capturephoto")[0]);
                        formData.append('media_type', 'estimate');
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
                                $("#capture_photo_upload").html('Upload');
                                $("#capture_photo_upload").prop('disabled', false);
                                success='1'
                            },
                            error: (response) => {
                                console.log(response);
                                success=response
                            }
                        });
                        if(success=='1'){
                            fetchProductImages();
                            console.log(modalId);
                            $(modalId).modal('hide');
                            Swal.fire({
                                //position: 'top-end',
                                icon: 'success',
                                title: 'Image uploaded successfully.',
                                showConfirmButton: false,
                                timer: 1500
                            })
                        } else{console.log(success);}

                        }
                })
            });

            // $('#Unable_to_describe').change(function() {
            // $('input[name="describe_mode"]').change(function() {
            //     // if ($(this).is(':checked')) {
            //     if ($('#Unable_to_describe').is(':checked')) {
            //         // $('#Fully_describe').closest('.form-check').removeClass('mb-2').addClass('mb-4');
            //         // $("#div_for_calculate_estimate").hide();
            //         // $("#div_for_initial_payment").hide();
            //         // $("#terms_conditions").hide();
            //         // $("#for_photos").hide();
            //         // $("#for_task").hide();
            //         // $('input[name="unable_to_describe_type"]').prop('disabled', false);
            //         // $('input[name="unable_to_describe_type"]:first').prop('checked', true);
            //         // needMoreInfo();

            //         showUnableToDescribeContent();
            //     } else {
            //         // $('#Fully_describe').closest('.form-check').removeClass('mb-4').addClass('mb-2');
            //         // $("#div_for_calculate_estimate").show();
            //         // $("#div_for_initial_payment").show();
            //         // $("#terms_conditions").show();
            //         // $("#for_photos").show();
            //         // $("#for_task").show();
            //         // $('input[name="unable_to_describe_type"]').prop('disabled', true);
            //         // $('input[name="unable_to_describe_type"]').prop('checked', false);
            //         // $('#typeHere').prop('disabled', true);

            //         showFullyDescribeContent();
            //     }
            // });

            $('input[name="describe_mode"]').change(function() {
                showContentBasedOnDescribeMode();
            });

            $('input[name="unable_to_describe_type"]').on('change', () => needMoreInfo());
            showContentBasedOnDescribeMode();

            $(".remove-row").click(function(e) {
                var last_field = parseInt($('#total_field').val())
                if (last_field > 2) {
                    $('#new_' + last_field).remove();
                    $('#total_field').val(last_field - 1);
                }
            });

            let tasks = [];
            @for ($i = 1; $i <= old('total_field'); $i++)
                tasks.push({
                    price : "{{ old('amount'.$i) }}",
                    description: "{{ old('task'.$i) }}"
                });
            @endfor

            @if($errors->any())
                let total_tasks = {{ old('total_field')  }};
                for (let i = 0; i < total_tasks; i++) {
                    if (i > 1)
                        addMore();
                    $(`textarea[name="task${i+1}"]`).text(tasks[i].description);
                    $(`input[name="amount${i+1}"]`).val((tasks[i].price == '') ? '' : parseFloat(tasks[i].price));
                }
            @endif

            showInitialPayment();
            showAndUpdateVatPrice();
        });

        function showContentBasedOnDescribeMode() {
            if ($('#Unable_to_describe').is(':checked'))
                showUnableToDescribeContent();
            else
                showFullyDescribeContent();
        }

        function showUnableToDescribeContent() {
            $('#unable_to_desc_div .unable-work').show();
            $('#Fully_describe').closest('.form-check').removeClass('mb-2').addClass('mb-4');
            $("#div_for_calculate_estimate").hide();
            $("#div_for_initial_payment").hide();
            $("#terms_conditions").hide();
            $("#for_photos").hide();
            $("#for_task").hide();
            $('input[name="unable_to_describe_type"]').prop('disabled', false);
            $('input[name="unable_to_describe_type"]:first').prop('checked', true);
            needMoreInfo();
        }

        function showFullyDescribeContent() {
            $('#Fully_describe').closest('.form-check').removeClass('mb-4').addClass('mb-2');
            $("#div_for_calculate_estimate").show();
            $("#div_for_initial_payment").show();
            $("#terms_conditions").show();
            $("#for_photos").show();
            $("#for_task").show();
            $('input[name="unable_to_describe_type"]').prop('disabled', true);
            $('input[name="unable_to_describe_type"]').prop('checked', false);
            $('#typeHere').prop('disabled', true);
            $('#unable_to_desc_div .unable-work').hide();
        }

        function fetchProductImages() {
            $.ajax({
                url: "{{ route('tradesperson.getProductImage') }}",
                success: function(response) {
                    $('#uploaded_product_photo').html(response);
                },
                error: function(xhr, status, error) {
                    console.log(error);
                }
            });
        }

        function deleteFile(){
            let file = $('#confirmedDelete').attr('data-file');
            let divId = "#" + $('#confirmedDelete').attr('data-div-id');
            $.ajax
            ({
                type: "POST",
                url: "{{ route('deleteTempFile') }}",
                data: {
                    file: file,
                    _token: '{{ csrf_token() }}',
                    _method: 'DELETE',
                },
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

        function confirmDeletePopup(file, divId){
            $('#Delete_wp').modal('show');
            $('#confirmedDelete').attr('data-file', file);
            $('#confirmedDelete').attr('data-div-id', divId);
        }

        // PreviewTemplate For Multiple File dropzone Starts
        var previewNode = document.querySelector("#template");
        previewNode.id = "";
        var previewTemplate = previewNode.parentNode.innerHTML;
        previewNode.parentNode.removeChild(previewNode);
        // PreviewTemplate For Multiple File dropzone Ends

        Dropzone.autoDiscover = false;

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
                if (progress == 100) {
                    $(file.previewElement).find('.progress').hide(1000);
                }
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
                $("#upload_multiple_file").html('Upload');
                $("#upload_multiple_file").prop('disabled', false);
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

        // Dropzone Js For Product Photo Upload Starts
        function product_photo_upload() {
            var url = "{{ route('tradesperson.tempTraderMedia') }}";
            var params = {
                media_type: 'estimate',
                file_type: 'image',
            };
            var acceptedFiles = "{{ config('const.dropzone_accepted_image') }}";
            let html = `<h6><strong>Images:</strong> .gif .heic .jpeg, .jpg .png .svg .webp</h6>`;

            $('#multiModal .accepted-file-list').html(html);
            $('#multiModal').modal('show');

            var dropzone = callDropzone({url: url, params: params, acceptedFiles: acceptedFiles});

            dropzone.on("successmultiple", function(file, responses) {
                fetchProductImages();
            });
        }
        // Dropzone Js For Product Photo Upload Ends

    </script>
@endpush
