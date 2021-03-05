<?php

namespace App\Http\Controllers;

use App\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth as AuthFacade;

class Auth extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (AuthFacade::attempt($credentials)) {
            $token = str_random(16);
            $user = User::where('email', $credentials['email'])->update(['token' => $token]);
            return $token;
        }

        abort(401);
    }
}
