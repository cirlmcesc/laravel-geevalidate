<?php

namespace Cirlmcesc\LaravelGeevalidate;

use Illuminate\Http\Request;
use Illuminate\Contracts\Cache\Repository as Cache;
use Illuminate\Support\Traits\Macroable;
use Cirlmcesc\LaravelGeevalidate\Requests\RegisterGeevalidate;
use Cirlmcesc\LaravelGeevalidate\Geesdk\GeetestLib;

class LaravelGeevalidate
{
    use Macroable;

    /**
     * cache variable
     *
     * @var Cache
     */
    private $cache;

    /**
     * geetest variable
     *
     * @var GeetestLib
     */
    private $geetest;

    /**
     * construct function
     */
    public function __construct(Cache $cache, GeetestLib $geetest)
    {
        $this->cache = $cache;

        $this->geetest = $geetest;
    }

    /**
     * register function
     *
     * @param RegisterGeevalidate $request
     * @return array
     */
    public function register(RegisterGeevalidate $request): array
    {
        $resault = $this->geetest->register(config('geevalidate.encrypt_method'), [
            'digestmod' => config('geevalidate.encrypt_method'),
            'user_id' => $user_id = session()->all()['_token'],
            'client_type' => $request->input('client_type'),
            'ip_address' => $request->getClientIp(),
        ]);

        $this->cache->add($user_id.':'.GeetestLib::GEETEST_SERVER_STATUS_SESSION_KEY, $resault->getStatus(), 300);

        return array_merge($resault->getData(), ["geevalidate_token" => $user_id]);
    }

    /**
     * validate function
     *
     * @param Request $request
     * @return boolean
     */
    public function validate(Request $request): bool
    {
        $register_data = [
            "user_id" => $user_id = $request->input("geevalidate_token"),
            "client_type" => $request->input('client_type'),
            "ip_address" => $request->getClientIp(),
        ];

        $validate_data = collect([
            $request->input(GeetestLib::GEETEST_CHALLENGE),
            $request->input(GeetestLib::GEETEST_VALIDATE),
            $request->input(GeetestLib::GEETEST_SECCODE),
        ]);

        return $this->cache->get($user_id.':'.GeetestLib::GEETEST_SERVER_STATUS_SESSION_KEY, 0) == 1
            ? $this->geetest->successValidate(...$validate_data->push($register_data)->toArray()) == 1
            : $this->geetest->failValidate(...$validate_data->toArray()) == 1;
    }
}
