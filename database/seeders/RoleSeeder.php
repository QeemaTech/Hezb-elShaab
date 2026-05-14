<?php

namespace Database\Seeders;

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
        $super_admin = Role::create(['name' => 'super admin']);
        $admin = Role::create(['name' => 'admin']);

        $super_admin->givePermissionTo(Permission::all());
        $admin->givePermissionTo(['Events', 'News','Candidates']);
    }
}
