<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Seeder;

class PermissionRoleTableSeeder extends Seeder
{
    public function run()
    {
        $super_admin_permissions = Permission::all();
        Role::findOrFail(100)->permissions()->sync($super_admin_permissions->pluck('id'));
        
        $admin_permissions = $super_admin_permissions->filter(function ($permission) {
            return substr($permission->title, 0, 9) != 'crm_note_'
                && substr($permission->title, 0, 13) != 'crm_document_'
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
                //&& substr($permission->title, 0, 11) != 'permission_'
                //&& substr($permission->title, 0, 5) != 'team_'
                ;
        });
        Role::findOrFail(2)->permissions()->sync($user_permissions);
    }
}
