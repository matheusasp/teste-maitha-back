<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Providers\UserService;
use Illuminate\Support\Facades\Route;

class AuthCustom
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */

    public function __construct(UserService $userService){
        $this->userService =  $userService;
    }

    public function handle(Request $request, Closure $next)
    {

      $path = $request->path();

      if (str_contains($path, 'product')) {
          $tokenRequest = [
            'token' => $request->bearerToken(),
            'id' =>  $request->route('idUser')
          ];
      } else {
          $tokenRequest = [
            'token' => $request->bearerToken(),
            'id' =>  $request->route('idUser')
          ];
      }

     $tokenRetrieved =  $this->userService->findByToken($tokenRequest);

     if($tokenRequest['token'] == null) {
        return response()->json([
          'unauthenticated'
      ]);
     }


     if($tokenRequest['token'] == $tokenRetrieved){
        return $next($request);
     } else {
         return response()->json([
            'unauthenticated', 401
        ]);
     }

    }
}
