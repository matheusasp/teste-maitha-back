<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\PermissionRequest;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use App\Models\User;
use App\Providers\UserService;

class PermissionController extends Controller
{
     /**
     * Store a newly created permission in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function __construct(UserService $userService){
        $this->userService =  $userService;
    }

    public function store(PermissionRequest $request)
    {
        $permission = Permission::create(['name' => $request->name]);
        
        $adminRole = Role::where('name', 'admin')->first();
        $adminRole->givePermissionTo($permission);

        return response()->json([
            'message' => 'Permission created successfully',
            'permission' => $permission,
        ], 201);
    }

    public function assignRole(Permission $permission, Role $role)
    {
        $role->givePermissionTo($permission);

        return response()->json([
            'message' => 'Permission assigned to role successfully'
        ]);
    }

    public function assignRoleToUser($idUser, Role $role)
    {
        try {
            $user = $this->userService->find($idUser);

            $user->assignRole($role);

            return response()->json([
                'message' => 'User assigned to role successfully'
            ]);

        }  catch(Exception $e) {
            return $e;
        }
    }

    public function getAllRoles()
    {
        $roles = Role::all();

        return response()->json([
            'message' => $roles
        ]);
    }

}