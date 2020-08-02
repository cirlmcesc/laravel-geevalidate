<?php

use Illuminate\Http\JsonResponse;

if (! function_exists('responseHeader')) {
    /**
     * responseHeader function
     *
     * @param JsonResponse $response
     * @return JsonResponse
     */
    function responseHeader(JsonResponse $response): JsonResponse
    {
        return $response->withHeaders([
            'Access-Control-Allow-Methods' => 'POST, GET, PUT, DELETE, OPTIONS',
            'Access-Control-Allow-Headers' => 'Origin, X-Api-Token, X-Requested-With, Content-Type:application/json, Accept',
            'Access-Control-Allow-Credentials' => 'true',
        ]);
    }
}

if (! function_exists('responseError')) {
    /**
     * responseError function
     *
     * @param String $message
     * @param Array $errors
     * @param integer $http_status
     * @return \Illuminate\Http\JsonResponse
     */
    function responseError(String $message = '', Array $errors = [], $http_status = 422): JsonResponse
    {
        return responseHeader(response()->json([
            'errors' => $errors,
            'message' => $message,
        ], $http_status));
    }
}

if (! function_exists('responseGeevalidateError')) {
    /**
     * responseGeevalidateError function
     *
     * @return JsonResponse
     */
    function responseGeevalidateError(): JsonResponse
    {
        return responseError("validation.geevalidate-error", [], config('geevalidate.error_code', 412));
    }
}
