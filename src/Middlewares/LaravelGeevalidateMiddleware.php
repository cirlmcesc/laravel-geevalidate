<?php

namespace Cirlmcesc\LaravelGeevalidate\Middlewares;

use Closure;
use Cirlmcesc\LaravelGeevalidate\LaravelGeevalidate;

class LaravelGeevalidateMiddleware
{
    /**
     * validator variable
     *
     * @var LaravelGeevalidate
     */
    private $validator;

    /**
     * __construct function
     *
     * @param GeeTest $tester
     */
    public function __construct(LaravelGeevalidate $validator)
    {
        $this->validator = $validator;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  $behavior
     * @return mixed
     */
    public function handle($request, Closure $next, $behavior = 'validate')
    {
        if ($this->validator->$behavior($request) == false) {
            return responseGeevalidateError();
        }

        return $next($request);
    }
}
