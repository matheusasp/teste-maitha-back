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
           return $user->getAttributes()['token'];
        }
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }
}
