<?php

namespace App\Repositories;

use App\Models\User;

class UserRepository
{
    public function updateOrCreateWithSocialProvider($user, $provider, $location)
    {
        return User::updateOrCreate([
            'provider_id'       => $user->id,
        ], [
            'first_name'        => $user->name,
            'email'             => $user->email,
            'provider'          => $provider,
            'provider_id'       => $user->id,
            'avatar'            => $user->avatar ?? '',
            'avatar_original'   => $user->avatar_original ?? '',
            'user_location'     => $location
        ]);
    }

    public function findByGoogleId($id)
    {
        return User::where('google_id', $id)->first();
    }
}
