<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;


class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            PermissionSeeder::class,
            RoleSeeder::class,
            Rolehaspermission::class,
            AdminSeeder::class,
            CountrySeeder::class,
            StateSeeder::class,
            CitySeeder::class,
        ]);
    }
}
