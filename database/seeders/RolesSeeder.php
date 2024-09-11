<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $superAdminRule = Role::create(['name' => 'super_admin']);
        $adminRule = Role::create(['name' => 'admin']);
        $operatorRule = Role::create(['name' => 'operator']);
        $teacherRule = Role::create(['name' => 'teacher']);

        $superAdminPermission = Permission::create(['name' => 'to_super_admin']);
        $adminPermission = Permission::create(['name' => 'to_admin']);
        $operatorPermission = Permission::create(['name' => 'to_operator']);
        $teacherPermission = Permission::create(['name' => 'to_teacher']);

        $superAdminRule->givePermissionTo($superAdminPermission);
        $adminRule->givePermissionTo($adminPermission);
        $operatorRule->givePermissionTo($operatorPermission);
        $teacherRule->givePermissionTo($teacherPermission);

        $superAdminPermission->assignRole($superAdminRule);
        $adminPermission->assignRole($adminRule);
        $operatorPermission->assignRole($operatorRule);
        $teacherPermission->assignRole($teacherRule);
    }
}
