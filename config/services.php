<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Mailgun, Postmark, AWS and more. This file provides the de facto
    | location for this type of information, allowing packages to have
    | a conventional file to locate the various service credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
        'endpoint' => env('MAILGUN_ENDPOINT', 'api.mailgun.net'),
    ],

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],
    'facebook' => [
        'client_id' => env('FACEBOOK_APP_ID'),
        'client_secret' => env('FACEBOOK_APP_SECRET'),
        'redirect' => env('FACEBOOK_REDIRECT'),
    ],
    'google' => [
        'client_id' => env('GOOGLE_APP_ID'),
        'client_secret' => env('GOOGLE_APP_SECRET'),
        'redirect' => env('GOOGLE_REDIRECT')
    ],
    // 'office' => [
    //     'client_id' => env('FACEBOOK_APP_ID'),
    //     'client_secret' => env('FACEBOOK_APP_SECRET'),
    //     'redirect' => env('FACEBOOK_REDIRECT'),
    // ],
    // 'facebook' => [
    //     'client_id' => env('FACEBOOK_APP_ID'),
    //     'client_secret' => env('FACEBOOK_APP_SECRET'),
    //     'redirect' => env('FACEBOOK_REDIRECT'),
    // ]
    "apple" => [
        "client_id" => "<your_client_id>",
        "client_secret" => "<your_client_secret>",
    ],
    'azure' => [
        'client_id' => env('AZURE_CLIENT_ID'),
        'client_secret' => env('AZURE_CLIENT_SECRET'),
        'redirect' => env('AZURE_REDIRECT_URI'),
        'tenant' => env('AZURE_TENANT_ID'),
        'proxy' => env('PROXY')  // optionally
    ],

];
