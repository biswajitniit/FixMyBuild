<!doctype html>
<html class="no-js" lang="en">
   <head>
      <meta charset="utf-8">
      <meta http-equiv="x-ua-compatible" content="ie=edge">
      <title>FixMyBuild</title>
      <meta name="description" content="">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta name="_token" content="<?php echo e(csrf_token()); ?>">
      <!-- Favicon -->
      <!-- <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.ico"> -->

    

    <script src="<?php echo e(asset('frontend/dropzone/jquery.min.js')); ?>"></script>
    <link rel="stylesheet" href="<?php echo e(asset('frontend/dropzone/dropzone.min.css')); ?>">
    <script src="<?php echo e(asset('frontend/dropzone/dropzone.js')); ?>"></script>
    <link rel="stylesheet" href="<?php echo e(asset('frontend/css/bootstrap.min.css')); ?>">
    <style>
        /* body {
            background-color: #EDF7EF
        } */
    </style>
   </head>
   <body >
    <div class="container">
        <div class="row">
            <div class="col-md-6 supported_">
            <h4>Supported file type list:</h4>
            <h6><strong>Images:</strong> .gif .heic .jpeg, .jpg .png .svg .webp</h6>
            <h6><strong>Documents:</strong> .doc, .docx .key .odt .pdf .ppt, .pptx, .pps, .ppsx .xls, .xlsx</h6>
            <h6><strong>Audio:</strong> .mp3 .m4a .ogg .wav</h6>
            <h6><strong>Video:</strong> .avi .mpg .mp4, .m4v .mov .ogv .vtt .wmv .3gp .3g2</h6>
            </div>
            <div class="col-md-6">
                <div class="row"></div>
            <div class="text-center upload_wrap">
                <form method="post" action="<?php echo e(route('dropzonesave')); ?>" enctype="multipart/form-data" class="dropzone" id="dropzone">
                    <?php echo csrf_field(); ?>
                </form>
            </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        Dropzone.options.dropzone =
        {
            maxFilesize: 1024,
            resizeQuality: 1.0,
            //acceptedFiles: ".jpeg,.jpg,.png,.gif",
            acceptedFiles: 'image/*,application/pdf,.doc,.docx,.xls,.xlsx,.csv,.tsv,.ppt,.pptx,.pages,.odt,.rtf,video/x-ms-asf,video/x-ms-wmv,video/x-ms-wmx,video/x-ms-wm,video/avi,video/divx,video/x-flv,video/quicktime,video/mpeg,video/mp4,video/ogg,video/webm,video/x-matroska,video/3gpp,video/3gpp2,text/plain,text/csv,text/tab-separated-values,text/calendar,text/richtext,text/css,text/html,text/vtt,application/ttaf+xml,audio/mpeg,audio/aac,audio/x-realaudio,audio/wav,audio/ogg,audio/flac,audio/midi,audio/x-ms-wma,audio/x-ms-wax,audio/x-matroska,application/rtf,application/javascript,application/pdf,application/x-shockwave-flash,application/java,application/x-tar,application/zip,application/x-gzip,application/rar,application/x-7z-compressed,application/x-msdownload,application/octet-stream,application/octet-stream,application/msword,application/vnd.ms-powerpoint,application/vnd.ms-write,application/vnd.ms-excel,application/vnd.ms-access,application/vnd.ms-project,application/vnd.openxmlformats-officedocument.wordprocessingml.document,application/vnd.ms-word.document.macroEnabled.12,application/vnd.openxmlformats-officedocument.wordprocessingml.template,application/vnd.ms-word.template.macroEnabled.12,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet,application/vnd.ms-excel.sheet.macroEnabled.12,application/vnd.ms-excel.sheet.binary.macroEnabled.12,application/vnd.openxmlformats-officedocument.spreadsheetml.template,application/vnd.ms-excel.template.macroEnabled.12,application/vnd.ms-excel.addin.macroEnabled.12,application/vnd.openxmlformats-officedocument.presentationml.presentation,application/vnd.ms-powerpoint.presentation.macroEnabled.12,application/vnd.openxmlformats-officedocument.presentationml.slideshow,application/vnd.ms-powerpoint.slideshow.macroEnabled.12,application/vnd.openxmlformats-officedocument.presentationml.template,application/vnd.ms-powerpoint.template.macroEnabled.12,application/vnd.ms-powerpoint.addin.macroEnabled.12,application/vnd.openxmlformats-officedocument.presentationml.slide,application/vnd.ms-powerpoint.slide.macroEnabled.12,application/onenote,application/oxps,application/vnd.ms-xpsdocument,application/vnd.oasis.opendocument.text,application/vnd.oasis.opendocument.presentation,application/vnd.oasis.opendocument.spreadsheet,application/vnd.oasis.opendocument.graphics,application/vnd.oasis.opendocument.chart,application/vnd.oasis.opendocument.database,application/vnd.oasis.opendocument.formula,application/wordperfect,application/vnd.apple.keynote,application/vnd.apple.numbers,application/vnd.apple.pages',
            addRemoveLinks: true,
            timeout: 60000,
            removedfile: function(file)
            {
                var name = file.upload.filename;
                //alert(name); return false;
                $.ajax({
                    headers: {
                                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                            },
                    type: 'POST',
                    url: '<?php echo e(url("dropzonedestroy")); ?>',
                    data: {filename: name},
                    success: function (data){
                        console.log("File has been successfully removed!!");
                        //alert('File has been successfully removed!!'); return false;
                    },
                    error: function(e) {
                        console.log(e);
                    }});
                    var fileRef;
                    return (fileRef = file.previewElement) != null ?
                    fileRef.parentNode.removeChild(file.previewElement) : void 0;
            },
            success: function (file, response) {
                console.log(response);
            },
            error: function (file, response) {
                return false;
            }
        };
    </script>


    </body>
</html>
<?php /**PATH E:\webdev\FixMyBuild\resources\views/media/dropzone.blade.php ENDPATH**/ ?>