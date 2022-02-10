<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

use Illuminate\Support\Facades\Hash;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        Permission::create(['name' => 'edit request']);
        Permission::create(['name' => 'delete request']);
        Permission::create(['name' => 'view request']);
        Permission::create(['name' => 'access request']);
        Permission::create(['name' => 'create request']);
        Permission::create(['name' => 'approve request']);
        Permission::create(['name' => 'authorize request']);
        Permission::create(['name' => 'export request']);
        Permission::create(['name' => 'store approve request']);

        //create role
        Role::create(['name' => 'Head']);
        Role::create(['name' => 'Team Leader']);
        Role::create(['name' => 'Team']);
        Role::create(['name' => 'Secretary']);
        $role3 = Role::create(['name' => 'Super-Admin']);

        $user = \App\Models\User::factory()->create([
            'name' => 'super admin',
            'email' => 'superadmin@example.com',
            'password' => Hash::make('123456789'),
            'is_admin' => 1,
            'approved' => 1,
        ]);
        $user->assignRole($role3);
    }
}
