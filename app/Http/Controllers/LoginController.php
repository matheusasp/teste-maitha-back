<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Providers\UserService;

class LoginController extends Controller
{

    public function __construct(UserService $userService){
        $this->userService =  $userService;
    }


    public function authenticate(Request $request)
    {

        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
           $user =  $this->userService->findByEmail($credentials['email']);
           return response()->json(['token' => $user->getAttributes()['token'], 'id' => $user->getAttributes()['id'] ], 200);
        }

        return response()->json(['error' => 'The provided credentials do not match our records.'], 401);
    }
}
