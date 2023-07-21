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

            multiFileDropzone.on("successmultiple", function(file, responses) {
                $('#multiModal').modal('hide');
                multiFileDropzone.removeAllFiles(true);
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
            let html = `<h6><strong>Images:</strong> .gif .heic .jpeg, .jpg .png .svg .webp</h6>
                        <h6><strong>Documents:</strong> .doc, .docx .odt .pdf .ppt, .pptx .xls, .xlsx</h6>
                        <h6><strong>Audio:</strong> .mp3 .ogg .wav</h6>
                        <h6><strong>Video:</strong> .avi .mp4, .m4v .ogv .3gp .3g2</h6>`;
            var acceptedFiles = "{{ config('const.customer_feedback_accepted_files') }}";

            $('#multiModal .accepted-file-list').html(html);
            $('#multiModal').modal('show');

            var dropzone = callDropzone({url: url, params: params, acceptedFiles: acceptedFiles});

            dropzone.on("successmultiple", function(file, responses) {
                FetchfilesData();
            });
        }

    </script>
@endpush
