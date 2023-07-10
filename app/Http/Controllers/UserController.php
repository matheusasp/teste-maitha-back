<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\App;
use Illuminate\Http\Request;
use App\Providers\UserService;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    
    public function __construct(UserService $userService){
        $this->userService =  $userService;
    }

    public function getUser(Request $request): User {
        try{
            return $this->userService->find($request->route('idUserSearch'));
        }
        catch(Exception $e){
            return $e;
        }
    }

    public function getAllUser() {
        try{
            return $this->userService->all();
        }
        catch(Exception $e){
            return $e;
        }
    }

    public function insertUser(Request $request) {
       $userDto = $this->userService->makeUserDto($request->all());

       $user =  $this->userService->create($userDto);

       if ($request->has('role')) {

            $roleId = $request->input('role');
            
            $role = Role::find($roleId);
            if ($role) {
                $user->roles()->detach();
                $user->assignRole($role->name);
                $user->save();
            }
        }

        return response()->json([
            'message' => 'User created successfully',
            'user' => $user,
        ]);

    }

    public function updateUser(Request $request) {

        try {
            $user = $this->userService->find($request->id);

            $this->userService->update($request->id, $request->all());
    

            if ($request->has('role')) {

                $roleId = $request->input('role');
                
                $role = Role::find($roleId);
                if ($role) {
                    $user->roles()->detach();
                    $user->assignRole($role->name);
                    $user->save();
                }
            }
    
            return response()->json([
                'message' => 'User updated successfully',
                'user' => $user,
            ]);
        } catch(Exception $e) {
            return $e;
        }

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

    public function deleteUser(Request $request) {

       $this->userService->delete($request->route('idUserDelete'));

        return response()->json([
            'id' => $request->route('idUserDelete')
        ]);
    }
}
