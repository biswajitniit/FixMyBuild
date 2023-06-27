<?php

return [
    'vat_charge' => env('VAT_CHARGE', 20),

    'dropzone_max_file_size' => env('DROPZONE_MAX_IMAGE_SIZE', 2),
    'dropzone_accepted_image'=> env('DROPZONE_IMAGE_ACCEPTED', "image/heic, image/heif, image/jpeg, image/png, image/svg+xml, image/webp"),
    'dropzone_accepted_file' => env('DROPZONE_FILE_ACCEPTED', "image/heic, image/heif, image/jpeg, image/png, image/svg+xml, image/webp, application/pdf"),
    'trader_public_liability'=> env('TRADER_PUBLIC_LIABILITY_FILES', "image/heic, image/heif, image/jpeg, image/png, image/svg+xml, image/webp, image/gif, application/pdf, application/vnd.openxmlformats-officedocument.presentationml.presentation, application/vnd.ms-powerpoint, application/vnd.openxmlformats-officedocument.wordprocessingml.document, application/msword, application/vnd.oasis.opendocument.text"),
];
