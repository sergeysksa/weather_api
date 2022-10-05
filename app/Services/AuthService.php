<?php

namespace App\Services;

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
}
