<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;
// use Spatie\Permission\Models\Permission;
use App\Models\Permission;
use Illuminate\Support\Facades\DB;

class ChatCreatePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            [
                'title' => 'manage_front_cms',
                'display_name' => 'Manage Front CMS',
                'guard_name' => 'web',
            ],
            [
                'title' => 'manage_users',
                'display_name' => 'Manage Users',
                'guard_name' => 'web',
            ],
            [
                'title' => 'manage_roles',
                'display_name' => 'Manage Roles',
                'guard_name' => 'web',
            ],
            [
                'title' => 'manage_reported_users',
                'display_name' => 'Manage Reported Users',
                'guard_name' => 'web',
            ],
            [
                'title' => 'manage_conversations',
                'display_name' => 'Manage Conversations',
                'guard_name' => 'web',
            ],
            [
                'title' => 'manage_settings',
                'display_name' => 'Manage Settings',
                'guard_name' => 'web',
            ],
            [
                'title' => 'manage_meetings',
                'display_name' => 'Manage Meetings',
                'guard_name' => 'web',
            ],
        ];

        foreach ($permissions as $permission) {
            Permission::create($permission);
        }

        $permissions = Permission::all();
        // foreach ($roles as $role) {
        //     $role->update(['guard_name' => 'web']);
        //     if ($role->name == 'Admin') {
        //         $role->syncPermissions(Permission::pluck('title'));
        //     } elseif ($role->name == 'Member') {
        //         $role->syncPermissions(['manage_conversations', 'manage_meetings']);
        //     } else {
        //         $role->syncPermissions(['manage_conversations']);
        //     }
        // }


        $adminPermissions = Permission::whereIn('title', [
            'manage_front_cms',
            'manage_users',
            'manage_roles',
            'manage_reported_users',
            'manage_conversations',
            'manage_settings',
            'manage_meetings',
        ])->each(function ($permission) {
            DB::table('role_has_permissions')->insert([
                'permission_id' => $permission->id,
                'role_id' => 1, // Admin
            ]);
            DB::table('role_has_permissions')->insert([
                'permission_id' => $permission->id,
                'role_id' => 100, // Super Admin
            ]);
            if ($permission->title == 'manage_conversations' || $permission->title == 'manage_meetings') {
                DB::table('role_has_permissions')->insert([
                    'permission_id' => $permission->id,
                    'role_id' => 2, // User
                ]);
            }
        });
            
        

    }
}
