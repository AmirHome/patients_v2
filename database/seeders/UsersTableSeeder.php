<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

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
                'phone'          => '',
                'job_title'      => '',
            ],
        ];

        $usersData = DB::connection('conversion_db')->table('users')->get();

        foreach ($usersData as $userData) {
            $users[] = [
                'id'             => $userData->id,
                'name'           => $userData->name,
                'email'          => $userData->email,
                'password'       => ($userData->password),
                'remember_token' => $userData->remember_token,
                'phone'          => $userData->phone,
                'job_title'      => $userData->job_title,
            ];
            continue;
        }
dd($users);
        User::insert($users);
    }
}
