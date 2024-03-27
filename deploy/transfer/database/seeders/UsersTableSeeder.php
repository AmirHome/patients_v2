<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    public function run()
    {

        $usersData = DB::connection('conversion_db')->table('users')->get();

        foreach ($usersData as $userData) {
            User::create([
                'id'             => $userData->id,
                'name'           => $userData->name,
                'email'          => $userData->email,
                'password'       => ($userData->password),
                'phone'          => $userData->phone,
                'job_type'      => $userData->job_type,
            ])->roles()->sync(in_array($userData->id, [1, 66]) ? 1 : 2);
        }

        User::create([
            'id'             => 2,
            'name'           => 'Super Admin',
            'email'          => 'amir.email@yahoo.com',
            'password'       => bcrypt('123456'),
            'phone'          => '05336572550',
            'job_type'      => 1,
        ])->roles()->sync(1);
    }
}
