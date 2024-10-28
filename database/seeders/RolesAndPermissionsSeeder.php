<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run()
    {
        $roles = ['admin', 'doctor', 'specialist', 'patient'];

        foreach ($roles as $role) {
            if (!Role::where('name', $role)->exists()) {
                Role::create(['name' => $role]);
            }
        }

        // Optionally, add permissions here if needed
        // $permissions = ['some_permission'];
        // foreach ($permissions as $permission) {
        //     if (!Permission::where('name', $permission)->exists()) {
        //         Permission::create(['name' => $permission]);
        //     }
        // }
    }
}