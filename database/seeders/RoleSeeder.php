<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role1 = Role::create(['name' => 'Admin']);
        $role2 = Role::create(['name' => 'User']);

        Permission::create(['name' => 'admin.users.manage'])->assignRole($role1);
        Permission::create(['name' => 'admin.users.store'])->assignRole($role1);
        Permission::create(['name' => 'admin.users.update'])->assignRole($role1);
        Permission::create(['name' => 'admin.users.delete'])->assignRole($role1);
        Permission::create(['name' => 'admin.users.list'])->assignRole([$role1, $role2]);

        Permission::create(['name' => 'admin.jobs.manage'])->assignRole($role1);
        Permission::create(['name' => 'admin.jobs.store'])->assignRole($role1);
        Permission::create(['name' => 'admin.jobs.update'])->assignRole($role1);
        Permission::create(['name' => 'admin.jobs.delete'])->assignRole($role1);
        Permission::create(['name' => 'admin.jobs.list'])->assignRole([$role1, $role2]);
    }
}
