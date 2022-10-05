<?php

namespace App\Repositories;

use App\Models\User;

class UserRepository
{
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

    public function getAuthUserData(): User
    {
        return User::find( auth()->user()->id );
    }
}
