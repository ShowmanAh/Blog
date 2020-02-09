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
    //configuration socialite to add credentials for the OAuth services
    'github' => [
        //client id for github user
        'client_id' => '5c7eea574e452fb233e9',
        //client Secret for github user
        'client_secret' => '685a9312138cfa82f950d01b445eec7fa57fb83e',
        //call back data returned from github
        'redirect' => 'http://localhost:8000/login/github/callback',
    ],
    'facebook' => [
        //client id for facebook user
        'client_id' => '737329200089125',
        //client Secret for facebook user
        'client_secret' => 'a57606333015215e099649833ff738f5',
        //call back data returned from facebook
        'redirect' => 'http://localhost:8000/login/facebook/callback',
    ],
    'google' => [
        //client id for google user
        'client_id' => '48584532408-o9ci51gilkfd7nbg51gd5v9kbs132eb0.apps.googleusercontent.com',
        //client Secret for google user
        'client_secret' => 'bwl8GNHj_7zYlBqvMwunTyI-',
        //call back data returned from google
        'redirect' => 'http://localhost:8000/login/google/callback',
    ],

];
