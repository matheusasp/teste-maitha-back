<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\App;
use Illuminate\Http\Request;
use App\Providers\UserService;
use App\Models\User;


class UserController extends Controller
{
    
    public function __construct(UserService $userService){
        $this->userService =  $userService;
    }

    public function getUser(int $id): User {
        try{
            return $this->userService->find($id);
        }
        catch(Exception $e){
            return $e;
        }
    }

    public function insertUser(Request $request): User {
       $userDto = $this->userService->makeUserDto($request->all());
       return $this->userService->createOrUpdate($userDto);
    }

    public function statusActiveUser(int $id) {

        $user = User::find($id);

        if($user->active) {
            $user->active = false;
        } else {
            $user->active = true;
        }

        $user->save();
        return $user;
    }

    public function deleteUser(int $id) {

       $this->userService->delete($id);

        return response()->json([
            'id' => $id
        ]);
    }

}
