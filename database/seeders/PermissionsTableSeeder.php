<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    public function run()
    {
        $permissions = [
            [
                'id'    => 1,
                'title' => 'user_management_access',
            ],
            [
                'id'    => 2,
                'title' => 'permission_create',
            ],
            [
                'id'    => 3,
                'title' => 'permission_edit',
            ],
            [
                'id'    => 4,
                'title' => 'permission_show',
            ],
            [
                'id'    => 5,
                'title' => 'permission_delete',
            ],
            [
                'id'    => 6,
                'title' => 'permission_access',
            ],
            [
                'id'    => 7,
                'title' => 'role_create',
            ],
            [
                'id'    => 8,
                'title' => 'role_edit',
            ],
            [
                'id'    => 9,
                'title' => 'role_show',
            ],
            [
                'id'    => 10,
                'title' => 'role_delete',
            ],
            [
                'id'    => 11,
                'title' => 'role_access',
            ],
            [
                'id'    => 12,
                'title' => 'user_create',
            ],
            [
                'id'    => 13,
                'title' => 'user_edit',
            ],
            [
                'id'    => 14,
                'title' => 'user_show',
            ],
            [
                'id'    => 15,
                'title' => 'user_delete',
            ],
            [
                'id'    => 16,
                'title' => 'user_access',
            ],
            [
                'id'    => 17,
                'title' => 'team_create',
            ],
            [
                'id'    => 18,
                'title' => 'team_edit',
            ],
            [
                'id'    => 19,
                'title' => 'team_show',
            ],
            [
                'id'    => 20,
                'title' => 'team_delete',
            ],
            [
                'id'    => 21,
                'title' => 'team_access',
            ],
            [
                'id'    => 22,
                'title' => 'country_create',
            ],
            [
                'id'    => 23,
                'title' => 'country_edit',
            ],
            [
                'id'    => 24,
                'title' => 'country_show',
            ],
            [
                'id'    => 25,
                'title' => 'country_delete',
            ],
            [
                'id'    => 26,
                'title' => 'country_access',
            ],
            [
                'id'    => 27,
                'title' => 'province_create',
            ],
            [
                'id'    => 28,
                'title' => 'province_edit',
            ],
            [
                'id'    => 29,
                'title' => 'province_show',
            ],
            [
                'id'    => 30,
                'title' => 'province_delete',
            ],
            [
                'id'    => 31,
                'title' => 'province_access',
            ],
            [
                'id'    => 32,
                'title' => 'report_create',
            ],
            [
                'id'    => 33,
                'title' => 'report_edit',
            ],
            [
                'id'    => 34,
                'title' => 'report_show',
            ],
            [
                'id'    => 35,
                'title' => 'report_delete',
            ],
            [
                'id'    => 36,
                'title' => 'report_access',
            ],
            [
                'id'    => 37,
                'title' => 'audit_log_show',
            ],
            [
                'id'    => 38,
                'title' => 'audit_log_access',
            ],
            [
                'id'    => 39,
                'title' => 'user_alert_create',
            ],
            [
                'id'    => 40,
                'title' => 'user_alert_show',
            ],
            [
                'id'    => 41,
                'title' => 'user_alert_delete',
            ],
            [
                'id'    => 42,
                'title' => 'user_alert_access',
            ],
            [
                'id'    => 43,
                'title' => 'basic_c_r_m_access',
            ],
            [
                'id'    => 44,
                'title' => 'crm_status_create',
            ],
            [
                'id'    => 45,
                'title' => 'crm_status_edit',
            ],
            [
                'id'    => 46,
                'title' => 'crm_status_show',
            ],
            [
                'id'    => 47,
                'title' => 'crm_status_delete',
            ],
            [
                'id'    => 48,
                'title' => 'crm_status_access',
            ],
            [
                'id'    => 49,
                'title' => 'crm_customer_create',
            ],
            [
                'id'    => 50,
                'title' => 'crm_customer_edit',
            ],
            [
                'id'    => 51,
                'title' => 'crm_customer_show',
            ],
            [
                'id'    => 52,
                'title' => 'crm_customer_delete',
            ],
            [
                'id'    => 53,
                'title' => 'crm_customer_access',
            ],
            [
                'id'    => 54,
                'title' => 'crm_note_create',
            ],
            [
                'id'    => 55,
                'title' => 'crm_note_edit',
            ],
            [
                'id'    => 56,
                'title' => 'crm_note_show',
            ],
            [
                'id'    => 57,
                'title' => 'crm_note_delete',
            ],
            [
                'id'    => 58,
                'title' => 'crm_note_access',
            ],
            [
                'id'    => 59,
                'title' => 'crm_document_create',
            ],
            [
                'id'    => 60,
                'title' => 'crm_document_edit',
            ],
            [
                'id'    => 61,
                'title' => 'crm_document_show',
            ],
            [
                'id'    => 62,
                'title' => 'crm_document_delete',
            ],
            [
                'id'    => 63,
                'title' => 'crm_document_access',
            ],
            [
                'id'    => 64,
                'title' => 'faq_management_access',
            ],
            [
                'id'    => 65,
                'title' => 'faq_category_create',
            ],
            [
                'id'    => 66,
                'title' => 'faq_category_edit',
            ],
            [
                'id'    => 67,
                'title' => 'faq_category_show',
            ],
            [
                'id'    => 68,
                'title' => 'faq_category_delete',
            ],
            [
                'id'    => 69,
                'title' => 'faq_category_access',
            ],
            [
                'id'    => 70,
                'title' => 'faq_question_create',
            ],
            [
                'id'    => 71,
                'title' => 'faq_question_edit',
            ],
            [
                'id'    => 72,
                'title' => 'faq_question_show',
            ],
            [
                'id'    => 73,
                'title' => 'faq_question_delete',
            ],
            [
                'id'    => 74,
                'title' => 'faq_question_access',
            ],
            [
                'id'    => 75,
                'title' => 'task_management_access',
            ],
            [
                'id'    => 76,
                'title' => 'task_status_create',
            ],
            [
                'id'    => 77,
                'title' => 'task_status_edit',
            ],
            [
                'id'    => 78,
                'title' => 'task_status_show',
            ],
            [
                'id'    => 79,
                'title' => 'task_status_delete',
            ],
            [
                'id'    => 80,
                'title' => 'task_status_access',
            ],
            [
                'id'    => 81,
                'title' => 'task_tag_create',
            ],
            [
                'id'    => 82,
                'title' => 'task_tag_edit',
            ],
            [
                'id'    => 83,
                'title' => 'task_tag_show',
            ],
            [
                'id'    => 84,
                'title' => 'task_tag_delete',
            ],
            [
                'id'    => 85,
                'title' => 'task_tag_access',
            ],
            [
                'id'    => 86,
                'title' => 'task_create',
            ],
            [
                'id'    => 87,
                'title' => 'task_edit',
            ],
            [
                'id'    => 88,
                'title' => 'task_show',
            ],
            [
                'id'    => 89,
                'title' => 'task_delete',
            ],
            [
                'id'    => 90,
                'title' => 'task_access',
            ],
            [
                'id'    => 91,
                'title' => 'tasks_calendar_access',
            ],
            [
                'id'    => 92,
                'title' => 'expense_management_access',
            ],
            [
                'id'    => 93,
                'title' => 'expense_category_create',
            ],
            [
                'id'    => 94,
                'title' => 'expense_category_edit',
            ],
            [
                'id'    => 95,
                'title' => 'expense_category_show',
            ],
            [
                'id'    => 96,
                'title' => 'expense_category_delete',
            ],
            [
                'id'    => 97,
                'title' => 'expense_category_access',
            ],
            [
                'id'    => 98,
                'title' => 'income_category_create',
            ],
            [
                'id'    => 99,
                'title' => 'income_category_edit',
            ],
            [
                'id'    => 100,
                'title' => 'income_category_show',
            ],
            [
                'id'    => 101,
                'title' => 'income_category_delete',
            ],
            [
                'id'    => 102,
                'title' => 'income_category_access',
            ],
            [
                'id'    => 103,
                'title' => 'expense_create',
            ],
            [
                'id'    => 104,
                'title' => 'expense_edit',
            ],
            [
                'id'    => 105,
                'title' => 'expense_show',
            ],
            [
                'id'    => 106,
                'title' => 'expense_delete',
            ],
            [
                'id'    => 107,
                'title' => 'expense_access',
            ],
            [
                'id'    => 108,
                'title' => 'income_create',
            ],
            [
                'id'    => 109,
                'title' => 'income_edit',
            ],
            [
                'id'    => 110,
                'title' => 'income_show',
            ],
            [
                'id'    => 111,
                'title' => 'income_delete',
            ],
            [
                'id'    => 112,
                'title' => 'income_access',
            ],
            [
                'id'    => 113,
                'title' => 'expense_report_create',
            ],
            [
                'id'    => 114,
                'title' => 'expense_report_edit',
            ],
            [
                'id'    => 115,
                'title' => 'expense_report_show',
            ],
            [
                'id'    => 116,
                'title' => 'expense_report_delete',
            ],
            [
                'id'    => 117,
                'title' => 'expense_report_access',
            ],
            [
                'id'    => 118,
                'title' => 'definition_access',
            ],
            [
                'id'    => 119,
                'title' => 'campaign_channel_create',
            ],
            [
                'id'    => 120,
                'title' => 'campaign_channel_edit',
            ],
            [
                'id'    => 121,
                'title' => 'campaign_channel_show',
            ],
            [
                'id'    => 122,
                'title' => 'campaign_channel_delete',
            ],
            [
                'id'    => 123,
                'title' => 'campaign_channel_access',
            ],
            [
                'id'    => 124,
                'title' => 'campaign_org_create',
            ],
            [
                'id'    => 125,
                'title' => 'campaign_org_edit',
            ],
            [
                'id'    => 126,
                'title' => 'campaign_org_show',
            ],
            [
                'id'    => 127,
                'title' => 'campaign_org_delete',
            ],
            [
                'id'    => 128,
                'title' => 'campaign_org_access',
            ],
            [
                'id'    => 129,
                'title' => 'translator_create',
            ],
            [
                'id'    => 130,
                'title' => 'translator_edit',
            ],
            [
                'id'    => 131,
                'title' => 'translator_show',
            ],
            [
                'id'    => 132,
                'title' => 'translator_delete',
            ],
            [
                'id'    => 133,
                'title' => 'translator_access',
            ],
            [
                'id'    => 134,
                'title' => 'ministry_create',
            ],
            [
                'id'    => 135,
                'title' => 'ministry_edit',
            ],
            [
                'id'    => 136,
                'title' => 'ministry_show',
            ],
            [
                'id'    => 137,
                'title' => 'ministry_delete',
            ],
            [
                'id'    => 138,
                'title' => 'ministry_access',
            ],
            [
                'id'    => 139,
                'title' => 'setting_edit',
            ],
            [
                'id'    => 140,
                'title' => 'setting_show',
            ],
            [
                'id'    => 141,
                'title' => 'setting_access',
            ],
            [
                'id'    => 142,
                'title' => 'travel_group_create',
            ],
            [
                'id'    => 143,
                'title' => 'travel_group_edit',
            ],
            [
                'id'    => 144,
                'title' => 'travel_group_show',
            ],
            [
                'id'    => 145,
                'title' => 'travel_group_delete',
            ],
            [
                'id'    => 146,
                'title' => 'travel_group_access',
            ],
            [
                'id'    => 147,
                'title' => 'department_create',
            ],
            [
                'id'    => 148,
                'title' => 'department_edit',
            ],
            [
                'id'    => 149,
                'title' => 'department_show',
            ],
            [
                'id'    => 150,
                'title' => 'department_delete',
            ],
            [
                'id'    => 151,
                'title' => 'department_access',
            ],
            [
                'id'    => 152,
                'title' => 'office_create',
            ],
            [
                'id'    => 153,
                'title' => 'office_edit',
            ],
            [
                'id'    => 154,
                'title' => 'office_show',
            ],
            [
                'id'    => 155,
                'title' => 'office_delete',
            ],
            [
                'id'    => 156,
                'title' => 'office_access',
            ],
            [
                'id'    => 157,
                'title' => 'hospital_create',
            ],
            [
                'id'    => 158,
                'title' => 'hospital_edit',
            ],
            [
                'id'    => 159,
                'title' => 'hospital_show',
            ],
            [
                'id'    => 160,
                'title' => 'hospital_delete',
            ],
            [
                'id'    => 161,
                'title' => 'hospital_access',
            ],
            [
                'id'    => 162,
                'title' => 'doctor_create',
            ],
            [
                'id'    => 163,
                'title' => 'doctor_edit',
            ],
            [
                'id'    => 164,
                'title' => 'doctor_show',
            ],
            [
                'id'    => 165,
                'title' => 'doctor_delete',
            ],
            [
                'id'    => 166,
                'title' => 'doctor_access',
            ],
            [
                'id'    => 167,
                'title' => 'profile_password_edit',
            ],
        ];

        Permission::insert($permissions);
    }
}
