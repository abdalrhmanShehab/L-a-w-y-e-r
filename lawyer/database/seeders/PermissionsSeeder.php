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

        // create permissions
        Permission::create(['name' => 'get users']);
        Permission::create(['name' => 'edit user']);
        Permission::create(['name' => 'delete user']);
        Permission::create(['name' => 'create user']);
        Permission::create(['name' => 'view user']);
        Permission::create(['name' => 'edit role']);
        Permission::create(['name' => 'get roles']);
        Permission::create(['name' => 'delete role']);
        Permission::create(['name' => 'create role']);
        Permission::create(['name' => 'view role']);

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


        $role3 = Role::create(['name' => 'Super-Admin']);
        // gets all permissions via Gate::before rule; In AuthServiceProvider

        // create demo users
        $user = \App\Models\User::factory()->create([
            'name' => 'user User',
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
            'name' => 'Super-Admin',
            'email' => 'superadmin@admin.com',
            'is_admin'=>'1',
            'password'=>bcrypt('123456789')
        ]);
        $user->assignRole($role3);
    }
}
