<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;

class ChatRoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $inputs = [
            ['name' => 'Admin', 'is_default' => 1],
            ['name' => 'Member', 'is_default' => 1],
        ];

        foreach ($inputs as $input) {
            Role::create($input);
        }

        $adminUser = User::first();
        $adminRole = Role::where('name', '=', 'Admin')->first();
        $roles = [$adminRole->id];
        /** @var User $user */
        $adminUser->roles()->sync($roles);

        $users = User::where('id', '>', $adminUser->id)->get();
        $memberRole = Role::where('name', '=', 'Member')->first();
        $memberRoles = [$memberRole->id];

        foreach ($users as $user) {
            /** @var User $user */
            $user->roles()->sync($memberRoles);
        }
    }
}
