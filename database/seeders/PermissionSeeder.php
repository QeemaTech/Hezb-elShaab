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
        Permission::create(['name' => 'Events']);
        Permission::create(['name' => 'News']);
        Permission::create(['name' => 'Candidate']);
        Permission::create(['name' => 'User']);
        Permission::create(['name' => 'User List']);
        Permission::create(['name' => 'User Create']);
        Permission::create(['name' => 'User Update']);
        Permission::create(['name' => 'User Delete']);
        Permission::create(['name' => 'User Member Action']);

        
    }
}
