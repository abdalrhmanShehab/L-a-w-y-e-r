<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class PermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // create permissions user MNG
        Permission::create(['name' => 'get users']);
        Permission::create(['name' => 'edit user']);
        Permission::create(['name' => 'delete user']);
        Permission::create(['name' => 'create user']);
        Permission::create(['name' => 'view user']);
        // create permissions role MNG
        Permission::create(['name' => 'get roles']);
        Permission::create(['name' => 'edit role']);
        Permission::create(['name' => 'delete role']);
        Permission::create(['name' => 'create role']);
        Permission::create(['name' => 'view role']);
        // create permissions appointment MNG
        Permission::create(['name' => 'get appointments']);
        Permission::create(['name' => 'edit appointment']);
        Permission::create(['name' => 'delete appointment']);
        Permission::create(['name' => 'create appointment']);
        Permission::create(['name' => 'view appointment']);

        // create roles and assign existing permissions
        $role1 = Role::create(['name' => 'user']);
        $role1->givePermissionTo('view user');


        $role2 = Role::create(['name' => 'admin']);
        $role2->givePermissionTo('edit user');
        $role2->givePermissionTo('get users');
        $role2->givePermissionTo('delete user');
        $role2->givePermissionTo('create user');
        $role2->givePermissionTo('view user');
        $role2->givePermissionTo('edit role');
        $role2->givePermissionTo('get roles');
        $role2->givePermissionTo('delete role');
        $role2->givePermissionTo('create role');
        $role2->givePermissionTo('view role');
        $role2->givePermissionTo('edit appointment');
        $role2->givePermissionTo('get appointments');
        $role2->givePermissionTo('delete appointment');
        $role2->givePermissionTo('create appointment');
        $role2->givePermissionTo('view appointment');

        $role3 = Role::create(['name' => 'lawyer']);
        $role3->givePermissionTo('edit appointment');
        $role3->givePermissionTo('get appointments');
        $role3->givePermissionTo('delete appointment');
        $role3->givePermissionTo('create appointment');
        $role3->givePermissionTo('view appointment');

        // create demo users
        $user = \App\Models\User::factory()->create([
            'name' => 'User',
            'email' => 'user@email.com',
            'is_admin'=>'0',
            'password'=>bcrypt('123456789')
        ]);
        $user->assignRole($role1);

        $user = \App\Models\User::factory()->create([
            'name' => 'admin',
            'email' => 'admin@email.com',
            'is_admin'=>'1',
            'password'=>bcrypt('123456789')
        ]);
        $user->assignRole($role2);

        $user = \App\Models\User::factory()->create([
            'name' => 'lawyer',
            'email' => 'lawyer@email.com',
            'is_admin'=>'1',
            'password'=>bcrypt('123456789')
        ]);
        $user->assignRole($role3);
    }
}
