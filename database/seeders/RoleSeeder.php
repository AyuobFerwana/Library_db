<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
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
        Role::create(['name' => 'Super Admin', 'guard_name' => 'admin']);
        Role::create(['name' => 'Content Managment', 'guard_name' => 'admin']);
        Role::create(['name' => 'HR Managment', 'guard_name' => 'admin']);

        /**************** Publisher Roles ********************/

        Role::create(['name' => 'Super Publisher', 'guard_name' => 'publisher']);
    }
}
