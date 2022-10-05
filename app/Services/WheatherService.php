<?php

namespace App\Services;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class WheatherService
{

    public function getWeatherSituationByUserData()
    {
        $userLocation = auth()->user()->user_location ?? \config('app.default_user_location');

        $appendedParameters = http_build_query([
            'q' => $userLocation,
            'APPID' => \config('app.weather_api_key')
        ]);

        $wheatherServiceUrl = \config('app.weather_api_url');

        $getWeatherServiceUserLocationUrl = $wheatherServiceUrl.$appendedParameters;

        return Cache::get('user_wheather_data', static function () use ($getWeatherServiceUserLocationUrl) {
            return Http::get($getWeatherServiceUserLocationUrl)->object();
        });
    }
}
