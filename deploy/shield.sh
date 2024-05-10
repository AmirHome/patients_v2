#!/bin/bash

# Laravel DB, Seeder
mkdir -p deploy/transfer/app/Models
mkdir -p deploy/transfer/app/Http/Controllers/Admin
mkdir -p deploy/transfer/database/seeders
mkdir -p deploy/transfer/database/migrations
mkdir -p deploy/transfer/config
# Development
mkdir -p deploy/transfer/resources/views/layouts
mkdir -p deploy/transfer/resources/views/admin
mkdir -p deploy/transfer/app/Providers

cp database/patients_db_old.sql deploy/transfer/database

# Core: Change Quick Admin Panel
cp database/seeders/PermissionRoleTableSeeder.php deploy/transfer/database/seeders
cp database/seeders/RolesTableSeeder.php deploy/transfer/database/seeders
cp database/seeders/DatabaseSeeder.php deploy/transfer/database/seeders
cp database/seeders/UsersTableSeeder.php deploy/transfer/database/seeders

# travelStatus
mkdir -p deploy/transfer/resources/views/admin/travelStatuses/relationships
cp app/Http/Controllers/Admin/TravelStatusController.php deploy/transfer/app/Http/Controllers/Admin
cp resources/views/admin/travelStatuses/index.blade.php deploy/transfer/resources/views/admin/travelStatuses
cp resources/views/admin/travelStatuses/relationships/formFilter.blade.php deploy/transfer/resources/views/admin/travelStatuses/relationships

#$ php artisan make:seeder ActivityTableSeeder
cp database/seeders/CampaignsTableSeeder.php deploy/transfer/database/seeders
cp database/seeders/CountriesTableSeeder.php deploy/transfer/database/seeders
cp database/seeders/ProvinceTableSeeder.php deploy/transfer/database/seeders
cp database/seeders/TravelStatusTableSeeder.php deploy/transfer/database/seeders
cp database/seeders/TranslatorTableSeeder.php deploy/transfer/database/seeders
cp database/seeders/MinistryTableSeeder.php deploy/transfer/database/seeders
cp database/seeders/TravelGroupTableSeeder.php deploy/transfer/database/seeders
cp database/seeders/SettingTableSeeder.php deploy/transfer/database/seeders
cp database/seeders/CustomersTableSeeder.php deploy/transfer/database/seeders
cp database/seeders/CrmStatusTableSeeder.php deploy/transfer/database/seeders
cp database/seeders/OfficeTableSeeder.php deploy/transfer/database/seeders
cp database/seeders/DepartmentTableSeeder.php deploy/transfer/database/seeders
cp database/seeders/HospitalTableSeeder.php deploy/transfer/database/seeders
cp database/seeders/DoctorTableSeeder.php deploy/transfer/database/seeders
cp database/seeders/PatientTableSeeder.php deploy/transfer/database/seeders
cp database/seeders/TravelTableSeeder.php deploy/transfer/database/seeders
cp database/seeders/TravelTreatmentActivityTableSeeder.php deploy/transfer/database/seeders
cp database/seeders/ActivityTableSeeder.php deploy/transfer/database/seeders

## Chat DB
# cp config/permission.php deploy/transfer/config

cp database/migrations/chat_2014_10_12_000000_create_users_table.php deploy/transfer/database/migrations
cp database/migrations/chat_2019_09_16_051035_create_conversations_table.php deploy/transfer/database/migrations
cp database/migrations/chat_2019_11_12_104216_add_permission_tables.php deploy/transfer/database/migrations
cp database/migrations/chat_2019_11_14_083512_add_is_default_in_roles_table.php deploy/transfer/database/migrations
cp database/migrations/chat_2019_11_19_054306_create_message_action_table.php deploy/transfer/database/migrations
cp database/migrations/chat_2019_12_07_103316_create_social_accounts_table.php deploy/transfer/database/migrations
cp database/migrations/chat_2019_12_13_035642_create_blocked_users_table.php deploy/transfer/database/migrations
cp database/migrations/chat_2019_12_19_052201_add_hard_delete_field_into_message_action_table.php deploy/transfer/database/migrations
cp database/migrations/chat_2019_12_23_062919_create_groups_table.php deploy/transfer/database/migrations
cp database/migrations/chat_2019_12_23_063618_create_group_users_table.php deploy/transfer/database/migrations
cp database/migrations/chat_2019_12_23_063933_refactor_conversations_table_fields.php deploy/transfer/database/migrations
cp database/migrations/chat_2019_12_24_090549_create_group_message_recipients.php deploy/transfer/database/migrations
cp database/migrations/chat_2019_12_28_091028_create_last_conversations_table.php deploy/transfer/database/migrations
cp database/migrations/chat_2020_02_21_121653_add_reply_id_into_conversations_table.php deploy/transfer/database/migrations
cp database/migrations/chat_2020_03_25_113611_create_notifications_table.php deploy/transfer/database/migrations
cp database/migrations/chat_2020_04_01_102138_add_new_field_in_conversations_table.php deploy/transfer/database/migrations
cp database/migrations/chat_2020_04_02_075922_create_archived_users_table.php deploy/transfer/database/migrations
cp database/migrations/chat_2020_04_21_080910_make_url_details_field_nullable_in_conversations_table.php deploy/transfer/database/migrations
cp database/migrations/chat_2020_04_24_054555_create_chat_request_table.php deploy/transfer/database/migrations
cp database/migrations/chat_2020_04_24_091607_create_user_status_table.php deploy/transfer/database/migrations
cp database/migrations/chat_2020_06_03_065505_create_reported_users_table.php deploy/transfer/database/migrations
cp database/migrations/chat_2020_06_04_103406_create_settings_table.php deploy/transfer/database/migrations
cp database/migrations/chat_2020_06_25_091239_add_index_on_order_by_columns_in_users_table.php deploy/transfer/database/migrations
cp database/migrations/chat_2020_06_25_094224_add_index_on_order_by_columns_in_reported_users_table.php deploy/transfer/database/migrations
cp database/migrations/chat_2020_06_25_095142_add_index_on_order_by_columns_in_roles_table.php deploy/transfer/database/migrations
cp database/migrations/chat_2020_06_25_100538_add_index_on_order_by_columns_in_conversations_table.php deploy/transfer/database/migrations
cp database/migrations/chat_2020_06_25_101143_add_index_on_order_by_columns_in_notifications_table.php deploy/transfer/database/migrations
cp database/migrations/chat_2020_06_25_101342_add_index_on_order_by_columns_in_groups_table.php deploy/transfer/database/migrations
cp database/migrations/chat_2020_06_25_101618_add_index_on_order_by_columns_in_group_users_table.php deploy/transfer/database/migrations
cp database/migrations/chat_2020_10_19_125524_create_user_devices_table.php deploy/transfer/database/migrations
cp database/migrations/chat_2020_10_19_133700_move_all_existing_devices_to_new_table.php deploy/transfer/database/migrations
cp database/migrations/chat_2020_12_18_072323_create_zoom_meeting.php deploy/transfer/database/migrations
cp database/migrations/chat_2020_12_18_072614_meeting_candidates.php deploy/transfer/database/migrations
cp database/migrations/chat_2020_12_21_130245_add_status_and_uuid_into_zoom_meetings_table.php deploy/transfer/database/migrations
cp database/migrations/chat_2020_12_26_065943_add_time_zone_field_into_zoom_meetings_table.php deploy/transfer/database/migrations
cp database/migrations/chat_2022_03_02_120506_change_duration_field_type_in_zoom_meetings_table.php deploy/transfer/database/migrations
cp database/migrations/chat_2023_03_15_060446_create_front_cms_table.php deploy/transfer/database/migrations
cp database/migrations/chat_2023_08_23_084806_create_zoom_o_auth_credentials_table.php deploy/transfer/database/migrations

cp database/seeders/ChatAddDefaultSettingSeeder.php deploy/transfer/database/seeders
cp database/seeders/ChatAddPWAIconFieldSettingSeeder.php deploy/transfer/database/seeders
cp database/seeders/ChatCreatePermissionSeeder.php deploy/transfer/database/seeders
cp database/seeders/ChatFrontCmsSeeder.php deploy/transfer/database/seeders
# cp database/seeders/ChatRoleTableSeeder.php deploy/transfer/database/seeders
# cp database/seeders/ChatSetIsDefaultSuperAdminSeeder.php deploy/transfer/database/seeders

cp app/Models/ChatSetting.php deploy/transfer/app/Models
cp config/chat.php deploy/transfer/config

cp -r app/Interfaces deploy/transfer/app
cp -r app/Helpers deploy/transfer/app

cp config/panel.php deploy/transfer/config
cp config/database.php deploy/transfer/config
cp config/media-library.php deploy/transfer/config
cp config/telescope.php deploy/transfer/config


cp resources/views/layouts/admin.blade.php deploy/transfer/resources/views/layouts
cp resources/views/layouts/app.blade.php deploy/transfer/resources/views/layouts

cp app/Providers/AppServiceProvider.php deploy/transfer/app/Providers

# LiveWire
mkdir -p app/Livewire deploy/transfer/app
mkdir -p deploy/transfer/resources/views/livewire
mkdir -p deploy/transfer/resources/views/components

rm -rf deploy/transfer/app/Livewire
rm -rf deploy/transfer/resources/views/livewire
rm -rf deploy/transfer/resources/views/components

cp -r app/Livewire deploy/transfer/app
cp -r resources/views/livewire deploy/transfer/resources/views
cp -r resources/views/components deploy/transfer/resources/views


echo  "Copied Shield files."
