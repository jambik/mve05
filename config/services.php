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

    'github' => [
        'client_id' => env('GITHUB_KEY'),
        'client_secret' => env('GITHUB_SECRET'),
        'redirect' => env('GITHUB_REDIRECT'),
    ],

    'twitter' => [
        'client_id' => env('TWITTER_KEY'),
        'client_secret' => env('TWITTER_SECRET'),
        'redirect' => env('TWITTER_REDIRECT'),
    ],

    'facebook' => [
        'client_id' => env('FACEBOOK_KEY'),
        'client_secret' => env('FACEBOOK_SECRET'),
        'redirect' => env('FACEBOOK_REDIRECT'),
    ],

    'vkontakte' => [
        'client_id' => env('VKONTAKTE_KEY'),
        'client_secret' => env('VKONTAKTE_SECRET'),
        'redirect' => env('VKONTAKTE_REDIRECT'),
    ],

    'yandex' => [
        'client_id' => env('YANDEX_KEY'),
        'client_secret' => env('YANDEX_SECRET'),
        'redirect' => env('YANDEX_REDIRECT'),
    ],

    'google' => [
        'client_id' => env('GOOGLE_KEY'),
        'client_secret' => env('GOOGLE_SECRET'),
        'redirect' => env('GOOGLE_REDIRECT'),
    ],

    'odnoklassniki' => [
        'client_id' => env('ODNOKLASSNIKI_KEY'),
        'client_secret' => env('ODNOKLASSNIKI_SECRET'),
        'redirect' => env('ODNOKLASSNIKI_REDIRECT'),
    ],

    'mailru' => [
        'client_id' => env('MAILRU_KEY'),
        'client_secret' => env('MAILRU_SECRET'),
        'redirect' => env('MAILRU_REDIRECT'),
    ],

];
