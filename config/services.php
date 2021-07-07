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
        'client_id' => '1010861139657162',  //client face của bạn
        'client_secret' => '778975ce24c48589389078d53d885765',  //client app service face của bạn
        'redirect' => 'http://localhost/shopbanhanglaravel/admin/callback' //callback trả về
    ],
    'google' => [
        'client_id' => '174318322290-e7l3c1otg1bvde2nfd4notpqlk95v9nt.apps.googleusercontent.com',
        'client_secret' => 'tPH865yq4RSmNzwNu5UgRITw',
        'redirect' => 'http://localhost/shopbanhanglaravel/google/callback' 
    ],


];
