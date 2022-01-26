<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $Admin = [
            'name' => 'admin',
            'email' => 'admin@admin.com',
            'email_verified_at' => date('Y-m-d'),
            'is_email_verified' => 1,
            'password' => Hash::make("Admin@123#"),
    ];

        $AdminUser = Admin::create($Admin);
        $AdminUser->assignRole('Admin');
    }
}
