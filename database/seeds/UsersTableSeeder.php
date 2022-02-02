<?php

use App\Models\User;
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
                'password'       => bcrypt('password'),
                'remember_token' => null,
                'approved'       => 1,
                'last_name'      => '',
                'phone'          => '',
                'zip_code'       => '',
                'address'        => '',
                'user_type'      => 'staff',
            ],
        ];

        User::insert($users);
    }
}
