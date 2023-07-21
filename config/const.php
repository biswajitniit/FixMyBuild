<?php

return [
    'vat_charge' => env('VAT_CHARGE', 20),

    'dropzone_max_file_size'                            => env('DROPZONE_MAX_IMAGE_SIZE', 2),
    'dropzone_accepted_image'                           => env('DROPZONE_IMAGE_ACCEPTED', "image/heic, image/heif, image/jpeg, image/png, image/svg+xml, image/webp"),
    'dropzone_accepted_file'                            => env('DROPZONE_FILE_ACCEPTED', "image/heic, image/heif, image/jpeg, image/png, image/svg+xml, image/webp, application/pdf"),
    'trader_public_liability'                           => env('TRADER_PUBLIC_LIABILITY_FILES', "image/heic, image/heif, image/jpeg, image/png, image/svg+xml, image/webp, image/gif, application/pdf, application/vnd.openxmlformats-officedocument.presentationml.presentation, application/vnd.ms-powerpoint, application/vnd.openxmlformats-officedocument.wordprocessingml.document, application/msword, application/vnd.oasis.opendocument.text"),
    'dropzone_max_file_upload'                          => env('DROPZONE_MAX_FILE_UPLOAD', 6),
    'dropzone_parallel_file_upload'                     => env('DROPZONE_PARALLEL_FILE_UPLOAD', 6),
    'dropzone_project_file_accepted'                    => env('PROJECT_FILE_ACCEPTED', "image/heic, image/heif, image/jpeg, image/png, image/svg+xml, image/webp, image/gif, application/pdf, application/vnd.openxmlformats-officedocument.presentationml.presentation, application/vnd.ms-powerpoint, application/vnd.openxmlformats-officedocument.wordprocessingml.document, application/msword, application/vnd.oasis.opendocument.text, application/vnd.ms-excel, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, audio/mpeg, audio/ogg, audio/wav, video/x-msvideo, video/mp4, video/ogg, video/3gpp, audio/3gpp, video/3gpp2, audio/3gpp2"),

    'customer_notification_reviewed'                    => env('CUSTOMER_NOTIFICATION_REVIEWED', "1"),
    'customer_notification_paused'                      => env('CUSTOMER_NOTIFICATION_PAUSED', "1"),
    'customer_notification_project_milestone_complete'  => env('CUSTOMER_NOTIFICATION_PROJECT_MILESTONE_COMPLETE', "1"),
    'customer_notification_project_complete'            => env('CUSTOMER_NOTIFICATION_PROJECT_COMPLETE', "1"),
    'customer_notification_project_new_message'         => env('CUSTOMER_NOTIFICATION_PROJECT_NEW_MESSAGE', "1"),

    'trader_notification_reviewed'                      => env('TRADER_NOTIFICATION_REVIEWED', "1"),
    'trader_notification_paused'                        => env('TRADER_NOTIFICATION_PAUSED', "1"),
    'trader_notification_project_milestone_complete'    => env('TRADER_NOTIFICATION_PROJECT_MILESTONE_COMPLETE', "0"),
    'trader_notification_project_complete'              => env('TRADER_NOTIFICATION_PROJECT_COMPLETE', "1"),
    'trader_notification_project_new_message'           => env('TRADER_NOTIFICATION_PROJECT_NEW_MESSAGE', "0"),

    'trader_notification_builder_amendment'             => env('TRADER_NOTIFICATION_BUILDER_AMENDMENT', "0"),
    'trader_notification_new_estimates'                 => env('TRADER_NOTIFICATION_NEW_ESTIMATES', "1"),
    'trader_notification_estimate_accepted'             => env('TRADER_NOTIFICATION_ESTIMATE_ACCEPTED', "1"),
    'trader_notification_project_stopped'               => env('TRADER_NOTIFICATION_PROJECT_STOPPED', "1"),
    'trader_notification_estimate_rejected'             => env('TRADER_NOTIFICATION_ESTIMATE_REJECTED', "0"),
    'trader_notification_project_cancelled'             => env('TRADER_NOTIFICATION_PROJECT_CANCELLED', "0"),
    'trader_notification_share_contact_info'            => env('TRADER_NOTIFICATION_SHARE_CONTACT_INFO', "0"),
    'trader_notification_trader_new_message'            => env('TRADER_NOTIFICATION_TRADER_NEW_MESSAGE', "0"),

    'customer_feedback_accepted_files'                  => env('CUSTOMER_FEEDBACK_ACCEPTED_FILE_TYPES', "image/heic, image/heif, image/jpeg, image/png, image/svg+xml, image/webp, image/gif, application/pdf, application/vnd.openxmlformats-officedocument.presentationml.presentation, application/vnd.ms-powerpoint, application/vnd.openxmlformats-officedocument.wordprocessingml.document, application/msword, application/vnd.oasis.opendocument.text"),
    'customer_feedback_file_size'                       => env('CUSTOMER_FEEDBACK_MAX_IMAGE_SIZE', 2),
    'customer_feedback_parallel_file_upload'            => env('CUSTOMER_FEEDBACK_PARALLEL_FILE_UPLOAD', 6),
    'customer_feedback_max_file_upload'                 => env('CUSTOMER_FEEDBACK_MAX_FILE_UPLOAD', 6),

];
