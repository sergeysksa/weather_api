<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use App\Repositories\UserRepository;
use App\Services\AuthService;
use App\Services\GeoLocationService;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Laravel\Socialite\Facades\Socialite;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{

    public function __construct(
        private AuthService $authCheckService,
        private string $currentRemoteProvider = 'google',
    ){}

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

    public function register(RegisterRequest $registerRequest)
    {
        $user = User::create([
            'first_name' => $registerRequest->first_name,
            'last_name' => $registerRequest->last_name,
            'email' => $registerRequest->email,
            'password' => Hash::make($registerRequest->password),
        ]);

        Auth::login($user);

        return  $registerRequest->user();
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

    public function authCheck(): Response
    {
        return $this->authCheckService->authCheck();
    }
}
