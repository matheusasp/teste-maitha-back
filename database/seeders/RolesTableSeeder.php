<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */


     public function run()
     {
         $roles = [
             'admin',
             'common'
         ];
     
         foreach ($roles as $role) {
             Role::firstOrCreate(['name' => $role]);
         }
     }
}