<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Crypt;
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
        $role1=Role::create(['name' => 'GM']);
        $role2= Role::create(['name' => 'Head']);
       $role3=  Role::create(['name' => 'Team Leader']);
       $role4=  Role::create(['name' => 'Team']);
       $role5=  Role::create(['name' => 'Secretary']);
        $role3 = Role::create(['name' => 'Super-Admin']);

        $user = \App\Models\Users::create([
            'name' => 'super admin',
            'email' => 'superadmin@example.com',
            'password' => Crypt::encryptString('superadmin'),
            'is_admin' => 1,
            'approved' => 1,
        ]);
        $user1 = \App\Models\Users::create([
            'name' => 'gm',
            'email' => 'gm@example.com',
            'password' => Crypt::encryptString('123456789'),
            'department_id'=>1,
            'approved' => 1,
        ]);
        $user2 = \App\Models\Users::create([
            'name' => 'hd',
            'email' => 'hd@example.com',
            'password' => Crypt::encryptString('123456789'),
            'department_id'=>3,
            'approved' => 1,
        ]);
        $user3 = \App\Models\Users::create([
            'name' => 'team',
            'email' => 'team@example.com',
            'password' => Crypt::encryptString('123456789'),
            'department_id'=>3,
            'approved' => 1,
        ]);
        $user->assignRole($role3);
        $user1->assignRole($role1);
        $user2->assignRole($role2);
        $user3->assignRole($role4);
    }
}
