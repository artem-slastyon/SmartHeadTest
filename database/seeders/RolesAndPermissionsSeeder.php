<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run(): void
    {

        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        Permission::create(['name' => 'see tickets']);
        Permission::create(['name' => 'edit tickets']);
        Permission::create(['name' => 'delete tickets']);

        Permission::create(['name' => 'see users']);
        Permission::create(['name' => 'edit users']);
        Permission::create(['name' => 'delete users']);

        app()[PermissionRegistrar::class]->forgetCachedPermissions();


        Role::create(['name' => 'admin'])
            ->givePermissionTo(Permission::all());

        Role::create(['name' => 'manager'])
            ->givePermissionTo(['see tickets', 'edit tickets']);

        Role::create(['name' => 'guest']);
    }
}
