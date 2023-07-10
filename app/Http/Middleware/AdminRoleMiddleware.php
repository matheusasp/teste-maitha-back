<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Laravel\Sanctum\PersonalAccessToken;
use Illuminate\Support\Facades\Route;
use App\Providers\UserService;

class AdminRoleMiddleware
{

    public function __construct(UserService $userService){
        $this->userService =  $userService;
    }

    public function handle(Request $request, Closure $next)
    {

        $accessToken = $request->bearerToken();

        $route = Route::currentRouteName();

        if ($accessToken) {
            $user = $this->userService->find($request->route('idUser')); 
        } else {
            return response()->json(['error' => 'Unauthorizedd'],401);
        }

        if($user->hasRole('admin')) {
            return $next($request);
        } 

        return response()->json(['error' => 'Unauthorized'], 401);

    }
}