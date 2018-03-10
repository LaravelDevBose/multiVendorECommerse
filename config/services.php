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

    // LocalServer Developing Access
     // 'facebook' => [
     //     'client_id' => '401729490288624',         
     //     'client_secret' => '26fd41853ae049f430faf40206712560', 
     //     'redirect' => 'http://localhost/dorpon/login/facebook/callback',
     // ],

     // 'twitter' => [
     //     'client_id' => 'bw6IsnuHOti3SP6Ybqw1v1Bjw',        
     //     'client_secret' =>'PchtT5oGIAgJ9mmR5lkMb8RTXEC1uY5numQPXFOr0BnSMfRL4c',
     //     'redirect' => 'http://localhost/dorpon/login/twitter/callback',
     // ],

     // 'google' => [
     //     'client_id' => '863384272884-he55retp8mtie8lumru2hbl1hkg56hnn.apps.googleusercontent.com',   
     //     'client_secret' => 'Z5I-yPrcIT2MG9tkaAG-Tj6t', 
     //     'redirect' => 'http://localhost/dorpon/login/google/callback',
     // ],

    //   Live Server  Access
      'facebook' => [
          'client_id' => '140719639936808',         
          'client_secret' => 'c7d682c7c2943271c459681b64b1e459', 
          'redirect' => 'https://mydorpon.com/dorpon/login/facebook/callback',
      ],

      'twitter' => [
          'client_id' => 'zJwtDteMqUrAP54RVGtm9OzhT',        
          'client_secret' =>'DemPCgLHnwWnWqoKVjXlZvOlfkbhf38uDeR2LyXDLak4RpLCUj',
          'redirect' => 'https://mydorpon.com/dorpon/login/twitter/callback',
      ],

      'google' => [
          'client_id' => '846298329452-t9kf48jllianng8tqu98qa6v9h6rs0qa.apps.googleusercontent.com',   
          'client_secret' => 'nahudHHTdK10g6o2J7lTC-XP', 
          'redirect' => 'https://mydorpon.com/dorpon/login/google/callback',
      ],
    
 

];
