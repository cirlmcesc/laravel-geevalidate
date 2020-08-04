<?php

use Illuminate\Support\Facades\Route;

if (config("geevalidate.auto_regist_route")) {
    Route::middleware(config("geevalidate.auto_regist_middlewares"))
        ->group(function () {
            Route::get(config("geevalidate.auto_regist_route_path"), "LaravelGeevalidateController@register");
        });
}
