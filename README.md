# Laravel Gee Validate

TL;DR
-----
[Geetest](https://www.geetest.com/) behavior verification package for Laravel. Inspired by [GeeTeam/gt3-server-php-laravel-sdk](https://github.com/GeeTeam/gt3-server-php-laravel-sdk/tree/master).

Install
-------
Install via composer
```shell
composer require cirlmcesc/laravel-geevalidate
```

**Configuration file** will be published to `config/`.
The mode of operation can be customized by modifying parameters and attributes.
```shell
php artisan geevalidate:install
```

**Add middleware** to `app\Http\Kernel.php` routeMiddleware's array. 
```php
protected $routeMiddleware = [
    ....
    'geevalidate' => \Cirlmcesc\LaravelGeevalidate\Middlewares\LaravelGeevalidateMiddleware::class,
];
```

Usage
-----
**Add middleware where you need to validate behavior**
**The first step:** Request to register the interface to get the front-end rendering parameters.
**The second step:** Attach three necessary parameters to the requested interface. `geevalidate_challenge, geevalidate_validate, geevalidate_seccode`
**When verification fails** The HTTP code of 412 will be returned. You can also modified in geevalidate.error_code.

Other
-----
You can use `LaraveGeevalidate::macro` to extend the method, and add parameters to the route to specify the verification method.
But finally, you need to call `$this - > validate()` to confirm whether the authentication is successful.
