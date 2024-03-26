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
            $users[] = [
                'id'             => $userData->id,
                'name'           => $userData->name,
                'email'          => $userData->email,
                'password'       => ($userData->password),
                // 'remember_token' => $userData->remember_token,
                'phone'          => $userData->phone,
                'job_type'      => $userData->job_type,
            ];
            //continue;
        }


// dd($users);
        User::insert($users);
    }
}
