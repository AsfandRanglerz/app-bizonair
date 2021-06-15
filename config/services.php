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
        'secret' => env( 'AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],
    'facebook' => [
        'client_id' => '1084344805341566',
        'client_secret' => '1d56d39a68cd3e0641ad6150d9ab0b89',
        'redirect' => 'https://bizbeta.ranglerztech.website/facebook/callback/',
    ],
    'google' => [
        'client_id' => '935726213696-8btf06od878funsdjjd80qh2s1ohin17.apps.googleusercontent.com',
        'client_secret' => 'ogQIr6-6k4bykG7KhgWmzOPQ',
        'redirect' => 'https://bizbeta.ranglerztech.website/google/callback/',
    ],
    'linkedin' => [
        'client_id' => '78e9i6agogcb04',
        'client_secret' => 'PjWnD71mlzToDhI3',
        'redirect' => 'https://bizbeta.ranglerztech.website/linkedin/callback/',
    ],
];
