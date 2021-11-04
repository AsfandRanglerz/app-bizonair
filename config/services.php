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
        'client_id' => '175078028163894',
        'client_secret' => '9af07d3463cddb8812e069b9d8c82e60',
        'redirect' => 'https://app.bizonair.com/facebook/callback/',
    ],
    'google' => [
        'client_id' => '279024755487-cb1smkf9iaqar5nupcugi1pfatfd9913.apps.googleusercontent.com',
        'client_secret' => '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',
        'redirect' => 'https://www.app.bizonair.com/google/callback/',
    ],
    'linkedin' => [
        'client_id' => '78zhkpbtuisl1o',
        'client_secret' => 'NAfSLhxnDdueebmF',
        'redirect' => 'https://app.bizonair.com/linkedin/callback/',
    ],
];
