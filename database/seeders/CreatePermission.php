<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
class CreatePermission extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permission = [
            [
                'name' => 'create-users',
                'guard_name' => 'api',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'create-product',
                'guard_name' => 'api',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];


        foreach($permission as $key => $value) {
            $permission = Permission::firstOrCreate(['name' => $value['name'], 'guard_name' => 'web']);
            $adminRole = Role::where('name', 'admin')->first();
            $adminRole->givePermissionTo($permission);
        }
        
    }
}