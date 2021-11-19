<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admins = [
            [
                "name" => "Admin",
                "email" => "admin@gmail.com",
                "password" => bcrypt("admin12345"),
            ],
            [
                "name" => "Super Admin",
                "email" => "super@gmail.com",
                "password" => bcrypt("super12345"),
            ],
        ];

        foreach ($admins as $admin) {
            $adminUser = User::create($admin);
            $adminUser->roles()->attach(1);
        }

    }
}
