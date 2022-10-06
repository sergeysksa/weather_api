<?php

namespace App\Services;

use App\Models\User;
use Symfony\Component\HttpFoundation\Response;

class AuthService
{

    public function authCheck(): Response
    {
        if(!auth()->check()) {
            return response('User not Auth', 401);
        }

        if(auth()->user()->id){
            return response()->json([
                'user' => auth()->user(),
                'token'=> auth()->user()->createToken('wheather')->plainTextToken
            ]);
        }
    }

    public function addUser(array $data): User
    {
        $userData = [
            ...$data,
            "password" => bcrypt($data['password'])
        ];

        return User::create($userData);
    }

    public function updateOrCreateWithSocialProvider($user, $provider, $location): User
    {
        return User::updateOrCreate([
            'provider_id'       => $user->id,
        ], [
            'first_name'        => $user->name,
            'email'             => $user->email,
            'provider'          => $provider,
            'provider_id'       => $user->id,
            'status'            => 'active',
            'avatar'            => $user->avatar ?? '',
            'avatar_original'   => $user->avatar_original ?? '',
            'user_location'     => $location
        ]);
    }
}
