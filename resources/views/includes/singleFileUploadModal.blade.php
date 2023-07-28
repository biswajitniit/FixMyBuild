{{-- <div class="modal fade select_address" id="companyLogoModal" tabindex="-1" aria-labelledby="companyModalLabel" aria-hidden="true"> --}}
<div class="modal fade select_address" id="singleFileUploadModal" tabindex="-1" aria-labelledby="singleFileUploadModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header pb-0">
                <h5 class="modal-title" id="singleFileUploadModalLabel">Upload File</h5>
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
                            <div class="accepted-file-list ext_">.gif .heic .jpeg, .jpg .png .svg .webp</div>
                        </h5>
                        <form method="post" enctype="multipart/form-data" id="multi_file_dropzone" class="dropzone text-center upload_wrap cpp_wrap">
                            @csrf

                            <div class="dz-default dz-message" id="file-upload-logo">
                                <img src="{{ asset('frontend/img/upload.svg') }}" alt="" />
                            </div>

                            <div class="files d-none" id="previews">
                                <div id="singleFileTemplate" class="dz-image-preview">
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
                <button type="button" class="btn btn-link" data-bs-dismiss="modal" id="cancel_single_file_upload">Cancel</button>
                <button type="button" class="btn btn-light" id="upload_single_file">Upload</button>
            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script>
        // PreviewTemplate For Single File dropzone Starts
        var singleFilePreviewNode = document.querySelector("#singleFileTemplate");
        singleFilePreviewNode.id = "";
        var singleFilepreviewTemplate = singleFilePreviewNode.parentNode.innerHTML;
        singleFilePreviewNode.parentNode.removeChild(singleFilePreviewNode);
        // PreviewTemplate For Single File dropzone Starts

        // Dropzone Js For Single File Upload Starts
        function singleFileDropzone(
            {
                url,
                params,
                acceptedFiles="{{ config('const.dropzone_accepted_file') }}",
                maxFileSize={{ config('const.dropzone_max_file_size') }},
                modalId="#singleFileUploadModal",
            }
        ) {
            var singleFileDropzoneElement = document.querySelector("#single_file_dropzone");
            var singleFileDropzone = singleFileDropzoneElement.dropzone;
            var thumbnailMapping = {
                'application/pdf': "{{ asset('frontend/img/pdf_logo.svg') }}",
                'application/msword': "{{ asset('frontend/img/doc_logo.svg') }}",
                'application/vnd.openxmlformats-officedocument.wordprocessingml.document': "{{ asset('frontend/img/doc_logo.svg') }}",
            };

            // If a Dropzone instance doesn't exist, create a new one
            if (!singleFileDropzone) {
                singleFileDropzone = new Dropzone(singleFileDropzoneElement, {
                    url: url,
                    params: params,
                    uploadMultiple: true,
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

            singleFileDropzone.on("success", function(file) {
                $(modalId).modal('hide');
            });

            // Setup the buttons for all transfers
            // The "add files" button doesn't need to be setup because the config
            // `clickable` has already been specified.
            document.querySelector("#upload_single_file").onclick = function() {
                singleFileDropzone.enqueueFiles(singleFileDropzone.getFilesWithStatus(Dropzone.ADDED));
            };

            document.querySelector("#cancel_single_file_upload").onclick = function() {
                singleFileDropzone.removeAllFiles(true);
            };

            // $(modalId).on('hidden.bs.modal', function(e){
            //     singleFileDropzone.removeAllFiles(true);
            // });

            return singleFileDropzone;
        }
        // Dropzone Js For Single File Upload Ends
    </script>
@endpush
