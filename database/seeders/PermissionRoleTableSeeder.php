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
            // [
            //     'title' => 'viewHorizon',
            //     'display_name' => 'viewHorizon',
            // ],
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
                && $permission->title != 'travel_treatment_activity_delete'
                && $permission->title != 'travel_treatment_activity_show'
                && $permission->title != 'travel_treatment_activity_access'
                && $permission->title != 'activity_delete'
                && $permission->title != 'activity_show'
                && $permission->title != 'activity_access'
                && $permission->title != 'country_show'
                && $permission->title != 'province_show'
                && $permission->title != 'campaign_channel_show'
                && $permission->title != 'campaign_org_show'
                && $permission->title != 'travel_group_show'
                && $permission->title != 'travel_status_show'
                && $permission->title != 'travel_hospital_show' 
                && $permission->title != 'ministry_show' 
                && $permission->title != 'department_show' 
                && $permission->title != 'crm_status_show' 
                && $permission->title != 'task_status_show' 
                && $permission->title != 'faq_category_show'
                && $permission->title != 'content_category_show'
                && $permission->title != 'content_tag_show'
                && $permission->title != 'patient_show'
                && $permission->title != 'travel_show'
                && $permission->title != 'translator_show'
                && $permission->title != 'hotel_show'
                && $permission->title != 'user_alert_show'
                && $permission->title != 'hospital_show'
                && substr($permission->title, 0, 11) != 'permission_'
                && substr($permission->title, 0, 5) != 'team_';
        });
        Role::findOrFail(1)->permissions()->sync($admin_permissions->pluck('id'));

        $user_permissions = $admin_permissions->filter(function ($permission) {
            return substr($permission->title, 0, 5) != 'user_'
                && substr($permission->title, 0, 5) != 'role_'
                && $permission->title != 'viewPulse'
                && $permission->title != 'viewTelescope'
                // && $permission->title != 'viewHorizon'
                //&& substr($permission->title, 0, 11) != 'permission_'
                //&& substr($permission->title, 0, 5) != 'team_'
                ;
        });
        Role::findOrFail(2)->permissions()->sync($user_permissions);
    }
}
