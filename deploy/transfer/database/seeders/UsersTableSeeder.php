<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        $password = bcrypt('admin@123');
        $usersData = DB::connection('conversion_db')->table('users')->get();

        foreach ($usersData as $userData) {
            User::create([
                'id'             => $userData->id,
                'name'           => $userData->name,
                'email'          => $userData->email,
                'password'       => Config('app.debug') ? $password : $userData->password,
                'office_id'      => $userData->office_id,
                'phone'          => $userData->phone,
                'job_type'      => $userData->job_type,
                'can_see_prices'=> $userData->can_see_prices,
                'can_set_prices'=> $userData->can_set_prices,
                'is_super'      => $userData->is_super,

                'email_verified_at' => \Carbon\Carbon::now(),
                'is_active' => 1,
                'is_system' => 1,
                'is_super_admin' => false,
            ])->roles()->sync(in_array($userData->id, [1, 66]) ? 1 : 2);
        }

        User::create([
            'id'             => 2,
            'name'           => 'Super Admin',
            'email'          => 'amir.email@yahoo.com',
            'password'       => $password,
            'phone'          => '05336572550',
            'job_type'      => 1,

            'email_verified_at' => \Carbon\Carbon::now(),
            'is_active' => 1,
            'is_system' => 1,
            'is_super_admin' => true,
        ])->roles()->sync(1);

        DB::table('model_has_roles')->insert([
            ['role_id' => 1, 'model_type' => 'App\Models\User', 'model_id' => 2],
            ['role_id' => 2, 'model_type' => 'App\Models\User', 'model_id' => 66],
        ]);

    }
}
