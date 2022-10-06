<?php

namespace App\Repositories;

use App\Models\User;

class UserRepository
{
    public function getAuthUserData(): User
    {
        return User::find( auth()->user()->id );
    }
}
