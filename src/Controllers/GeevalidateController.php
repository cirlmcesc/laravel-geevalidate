<?php

namespace Cirlmcesc\LaravelGeevalidate\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller;
use Cirlmcesc\LaravelGeevalidate\Requests\RegisterGeevalidate;
use Cirlmcesc\LaravelGeevalidate\LaravelGeevalidate;

class GeevalidateController extends Controller
{
    /**
     * RegisterGeevalidate function
     *
     * @param RegisterGeevalidate $request
     * @param LaravelGeevalidate $validator
     * @return JsonResponse
     */
    public function register(RegisterGeevalidate $request, LaravelGeevalidate $validator): JsonResponse
    {
        return responseHeader(response()->json($validator->register($request)));
    }
}
