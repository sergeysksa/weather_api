<?php

namespace App\Services;
use Stevebauman\Location\Facades\Location;

class GeoLocationService
{
    public function getClientLocation(): string|null
    {
        $userIp = request()->ip() === '127.0.0.1' ?  \config('default_demo_ip') : request()->ip();
        return (Location::get($userIp))->cityName;
    }
}
