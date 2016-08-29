<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Stripe, Mailgun, Mandrill, and others. This file provides a sane
    | default location for this type of information, allowing packages
    | to have a conventional place to find your various credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
    ],

    'ses' => [
        'key' => env('SES_KEY'),
        'secret' => env('SES_SECRET'),
        'region' => 'us-east-1',
    ],

    'sparkpost' => [
        'secret' => env('SPARKPOST_SECRET'),
    ],

    'stripe' => [
        'model' => App\User::class,
        'key' => env('STRIPE_KEY'),
        'secret' => env('STRIPE_SECRET'),
    ],
    'twitter' => [
        'client_id' => 'gQ3bXaeZCY1nLGHsf2OrjmrYP',
        'client_secret' => 'dI7EcB47RdF9d1OMKWXKTz9dIW0GuSUn5tgo5gJiIl4bJEIoVo',
        'redirect' => 'http://localhost:8000/add/twitter/callback',
    ],
    'trello' => [
        'client_id' => '11f8fe97697386aef404b0fd5f352dbb',
        'client_secret' => '9340ec158b6fe451d0206faabb4e62e15c31557c6ec487bfc4c50b1aa32a881d',
        'scope'=> 'read,write',
        'redirect' => 'http://localhost:8000/add/trello/callback',
    ],

];
