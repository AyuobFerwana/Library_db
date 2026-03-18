<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //

        // Permission::create(['name' => '', 'guard_name' => 'admin']);
        // Permission::create(['name' => '', 'guard_name' => 'admin']);
        // Permission::create(['name' => '', 'guard_name' => 'admin']);
        // Permission::create(['name' => '', 'guard_name' => 'admin']);


        /*********************** Admin Permission ****************************/

        Permission::create(['name' => 'Create-Book', 'guard_name' => 'admin']);
        Permission::create(['name' => 'Read-Books', 'guard_name' => 'admin']);
        Permission::create(['name' => 'update-Book', 'guard_name' => 'admin']);
        Permission::create(['name' => 'Delete-Book', 'guard_name' => 'admin']);

        Permission::create(['name' => 'Create-Department', 'guard_name' => 'admin']);
        Permission::create(['name' => 'Read-Departments', 'guard_name' => 'admin']);
        Permission::create(['name' => 'Update-Department', 'guard_name' => 'admin']);
        Permission::create(['name' => 'Delete-Department', 'guard_name' => 'admin']);

        Permission::create(['name' => 'Create-Role', 'guard_name' => 'admin']);
        Permission::create(['name' => 'Read-Roles', 'guard_name' => 'admin']);
        Permission::create(['name' => 'Update-Role', 'guard_name' => 'admin']);
        Permission::create(['name' => 'Delete-Role', 'guard_name' => 'admin']);

        Permission::create(['name' => 'Create-Permission', 'guard_name' => 'admin']);
        Permission::create(['name' => 'Read-Permissions', 'guard_name' => 'admin']);
        Permission::create(['name' => 'Update-Permission', 'guard_name' => 'admin']);
        Permission::create(['name' => 'Delete-Permission', 'guard_name' => 'admin']);

        /*********************** Publisher Permission ****************************/

        // Permission::create(['name' => 'Create-Book', 'guard_name' => 'publisher']);
        Permission::create(['name' => 'Read-Books', 'guard_name' => 'publisher']);
        // Permission::create(['name' => 'Update-Book', 'guard_name' => 'publisher']);
        // Permission::create(['name' => 'Delete-Book', 'guard_name' => 'publisher']);

        // Permission::create(['name' => 'Create-Department', 'guard_name' => 'publisher']);
        Permission::create(['name' => 'Read-Departments', 'guard_name' => 'publisher']);
        // Permission::create(['name' => 'Update-Department', 'guard_name' => 'publisher']);
        // Permission::create(['name' => 'Delete-Department', 'guard_name' => 'publisher']);
    }
}
