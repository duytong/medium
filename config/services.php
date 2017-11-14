<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Stripe, Mailgun, SparkPost and others. This file provides a sane
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
        'client_id' => 'aR1216TbCLEsEXh0uY44JRsBP',
        'client_secret' => 'oriNnxt5ONQnc2NJQ2h3jNBwHkgsxLQAVNAmkZU27LacSzAIn7',
        'redirect' => 'http://localhost:8000/signin/twitter/callback',
    ],

    'facebook' => [
        'client_id' => '1225379060942089',
        'client_secret' => 'c54894fa2e32492b0dff53dd02e5c9a5',
        'redirect' => 'http://localhost:8000/signin/facebook/callback',
    ],

    'google' => [
        'client_id' => '1035940104690-1h2vegn5trn6l10fvm1hsqivetpgr0te.apps.googleusercontent.com',
        'client_secret' => 'aCyynof3BSipF1S39YrWeLGx',
        'redirect' => 'http://localhost:8000/signin/google/callback',
    ],

    'github' => [
        'client_id' => '9534e3cda03c0ed4603b',
        'client_secret' => '98cd2aee9bd935a05808e44b38db178723915e08',
        'redirect' => 'http://localhost:8000/signin/github/callback'
    ],
];
