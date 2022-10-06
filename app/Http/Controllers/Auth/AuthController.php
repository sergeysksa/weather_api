<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Services\AuthService;
use App\Services\GeoLocationService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Laravel\Socialite\Facades\Socialite;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{

    public function __construct(
        private AuthService $authService,
        private GeoLocationService $geoLocationService,
        private string $currentRemoteProvider = 'google',
    ){}


    public function login(LoginRequest $request): mixed
    {
        if (!Auth::attempt($request->validated())) {
            throw ValidationException::withMessages([
                'email' => trans('auth.failed'),
            ]);
        }

        $request->session()->regenerate();
        return $request->user();
    }


    public function register(RegisterRequest $registerRequest):mixed
    {
        $user = $this->authService->addUser($registerRequest->validated());

        Auth::login($user);

        return $registerRequest->user();
    }


    public function loginWithProvider() : RedirectResponse
    {
        return Socialite::driver($this->currentRemoteProvider)->redirect();
    }


    public function providerCallback(): RedirectResponse
    {
        $user = Socialite::driver($this->currentRemoteProvider)->user();
        $userLocation =$this->geoLocationService->getClientLocation();
        $user = $this->authService
                ->updateOrCreateWithSocialProvider(
                    $user,
                    $this->currentRemoteProvider,
                    $userLocation
                );

        Auth::login($user);

        return redirect()->to('/dashboard');
    }


    public function authCheck(): Response
    {
        return $this->authService->authCheck();
    }

    public function createToken(Request $request): array
    {
        $token = $request->user()->createToken('wheather');
        return ['token' => $token->plainTextToken];
    }
}
