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
                'title' => 'audit_log_show',
            ],
            [
                'id'    => 33,
                'title' => 'audit_log_access',
            ],
            [
                'id'    => 34,
                'title' => 'user_alert_create',
            ],
            [
                'id'    => 35,
                'title' => 'user_alert_show',
            ],
            [
                'id'    => 36,
                'title' => 'user_alert_delete',
            ],
            [
                'id'    => 37,
                'title' => 'user_alert_access',
            ],
            [
                'id'    => 38,
                'title' => 'basic_c_r_m_access',
            ],
            [
                'id'    => 39,
                'title' => 'crm_status_create',
            ],
            [
                'id'    => 40,
                'title' => 'crm_status_edit',
            ],
            [
                'id'    => 41,
                'title' => 'crm_status_show',
            ],
            [
                'id'    => 42,
                'title' => 'crm_status_delete',
            ],
            [
                'id'    => 43,
                'title' => 'crm_status_access',
            ],
            [
                'id'    => 44,
                'title' => 'crm_customer_create',
            ],
            [
                'id'    => 45,
                'title' => 'crm_customer_edit',
            ],
            [
                'id'    => 46,
                'title' => 'crm_customer_show',
            ],
            [
                'id'    => 47,
                'title' => 'crm_customer_delete',
            ],
            [
                'id'    => 48,
                'title' => 'crm_customer_access',
            ],
            [
                'id'    => 49,
                'title' => 'crm_note_create',
            ],
            [
                'id'    => 50,
                'title' => 'crm_note_edit',
            ],
            [
                'id'    => 51,
                'title' => 'crm_note_show',
            ],
            [
                'id'    => 52,
                'title' => 'crm_note_delete',
            ],
            [
                'id'    => 53,
                'title' => 'crm_note_access',
            ],
            [
                'id'    => 54,
                'title' => 'crm_document_create',
            ],
            [
                'id'    => 55,
                'title' => 'crm_document_edit',
            ],
            [
                'id'    => 56,
                'title' => 'crm_document_show',
            ],
            [
                'id'    => 57,
                'title' => 'crm_document_delete',
            ],
            [
                'id'    => 58,
                'title' => 'crm_document_access',
            ],
            [
                'id'    => 59,
                'title' => 'faq_management_access',
            ],
            [
                'id'    => 60,
                'title' => 'faq_category_create',
            ],
            [
                'id'    => 61,
                'title' => 'faq_category_edit',
            ],
            [
                'id'    => 62,
                'title' => 'faq_category_show',
            ],
            [
                'id'    => 63,
                'title' => 'faq_category_delete',
            ],
            [
                'id'    => 64,
                'title' => 'faq_category_access',
            ],
            [
                'id'    => 65,
                'title' => 'faq_question_create',
            ],
            [
                'id'    => 66,
                'title' => 'faq_question_edit',
            ],
            [
                'id'    => 67,
                'title' => 'faq_question_show',
            ],
            [
                'id'    => 68,
                'title' => 'faq_question_delete',
            ],
            [
                'id'    => 69,
                'title' => 'faq_question_access',
            ],
            [
                'id'    => 70,
                'title' => 'task_management_access',
            ],
            [
                'id'    => 71,
                'title' => 'task_status_create',
            ],
            [
                'id'    => 72,
                'title' => 'task_status_edit',
            ],
            [
                'id'    => 73,
                'title' => 'task_status_show',
            ],
            [
                'id'    => 74,
                'title' => 'task_status_delete',
            ],
            [
                'id'    => 75,
                'title' => 'task_status_access',
            ],
            [
                'id'    => 76,
                'title' => 'task_tag_create',
            ],
            [
                'id'    => 77,
                'title' => 'task_tag_edit',
            ],
            [
                'id'    => 78,
                'title' => 'task_tag_show',
            ],
            [
                'id'    => 79,
                'title' => 'task_tag_delete',
            ],
            [
                'id'    => 80,
                'title' => 'task_tag_access',
            ],
            [
                'id'    => 81,
                'title' => 'task_create',
            ],
            [
                'id'    => 82,
                'title' => 'task_edit',
            ],
            [
                'id'    => 83,
                'title' => 'task_show',
            ],
            [
                'id'    => 84,
                'title' => 'task_delete',
            ],
            [
                'id'    => 85,
                'title' => 'task_access',
            ],
            [
                'id'    => 86,
                'title' => 'tasks_calendar_access',
            ],
            [
                'id'    => 87,
                'title' => 'definition_access',
            ],
            [
                'id'    => 88,
                'title' => 'campaign_channel_create',
            ],
            [
                'id'    => 89,
                'title' => 'campaign_channel_edit',
            ],
            [
                'id'    => 90,
                'title' => 'campaign_channel_show',
            ],
            [
                'id'    => 91,
                'title' => 'campaign_channel_delete',
            ],
            [
                'id'    => 92,
                'title' => 'campaign_channel_access',
            ],
            [
                'id'    => 93,
                'title' => 'campaign_org_create',
            ],
            [
                'id'    => 94,
                'title' => 'campaign_org_edit',
            ],
            [
                'id'    => 95,
                'title' => 'campaign_org_show',
            ],
            [
                'id'    => 96,
                'title' => 'campaign_org_delete',
            ],
            [
                'id'    => 97,
                'title' => 'campaign_org_access',
            ],
            [
                'id'    => 98,
                'title' => 'translator_create',
            ],
            [
                'id'    => 99,
                'title' => 'translator_edit',
            ],
            [
                'id'    => 100,
                'title' => 'translator_show',
            ],
            [
                'id'    => 101,
                'title' => 'translator_delete',
            ],
            [
                'id'    => 102,
                'title' => 'translator_access',
            ],
            [
                'id'    => 103,
                'title' => 'ministry_create',
            ],
            [
                'id'    => 104,
                'title' => 'ministry_edit',
            ],
            [
                'id'    => 105,
                'title' => 'ministry_show',
            ],
            [
                'id'    => 106,
                'title' => 'ministry_delete',
            ],
            [
                'id'    => 107,
                'title' => 'ministry_access',
            ],
            [
                'id'    => 108,
                'title' => 'setting_edit',
            ],
            [
                'id'    => 109,
                'title' => 'setting_access',
            ],
            [
                'id'    => 110,
                'title' => 'travel_group_create',
            ],
            [
                'id'    => 111,
                'title' => 'travel_group_edit',
            ],
            [
                'id'    => 112,
                'title' => 'travel_group_show',
            ],
            [
                'id'    => 113,
                'title' => 'travel_group_delete',
            ],
            [
                'id'    => 114,
                'title' => 'travel_group_access',
            ],
            [
                'id'    => 115,
                'title' => 'department_create',
            ],
            [
                'id'    => 116,
                'title' => 'department_edit',
            ],
            [
                'id'    => 117,
                'title' => 'department_show',
            ],
            [
                'id'    => 118,
                'title' => 'department_delete',
            ],
            [
                'id'    => 119,
                'title' => 'department_access',
            ],
            [
                'id'    => 120,
                'title' => 'office_create',
            ],
            [
                'id'    => 121,
                'title' => 'office_edit',
            ],
            [
                'id'    => 122,
                'title' => 'office_show',
            ],
            [
                'id'    => 123,
                'title' => 'office_delete',
            ],
            [
                'id'    => 124,
                'title' => 'office_access',
            ],
            [
                'id'    => 125,
                'title' => 'hospital_create',
            ],
            [
                'id'    => 126,
                'title' => 'hospital_edit',
            ],
            [
                'id'    => 127,
                'title' => 'hospital_show',
            ],
            [
                'id'    => 128,
                'title' => 'hospital_delete',
            ],
            [
                'id'    => 129,
                'title' => 'hospital_access',
            ],
            [
                'id'    => 130,
                'title' => 'doctor_create',
            ],
            [
                'id'    => 131,
                'title' => 'doctor_edit',
            ],
            [
                'id'    => 132,
                'title' => 'doctor_show',
            ],
            [
                'id'    => 133,
                'title' => 'doctor_delete',
            ],
            [
                'id'    => 134,
                'title' => 'doctor_access',
            ],
            [
                'id'    => 135,
                'title' => 'patient_create',
            ],
            [
                'id'    => 136,
                'title' => 'patient_edit',
            ],
            [
                'id'    => 137,
                'title' => 'patient_show',
            ],
            [
                'id'    => 138,
                'title' => 'patient_delete',
            ],
            [
                'id'    => 139,
                'title' => 'patient_access',
            ],
            [
                'id'    => 140,
                'title' => 'coordination_access',
            ],
            [
                'id'    => 141,
                'title' => 'travel_create',
            ],
            [
                'id'    => 142,
                'title' => 'travel_edit',
            ],
            [
                'id'    => 143,
                'title' => 'travel_show',
            ],
            [
                'id'    => 144,
                'title' => 'travel_delete',
            ],
            [
                'id'    => 145,
                'title' => 'travel_access',
            ],
            [
                'id'    => 146,
                'title' => 'travel_treatment_activity_create',
            ],
            [
                'id'    => 147,
                'title' => 'travel_treatment_activity_edit',
            ],
            [
                'id'    => 148,
                'title' => 'travel_treatment_activity_show',
            ],
            [
                'id'    => 149,
                'title' => 'travel_treatment_activity_delete',
            ],
            [
                'id'    => 150,
                'title' => 'travel_treatment_activity_access',
            ],
            [
                'id'    => 151,
                'title' => 'activity_create',
            ],
            [
                'id'    => 152,
                'title' => 'activity_edit',
            ],
            [
                'id'    => 153,
                'title' => 'activity_show',
            ],
            [
                'id'    => 154,
                'title' => 'activity_delete',
            ],
            [
                'id'    => 155,
                'title' => 'activity_access',
            ],
            [
                'id'    => 156,
                'title' => 'travel_status_create',
            ],
            [
                'id'    => 157,
                'title' => 'travel_status_edit',
            ],
            [
                'id'    => 158,
                'title' => 'travel_status_show',
            ],
            [
                'id'    => 159,
                'title' => 'travel_status_delete',
            ],
            [
                'id'    => 160,
                'title' => 'travel_status_access',
            ],
            [
                'id'    => 161,
                'title' => 'content_management_access',
            ],
            [
                'id'    => 162,
                'title' => 'content_category_create',
            ],
            [
                'id'    => 163,
                'title' => 'content_category_edit',
            ],
            [
                'id'    => 164,
                'title' => 'content_category_show',
            ],
            [
                'id'    => 165,
                'title' => 'content_category_delete',
            ],
            [
                'id'    => 166,
                'title' => 'content_category_access',
            ],
            [
                'id'    => 167,
                'title' => 'content_tag_create',
            ],
            [
                'id'    => 168,
                'title' => 'content_tag_edit',
            ],
            [
                'id'    => 169,
                'title' => 'content_tag_show',
            ],
            [
                'id'    => 170,
                'title' => 'content_tag_delete',
            ],
            [
                'id'    => 171,
                'title' => 'content_tag_access',
            ],
            [
                'id'    => 172,
                'title' => 'content_page_create',
            ],
            [
                'id'    => 173,
                'title' => 'content_page_edit',
            ],
            [
                'id'    => 174,
                'title' => 'content_page_show',
            ],
            [
                'id'    => 175,
                'title' => 'content_page_delete',
            ],
            [
                'id'    => 176,
                'title' => 'content_page_access',
            ],
            [
                'id'    => 177,
                'title' => 'hotel_create',
            ],
            [
                'id'    => 178,
                'title' => 'hotel_edit',
            ],
            [
                'id'    => 179,
                'title' => 'hotel_show',
            ],
            [
                'id'    => 180,
                'title' => 'hotel_delete',
            ],
            [
                'id'    => 181,
                'title' => 'hotel_access',
            ],
            [
                'id'    => 182,
                'title' => 'travel_hospital_create',
            ],
            [
                'id'    => 183,
                'title' => 'travel_hospital_edit',
            ],
            [
                'id'    => 184,
                'title' => 'travel_hospital_show',
            ],
            [
                'id'    => 185,
                'title' => 'travel_hospital_delete',
            ],
            [
                'id'    => 186,
                'title' => 'travel_hospital_access',
            ],
            [
                'id'    => 187,
                'title' => 'finance_access',
            ],
            [
                'id'    => 188,
                'title' => 'expenses_income_create',
            ],
            [
                'id'    => 189,
                'title' => 'expenses_income_edit',
            ],
            [
                'id'    => 190,
                'title' => 'expenses_income_show',
            ],
            [
                'id'    => 191,
                'title' => 'expenses_income_delete',
            ],
            [
                'id'    => 192,
                'title' => 'expenses_income_access',
            ],
            [
                'id'    => 193,
                'title' => 'profile_password_edit',
            ],
        ];

        Permission::insert($permissions);
    }
}
