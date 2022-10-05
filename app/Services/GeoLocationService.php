<?php

namespace App\Services;
use Stevebauman\Location\Facades\Location;

class GeoLocationService
{

    private const DEFAULT_IP = '172.67.71.253'; // from 'fairinternetreport.com'

    public function getClientLocation()
    {
        $userIp = request()->ip() === '127.0.0.1' ? self::DEFAULT_IP : request()->ip();
        return (Location::get($userIp))->cityName;
    }
}
