<?php

use Illuminate\Session\Middleware\StartSession;

return [

    /*
    |--------------------------------------------------------------------------
    | Set Gee validate ID and Key
    |--------------------------------------------------------------------------
    |
    | The public key (ID) and private key (key) are obtained from the polar
    | experience management background and configured in the code.
    | The relative path of the configuration file is as follows.
    |
    */

    'id' => env('GEEVALIDATE_ID', ''),

    'key' => env('GEEVALIDATE_KEY', ''),


    /*
    |--------------------------------------------------------------------------
    | Set Gee validate encryption method
    |--------------------------------------------------------------------------
    |
    | This version of the SDK can support MD5, sha256, hmac-sha256.
    | If the algorithm other than MD5 needs special configuration account,
    | contact the customer service of polar inspection.
    |
    */

    'encrypt_method' => env('GEEVALIDATE_ENCRYPT', 'md5'),


    /*
    |--------------------------------------------------------------------------
    | Set Gee validate routes
    |--------------------------------------------------------------------------
    |
    | Here you need to set the routing address and middleware used in the registration.
    | When it is not needed, you can register by yourself.
    |
    */

    'auto_regist_route' => true,

    'auto_regist_route_path' => "",

    'auto_regist_middlewares' => [StartSession::class],


    /*
    |--------------------------------------------------------------------------
    | Set Gee validate error http code
    |--------------------------------------------------------------------------
    |
    | Here you need to set the HTTP status code returned when
    | the request does not meet the verification
    |
    */

    'error_code' => 412,

];
