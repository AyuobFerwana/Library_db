<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        /**************** ADMIN Roles ********************/
        $superAdminRole = Role::create(['name' => 'Super Admin', 'guard_name' => 'admin']);
        $superAdminRole->givePermissionTo(Permission::where('guard_name', 'admin')->get());
        $admin = Admin::where('id', 1)->first();
        $admin->assignRole($superAdminRole);
        Role::create(['name' => 'Content Managment', 'guard_name' => 'admin']);
        Role::create(['name' => 'HR Managment', 'guard_name' => 'admin']);

        /**************** Publisher Roles ********************/

        Role::create(['name' => 'Super Publisher', 'guard_name' => 'publisher']);
    }
}
