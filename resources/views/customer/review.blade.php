@extends('layouts.app')


@section('content')
    <!--Code area start-->
    <section>
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center pt-5 fmb_titel">
                    <h1>Review</h1>
                    <ol class="breadcrumb mb-5">
                        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                        <li class="breadcrumb-item"><a href="projects.html">Project list</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Submit your review</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>
    <!--Code area end-->
    <!--Code area start-->
    <section class="pb-5">
        <div class="container">
            <form id="reviewForm" name="reviewForm" action="{{ route('customer.review') }}" method="post">
                @csrf
                <div class="row">
                    <div class="col-md-10 offset-md-1">
                        <div class="white_bg mb-5 review_wp">
                            <div class="row">
                                <div class="col-md-12 mb-40 ">
                                    <h3>Punctuality</h3>
                                    <div>
                                        <p>Did the tradesperson arrive on schedule?</p>
                                        <div class="form-check-inline">
                                            <label class="form-check-label">
                                                <input type="radio" class="form-check-input" name="optradio1" value="1" onclick="hide('errorMsg1');"> Yes
                                            </label>
                                        </div>
                                        <div class="form-check-inline">
                                            <label class="form-check-label">
                                                <input type="radio" class="form-check-input" name="optradio1" onclick="hide('errorMsg1');" value="0"> No
                                            </label>
                                        </div>
                                        <p id="errorMsg1" style="display: none;color: red">This Fill Is Required</p>
                                    </div>
                                </div>
                                <!--//-->
                                <div class="col-md-12 mb-40 ">
                                    <h3>Workmanship</h3>
                                    <div>
                                        <p>How was the quality of their work?</p>
                                        <div class="form-check-inline">
                                            <label class="form-check-label">
                                                <input type="radio" class="form-check-input" name="optradio2" onclick="hide('errorMsg2');" value="2"> Beautiful
                                            </label>
                                        </div>
                                        <div class="form-check-inline">
                                            <label class="form-check-label">
                                                <input type="radio" class="form-check-input" name="optradio2" onclick="hide('errorMsg2');" value="1"> It's OK</label>
                                        </div>
                                        <div class="form-check-inline">
                                            <label class="form-check-label">
                                                <input type="radio" class="form-check-input" name="optradio2" onclick="hide('errorMsg2');" value="0"> Awful</label>
                                        </div>
                                    </div>
                                    <p id="errorMsg2" style="display: none;color: red">This Fill Is Required</p>
                                </div>
                                <!--//-->
                                <div class="col-md-12 mb-40 ">
                                    <h3>Tidiness</h3>
                                    <div>
                                        <p>Did they leave your place tidy after the work was completed?</p>
                                        <div class="form-check-inline">
                                            <label class="form-check-label">
                                                <input type="radio" class="form-check-input" name="optradio3" onclick="hide('errorMsg3');" value="1"> Yes</label>
                                        </div>
                                        <div class="form-check-inline">
                                            <label class="form-check-label">
                                                <input type="radio" class="form-check-input" name="optradio3" onclick="hide('errorMsg3');" value="0"> No
                                            </label>
                                        </div>
                                    </div>
                                    <p id="errorMsg3" style="display: none;color: red">This Fill Is Required</p>
                                </div>
                                <!--//-->
                                <div class="col-md-12 mb-40 ">
                                    <h3>Price accuracy</h3>
                                    <div>
                                        <p>Was their estimated price accurate?</p>
                                        <div class="form-check-inline">
                                            <label class="form-check-label">
                                                <input type="radio" class="form-check-input" name="optradio4" onclick="hide('errorMsg4');" value="1"> Yes
                                            </label>
                                        </div>
                                        <div class="form-check-inline">
                                            <label class="form-check-label">
                                                <input type="radio" class="form-check-input" name="optradio4" onclick="hide('errorMsg4');" value="0"> No
                                            </label>
                                        </div>
                                    </div>
                                    <p id="errorMsg4" style="display: none;color: red">This Fill Is Required</p>
                                </div>
                                <!--//-->
                                <div class="col-md-12 mb-40 ">
                                    <h3>Detailed review</h3>
                                    <div>
                                        <p>Would you like to leave a descriptive review?</p>
                                        <div class="form-check-inline">
                                            <label class="form-check-label">
                                                <input type="radio" class="form-check-input" id="ifYes" name="optradio5" onchange="clickYes()", onclick="hide('errorMsg5');" value="1"> Yes</label>
                                        </div>
                                        <div class="form-check-inline">
                                            <label class="form-check-label">
                                                <input type="radio" class="form-check-input" id="ifNo" name="optradio5" onchange="clickNo()", onclick="hide('errorMsg5');" value="0"> No</label>
                                        </div>
                                    </div>
                                    <p id="errorMsg5" style="display: none;color: red">This Fill Is Required</p>
                                </div>
                                <!--//-->
                                <div class="col-md-12">
                                    <textarea name="detailed_review" id="detailed_review" disabled></textarea>
                                </div>
                                <div class="col-md-3 mt-4 p-2">
                                    <button type="button" class="btn btn-outline-danger btn-block p-2" onclick="upload_file()">
                                        <svg width="18" height="20" viewBox="0 0 18 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                           <path d="M17.0344 4.21564L13.2844 0.465637C13.1415 0.326345 12.9495 0.248887 12.75 0.250012H5.25C4.85218 0.250012 4.47064 0.408047 4.18934 0.689352C3.90804 0.970656 3.75 1.35219 3.75 1.75001V3.25001H2.25C1.85218 3.25001 1.47064 3.40805 1.18934 3.68935C0.908035 3.97066 0.75 4.35219 0.75 4.75001V18.25C0.75 18.6478 0.908035 19.0294 1.18934 19.3107C1.47064 19.592 1.85218 19.75 2.25 19.75H12.75C13.1478 19.75 13.5294 19.592 13.8107 19.3107C14.092 19.0294 14.25 18.6478 14.25 18.25V16.75H15.75C16.1478 16.75 16.5294 16.592 16.8107 16.3107C17.092 16.0294 17.25 15.6478 17.25 15.25V4.75001C17.2511 4.55048 17.1737 4.35851 17.0344 4.21564ZM12.75 18.25H2.25V4.75001H9.44062L12.75 8.05939V18.25ZM15.75 15.25H14.25V7.75001C14.2511 7.55048 14.1737 7.35851 14.0344 7.21564L10.2844 3.46564C10.1415 3.32635 9.94954 3.24889 9.75 3.25001H5.25V1.75001H12.4406L15.75 5.05939V15.25ZM10.5 12.25C10.5 12.4489 10.421 12.6397 10.2803 12.7803C10.1397 12.921 9.94891 13 9.75 13H5.25C5.05109 13 4.86032 12.921 4.71967 12.7803C4.57902 12.6397 4.5 12.4489 4.5 12.25C4.5 12.0511 4.57902 11.8603 4.71967 11.7197C4.86032 11.579 5.05109 11.5 5.25 11.5H9.75C9.94891 11.5 10.1397 11.579 10.2803 11.7197C10.421 11.8603 10.5 12.0511 10.5 12.25ZM10.5 15.25C10.5 15.4489 10.421 15.6397 10.2803 15.7803C10.1397 15.921 9.94891 16 9.75 16H5.25C5.05109 16 4.86032 15.921 4.71967 15.7803C4.57902 15.6397 4.5 15.4489 4.5 15.25C4.5 15.0511 4.57902 14.8603 4.71967 14.7197C4.86032 14.579 5.05109 14.5 5.25 14.5H9.75C9.94891 14.5 10.1397 14.579 10.2803 14.7197C10.421 14.8603 10.5 15.0511 10.5 15.25Z" fill="#EE5719"/>
                                        </svg>
                                        Upload Files
                                    </button>
                                </div>
                                <div class="pv_top mt-4 d-flex align-items-start flex-wrap" id="getfilesformdb">
                            </div>
                        </div>
                        <input type="hidden" name="project_id" id="project_id" value="{{ $project_id }}">

                        <div class="form-group col-md-12 mt-5 text-center pre_">
                            <a href="projects.html" class="btn btn-light mr-3">Back</a>
                            <button type="button" class="btn btn-primary" onclick="validate()">Submit </button>
                        </div>
                    </div>
                </div>
                <!--// END-->
            </form>
        </div>

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
    </section>
    <!--Code area end-->
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
    <script src="{{ asset('frontend/validatejs/jquery.validate.js') }}"></script>
    <script src="{{ asset('frontend/dropzone/dropzone.js') }}"></script>


    <script>
        function validate() {
            var validateflag = 0
            var detailed_review = $('#detailed_review').val();
            var error1 = document.getElementById("errorMsg1")
            var error2 = document.getElementById("errorMsg2")
            var error3 = document.getElementById("errorMsg3")
            var error4 = document.getElementById("errorMsg4")
            var error5 = document.getElementById("errorMsg5")
            const optradio1 = $('input[name="optradio1"]:checked').val();
            if (optradio1 == null) {
                error1.style.display = 'block';
                validateflag = 1
            }
            const optradio2 = $('input[name="optradio2"]:checked').val();
            if (optradio2 == null) {
                error2.style.display = 'block';
                validateflag = 1
            }
            const optradio3 = $('input[name="optradio3"]:checked').val();
            if (optradio3 == null) {
                error3.style.display = 'block';
                validateflag = 1
            }
            const optradio4 = $('input[name="optradio4"]:checked').val();
            if (optradio4 == null) {
                error4.style.display = 'block';
                validateflag = 1
            }
            const optradio5 = $('input[name="optradio5"]:checked').val();
            if (optradio5 == null) {
                error5.style.display = 'block';
                validateflag = 1
            } else {
                const ifYes = $('#ifYes').is(':checked')
                const ifNo = $('#ifNo').is(':checked')
                if(ifYes==true){
                    if(detailed_review==''){
                        alert('Details review is blank');
                        validateflag = 1;
                    }
                }
                else if(ifNo==true){

                }
            }
            if (validateflag !=1) {
                const project_id = $('#project_id').val();
                $.ajax({
                    url: "{{ route('customer.review') }}",
                    type: "POST",
                    data: {
                        'optradio1': optradio1,
                        'optradio2': optradio2,
                        'optradio3': optradio3,
                        'optradio4': optradio4,
                        'optradio5': optradio5,
                        'detailed_review': detailed_review,
                        'project_id': project_id,
                        '_token': "{{ csrf_token() }}"
                    },
                    success: function(response) {
                        if (response == 'Done') {
                            alert('Review Saved Successfully');
                        } else {
                            alert(response);
                        }
                    },
                    error: function(xhr) {
                        console.error(xhr.responseText);
                    }
                });
            }
        }

        function clickYes() {
            const forYes = document.getElementById("ifYes");
            const textBox = document.getElementById("detailed_review");
            if (forYes.clicked == false) {
                textBox.disabled = true;
            } else {
                textBox.disabled = false;
            }

        }

        function clickNo() {
            const forNo = document.getElementById("ifNo");
            const textBox = document.getElementById("detailed_review");

            if (forNo.clicked == false) {
                textBox.disabled = false;
            } else {
                textBox.disabled = true;
                textBox.value = ''
            }
        }

        function hide(string){
            var element=document.getElementById(string);
            element.style.display='none';
        }

        // PreviewTemplate For Multiple File dropzone Starts
        var previewNode = document.querySelector("#template");
        previewNode.id = "";
        var previewTemplate = previewNode.parentNode.innerHTML;
        previewNode.parentNode.removeChild(previewNode);
        // PreviewTemplate For Multiple File dropzone Ends
        Dropzone.autoDiscover = false;
        // Dropzone Js For Multiple File Upload Starts
        function callDropzone(
            {
                url,
                params,
                acceptedFiles="{{ config('const.customer_feedback_accepted_files') }}",
                maxFileSize={{ config('const.customer_feedback_file_size') }},
                parallelUploads={{ config('const.customer_feedback_parallel_file_upload') }},
                maxFiles={{ config('const.customer_feedback_max_file_upload') }}
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
            var projectId = $('#project_id').val();
            var url = "{{ route('feedback-img') }}";
            var params = {
                file_related_to: 'feedback_image',
                media_type: 'project',
                project_id: projectId
            };
            let html = `<h6><strong>Images:</strong> .gif .heic .jpeg, .jpg .png .svg .webp</h6>`;
            var acceptedFiles = "{{ config('const.customer_feedback_accepted_files') }}";

            $('#multiModal .accepted-file-list').html(html);
            $('#multiModal').modal('show');

            var dropzone = callDropzone({url: url, params: params, acceptedFiles: acceptedFiles});

            dropzone.on("successmultiple", function(file, responses) {
                fetch_feedback_file();
            });
        }

        function fetch_feedback_file(){
            $.ajax({
                type:'get',
                url:`{{ route("get-feedback-img", ['id' => $project_id]) }}`,
                success:function(response){
                    $('#getfilesformdb').empty();
                    let video_html = '', image_html = '', doc_html = '', html ='';

                    for (let data of response) {
                        if (data.file_type.toLowerCase() == 'video' && $(`#${data.encoded_id}`).length == 0) {
                            video_html += `<div class="d-inline mr-5" id="${data.encoded_id}">
                                                <a href="javascript:void(0)" class="mb-3" onclick="confirmDeletePopup('${data.encoded_id}','#${data.encoded_id}')">
                                                    <video src="${data.url}" class="rectangle-video-lg"></video>
                                                    <div class="remove_img h-95" title="${data.file_name}">
                                                        <svg class="center-svg" width="22" height="23" viewBox="0 0 22 23" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path d="M3.28033 0.54L11.0003 8.26L18.6803 0.58C18.85 0.399435 19.0543 0.254989 19.2812 0.155324C19.508 0.0556597 19.7526 0.00282869 20.0003 0C20.5308 0 21.0395 0.210714 21.4145 0.585786C21.7896 0.960859 22.0003 1.46957 22.0003 2C22.005 2.2452 21.9595 2.48877 21.8666 2.71576C21.7738 2.94275 21.6355 3.14837 21.4603 3.32L13.6803 11L21.4603 18.78C21.79 19.1025 21.9832 19.5392 22.0003 20C22.0003 20.5304 21.7896 21.0391 21.4145 21.4142C21.0395 21.7893 20.5308 22 20.0003 22C19.7454 22.0106 19.4911 21.968 19.2536 21.8751C19.016 21.7821 18.8003 21.6408 18.6203 21.46L11.0003 13.74L3.30033 21.44C3.13134 21.6145 2.92945 21.7539 2.70633 21.85C2.4832 21.9461 2.24325 21.9971 2.00033 22C1.46989 22 0.961185 21.7893 0.586112 21.4142C0.211039 21.0391 0.000325413 20.5304 0.000325413 20C-0.00433758 19.7548 0.0411562 19.5112 0.134015 19.2842C0.226874 19.0572 0.36514 18.8516 0.540325 18.68L8.32032 11L0.540325 3.22C0.210695 2.89752 0.0174046 2.46082 0.000325413 2C0.000325413 1.46957 0.211039 0.960859 0.586112 0.585786C0.961185 0.210714 1.46989 0 2.00033 0C2.48033 0.006 2.94033 0.2 3.28033 0.54Z" fill="white" />
                                                        </svg>
                                                    </div>
                                                </a>
                                            </div>`;
                        } else if (data.file_type.toLowerCase() == 'image' && $(`#${data.encoded_id}`).length == 0) {
                            image_html += `<div class="d-inline mr-5" id="${data.encoded_id}">
                                            <a href="javascript:void(0)" class="mb-3" onclick="confirmDeletePopup('${data.encoded_id}', '#${data.encoded_id}')">
                                                <img src="${data.url}" alt="" class="rectangle-img-lg center-svg">
                                                <div class="remove_img h-100" title="${data.file_name}">
                                                    <svg class="center-svg" width="22" height="23" viewBox="0 0 22 23" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M3.28033 0.54L11.0003 8.26L18.6803 0.58C18.85 0.399435 19.0543 0.254989 19.2812 0.155324C19.508 0.0556597 19.7526 0.00282869 20.0003 0C20.5308 0 21.0395 0.210714 21.4145 0.585786C21.7896 0.960859 22.0003 1.46957 22.0003 2C22.005 2.2452 21.9595 2.48877 21.8666 2.71576C21.7738 2.94275 21.6355 3.14837 21.4603 3.32L13.6803 11L21.4603 18.78C21.79 19.1025 21.9832 19.5392 22.0003 20C22.0003 20.5304 21.7896 21.0391 21.4145 21.4142C21.0395 21.7893 20.5308 22 20.0003 22C19.7454 22.0106 19.4911 21.968 19.2536 21.8751C19.016 21.7821 18.8003 21.6408 18.6203 21.46L11.0003 13.74L3.30033 21.44C3.13134 21.6145 2.92945 21.7539 2.70633 21.85C2.4832 21.9461 2.24325 21.9971 2.00033 22C1.46989 22 0.961185 21.7893 0.586112 21.4142C0.211039 21.0391 0.000325413 20.5304 0.000325413 20C-0.00433758 19.7548 0.0411562 19.5112 0.134015 19.2842C0.226874 19.0572 0.36514 18.8516 0.540325 18.68L8.32032 11L0.540325 3.22C0.210695 2.89752 0.0174046 2.46082 0.000325413 2C0.000325413 1.46957 0.211039 0.960859 0.586112 0.585786C0.961185 0.210714 1.46989 0 2.00033 0C2.48033 0.006 2.94033 0.2 3.28033 0.54Z" fill="white" />
                                                    </svg>
                                                </div>
                                            </a>
                                        </div>`;
                        } else if ($(`#${data.encoded_id}`).length == 0) {
                            doc_html += `<div class="d-inline mr-5" id="${data.encoded_id}">
                                            <a href="javascript:void(0)" class="mb-3" onclick="confirmDeletePopup('${data.encoded_id}', '#${data.encoded_id}')">
                                            <img src="{{ asset('frontend/img/file_logo.png') }}" alt="${data.file_name}" title="${data.file_name}" class="rectangle-img-lg center-svg" >
                                            <div class="remove_img h-100" title="'.$row->file_name.'">
                                                <svg class="center-svg" width="22" height="23" viewBox="0 0 22 23" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M3.28033 0.54L11.0003 8.26L18.6803 0.58C18.85 0.399435 19.0543 0.254989 19.2812 0.155324C19.508 0.0556597 19.7526 0.00282869 20.0003 0C20.5308 0 21.0395 0.210714 21.4145 0.585786C21.7896 0.960859 22.0003 1.46957 22.0003 2C22.005 2.2452 21.9595 2.48877 21.8666 2.71576C21.7738 2.94275 21.6355 3.14837 21.4603 3.32L13.6803 11L21.4603 18.78C21.79 19.1025 21.9832 19.5392 22.0003 20C22.0003 20.5304 21.7896 21.0391 21.4145 21.4142C21.0395 21.7893 20.5308 22 20.0003 22C19.7454 22.0106 19.4911 21.968 19.2536 21.8751C19.016 21.7821 18.8003 21.6408 18.6203 21.46L11.0003 13.74L3.30033 21.44C3.13134 21.6145 2.92945 21.7539 2.70633 21.85C2.4832 21.9461 2.24325 21.9971 2.00033 22C1.46989 22 0.961185 21.7893 0.586112 21.4142C0.211039 21.0391 0.000325413 20.5304 0.000325413 20C-0.00433758 19.7548 0.0411562 19.5112 0.134015 19.2842C0.226874 19.0572 0.36514 18.8516 0.540325 18.68L8.32032 11L0.540325 3.22C0.210695 2.89752 0.0174046 2.46082 0.000325413 2C0.000325413 1.46957 0.211039 0.960859 0.586112 0.585786C0.961185 0.210714 1.46989 0 2.00033 0C2.48033 0.006 2.94033 0.2 3.28033 0.54Z" fill="white" />
                                                </svg>
                                            </div>
                                        </a>
                                    </div>`;
                        }
                    }

                    if (image_html != '') {
                        if ($('#getfilesformdb .image_section').length)
                            $('#getfilesformdb .image_section').append(image_html);
                        else
                            $('#getfilesformdb').prepend('<div class="image_section"><h4>Image(s)</h4>'+image_html+'</div>');
                    } else {
                        $('#getfilesformdb').remove('.image_section');
                    }

                    if (video_html != '') {
                        if ($('#getfilesformdb .video_section').length)
                            $('#getfilesformdb .video_section').append(video_html);
                        else
                            $('#getfilesformdb').append('<div class="video_section"><h4>Video(s)</h4>'+video_html+'</div>');
                    } else {
                        $('#getfilesformdb').remove('.video_section');
                    }

                    if (doc_html != '') {
                        if ($('#getfilesformdb .file_section').length)
                            $('#getfilesformdb .file_section').append(doc_html);
                        else
                            $('#getfilesformdb').append('<div class="file_section"><h4>File(s)</h4>'+doc_html+'</div>');
                    } else {
                        $('#getfilesformdb').remove('.file_section');
                    }

                }
            });
        }


        function confirmDeletePopup(fileId, divId){
            $('#Delete_wp').modal('show');
            $('#confirmedDelete').on('click', function() {
                delete_feedback_file(fileId);
                $('#Delete_wp').modal('hide');
            });
        }

        function delete_feedback_file(deleteid){
            $.ajax({
                type:'POST',
                url:'{{ route("delete-feedback-img") }}',
                data:{
                    id: deleteid,
                    project_id: '{{ $project_id }}',
                    _method: 'delete',
                    _token: '{{csrf_token()}}'
                },
                success: function (data) {
                    $('#'+deleteid).remove();
                    $('#getfilesformdb .image_section div').length == 0 && $('#getfilesformdb .image_section').remove();
                    $('#getfilesformdb .video_section div').length == 0 && $('#getfilesformdb .video_section').remove();
                    $('#getfilesformdb .file_section div').length == 0 && $('#getfilesformdb .file_section').remove();
                },
            });
        }

        $(document).ready(function(){
            fetch_feedback_file();
	    });
    </script>
@endpush
