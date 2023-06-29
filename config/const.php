<?php

return [
    'vat_charge' => env('VAT_CHARGE', 20),

    'dropzone_max_file_size'            => env('DROPZONE_MAX_IMAGE_SIZE', 2),
    'dropzone_accepted_image'           => env('DROPZONE_IMAGE_ACCEPTED', "image/heic, image/heif, image/jpeg, image/png, image/svg+xml, image/webp"),
    'dropzone_accepted_file'            => env('DROPZONE_FILE_ACCEPTED', "image/heic, image/heif, image/jpeg, image/png, image/svg+xml, image/webp, application/pdf"),
    'trader_public_liability'           => env('TRADER_PUBLIC_LIABILITY_FILES', "image/heic, image/heif, image/jpeg, image/png, image/svg+xml, image/webp, image/gif, application/pdf, application/vnd.openxmlformats-officedocument.presentationml.presentation, application/vnd.ms-powerpoint, application/vnd.openxmlformats-officedocument.wordprocessingml.document, application/msword, application/vnd.oasis.opendocument.text"),
    'dropzone_max_file_upload'          => env('DROPZONE_MAX_FILE_UPLOAD', 6),
    'dropzone_parallel_file_upload'     => env('DROPZONE_PARALLEL_FILE_UPLOAD', 6),
    'dropzone_project_file_accepted'    => env('PROJECT_FILE_ACCEPTED', "image/heic, image/heif, image/jpeg, image/png, image/svg+xml, image/webp, image/gif, application/pdf, application/vnd.openxmlformats-officedocument.presentationml.presentation, application/vnd.ms-powerpoint, application/vnd.openxmlformats-officedocument.wordprocessingml.document, application/msword, application/vnd.oasis.opendocument.text, application/vnd.ms-excel, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, audio/mpeg, audio/ogg, audio/wav, video/x-msvideo, video/mp4, video/ogg, video/3gpp, audio/3gpp, video/3gpp2, audio/3gpp2"),
];
