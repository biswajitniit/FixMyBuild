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
                        <div>
                            <h4>Supported file type list:</h4>
                            <div class="accepted-file-list"></div>
                            <h6><strong>Maximum file size:</strong> {{ config('const.dropzone_max_file_size') }} MB</h6>
                        </div>
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


@push('scripts')
<script>

    var previewNode = document.querySelector("#template");
    previewNode.id = "";
    var previewTemplate = previewNode.parentNode.innerHTML;
    previewNode.parentNode.removeChild(previewNode);

    function callDropzone(
        {
            url,
            params,
            acceptedFiles="{{ config('const.dropzone_accepted_file') }}",
            maxFileSize={{ config('const.dropzone_max_file_size') }},
            parallelUploads={{ config('const.dropzone_parallel_file_upload') }},
            maxFiles={{ config('const.dropzone_max_file_upload') }},
            successMultipleCallback
        }
    ) {
        var multiFileDropzoneElement = document.querySelector("#multi_file_dropzone");
        var multiFileDropzone = multiFileDropzoneElement.dropzone;
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
            if (successMultipleCallback && typeof successMultipleCallback === 'function') {
            successMultipleCallback(file, responses);
            }
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


        // $('#multiModal').on('hidden.bs.modal', function(e){
            // multiFileDropzone.removeAllFiles(true);
        // });

        return multiFileDropzone;
    }
</script>
@endpush
