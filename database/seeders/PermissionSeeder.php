<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

    $permissions = [
        // Role Module Permissions
        ['name'=>'role_view', 'guard_name'=>'admin'],
        ['name'=>'role_add', 'guard_name' => 'admin'],
        ['name'=>'role_edit', 'guard_name'=>'admin'],
        ['name'=>'role_delete', 'guard_name'=>'admin'],
        ['name'=>'role_has_permission', 'guard_name'=>'admin'],
        
        // Permission Module Permissions
        ['name'=>'permission_view', 'guard_name'=>'admin'],
        ['name'=>'permission_add', 'guard_name'=>'admin'],
        ['name'=>'permission_edit', 'guard_name'=>'admin'],
        ['name'=>'permission_delete', 'guard_name'=>'admin'],
        // User Module Permission
        ['name'=>'user_view', 'guard_name'=>'admin'],
        ['name'=>'user_add', 'guard_name'=>'admin'],
        ['name'=>'user_edit', 'guard_name'=>'admin'],
        ['name'=>'user_delete', 'guard_name'=>'admin'],
        ['name'=>'user_has_permission', 'guard_name'=>'admin'],

    ];
    foreach($permissions as $permission)
    {
      Permission::create($permission);
    }

    }
}
