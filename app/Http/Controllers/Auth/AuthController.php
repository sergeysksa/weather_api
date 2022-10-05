<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Repositories\UserRepository;
use App\Services\GeoLocationService;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Laravel\Socialite\Facades\Socialite;

class AuthController extends Controller
{

    private string $currentRemoteProvider = 'google';
    /**
     * @param LoginRequest $request
     * @return mixed
     * @throws \Illuminate\Validation\ValidationException
     */
    public function login(LoginRequest $request): mixed
    {
        $request->authenticate();
        return  $request->user();
    }


    public function loginWithProvider() : RedirectResponse
    {
        return Socialite::driver($this->currentRemoteProvider)->redirect();
    }

    public function providerCallback()
    {
        $user = Socialite::driver($this->currentRemoteProvider)->user();
        $userLocation = (new GeoLocationService())->getClientLocation();
        $user = (new UserRepository)
                ->updateOrCreateWithSocialProvider(
                    $user,
                    $this->currentRemoteProvider,
                    $userLocation
                );

        Auth::login($user);

        return redirect()->to('/dashboard');
    }

}
