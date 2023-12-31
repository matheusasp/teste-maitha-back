<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

         User::factory()->create([
             'name' => 'Admin User',
             'email' => 'admin@example.com',
             'password' => Hash::make('1234'),
             'token' =>  Str::random(60),
         ]);

        $roles = [
            'admin',
            'common'
        ];
    
        foreach ($roles as $role) {
            Role::firstOrCreate(['name' => $role]);
        }

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

        $user = User::where('email', 'admin@example.com')->first();
        $user->assignRole('admin');

    }
}
