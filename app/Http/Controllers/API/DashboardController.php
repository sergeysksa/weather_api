<?php

namespace App\Http\Controllers\API;

use App\Http\Resources\UserResource;
use App\Http\Resources\WheatherResource;
use App\Repositories\UserRepository;
use App\Services\WheatherService;

class DashboardController
{
    public function index(): array
    {
        $userData = (new UserRepository())->getAuthUserData();
        $userWheatherData = (new WheatherService())->getWeatherSituationByUserData()->main;

        return [
            'user'  => new UserResource( $userData ),
            'main'  => new WheatherResource($userWheatherData),
        ];
    }
}
