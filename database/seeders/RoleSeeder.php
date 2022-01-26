<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $Roles = [
            // Create Few Roles
            ['name' => 'Admin', 'guard_name'=>'admin'],
        ];
        foreach($Roles as $Role){
            Role::create($Role);
        }
    }
}
