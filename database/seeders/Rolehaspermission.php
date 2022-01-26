<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
class Rolehaspermission extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $Permissions = Permission::all();
        // Admin Role
        $AdminRole = Role::where("name","admin")->first();
        $AdminRole->SyncPermissions();
        foreach ($Permissions as $Permission) {
            $AdminRole->givePermissionTo($Permission['name']);
        }
    
    }
}
