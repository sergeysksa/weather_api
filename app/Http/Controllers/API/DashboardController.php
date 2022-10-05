<?php

namespace App\Http\Controllers\API;

use App\Http\Resources\UserResource;
use App\Http\Resources\WheatherResource;
use App\Repositories\UserRepository;
use App\Services\WheatherService;

class DashboardController
{

    public function __construct(
        private UserRepository $userRepository,
        private WheatherService $wheatherService
    ){}

    public function index(): array
    {
        $userData = $this->userRepository->getAuthUserData();
        $userWheatherData = $this->wheatherService->getWeatherSituationByUserData()->main;

        return [
            'user'  => new UserResource( $userData ),
            'main'  => new WheatherResource($userWheatherData),
        ];
    }
}
