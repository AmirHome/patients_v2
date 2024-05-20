<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Seeder;

class PermissionRoleTableSeeder extends Seeder
{
    public function run()
    {
        $permissions = [
            [
                'title' => 'viewPulse',
                'display_name' => 'viewPulse',
            ],
            [
                'title' => 'viewTelescope',
                'display_name' => 'viewTelescope',
            ],
            [
                'title' => 'viewHorizon',
                'display_name' => 'viewHorizon',
            ],
        ];
        foreach ($permissions as $permission) {
            Permission::create($permission);
        }

        $super_admin_permissions = Permission::all();
        Role::findOrFail(100)->permissions()->sync($super_admin_permissions->pluck('id'));
        
        $admin_permissions = $super_admin_permissions->filter(function ($permission) {
            return substr($permission->title, 0, 9) != 'crm_note_'
                && substr($permission->title, 0, 19) != 'crm_document_access'
                && substr($permission->title, 0, 17) != 'crm_document_show'
                && substr($permission->title, 0, 9) != 'task_tag_'
                && substr($permission->title, 0, 26) != 'travel_treatment_activity_'
                && substr($permission->title, 0, 9) != 'activity_'
                && substr($permission->title, 0, 11) != 'permission_'
                && substr($permission->title, 0, 5) != 'team_';
        });
        Role::findOrFail(1)->permissions()->sync($admin_permissions->pluck('id'));

        $user_permissions = $admin_permissions->filter(function ($permission) {
            return substr($permission->title, 0, 5) != 'user_'
                && substr($permission->title, 0, 5) != 'role_'
                && $permission->title != 'viewPulse'
                && $permission->title != 'viewTelescope'
                && $permission->title != 'viewHorizon'
                //&& substr($permission->title, 0, 11) != 'permission_'
                //&& substr($permission->title, 0, 5) != 'team_'
                ;
        });
        Role::findOrFail(2)->permissions()->sync($user_permissions);
    }
}
