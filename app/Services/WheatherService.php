<?php

namespace App\Services;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class WheatherService
{

    private string $wheatherServiceUrl = 'https://api.openweathermap.org/data/2.5/weather?';

    public function getWeatherSituationByUserData()
    {
        $userLocation = auth()->user()->user_location ?? 'London';

        $appendedParameters = http_build_query([
            'q' => $userLocation,
            'APPID' => config('app.weather_api_key')
        ]);
        $getWeatherServiceUserLocationUrl = $this->wheatherServiceUrl.$appendedParameters;

        return Cache::get('user_wheather_data', static function () use ($getWeatherServiceUserLocationUrl) {
            return Http::get($getWeatherServiceUserLocationUrl)->object();
        });
    }
}
