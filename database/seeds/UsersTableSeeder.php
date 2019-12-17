<?php

use App\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        $users = [
            [
                'id'             => 1,
                'name'           => 'Admin',
                'email'          => 'admin@admin.com',
                'password'       => '$2y$10$5M44XzThO4v416t8uCihx.LeUT36MHgHT0BTScIBqv056AZB5RlKu',
                'remember_token' => null,
            ],
        ];

        User::insert($users);
    }
}
