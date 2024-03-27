<?php

return [
    'userManagement' => [
        'title'          => 'مدیریت کاربر',
        'title_singular' => 'مدیریت کاربر',
    ],
    'permission' => [
        'title'          => 'مجوزها',
        'title_singular' => 'مجوز',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'title'             => 'Title',
            'title_helper'      => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => ' ',
        ],
    ],
    'role' => [
        'title'          => 'نقش ها',
        'title_singular' => 'نقش',
        'fields'         => [
            'id'                 => 'ID',
            'id_helper'          => ' ',
            'title'              => 'Title',
            'title_helper'       => ' ',
            'permissions'        => 'Permissions',
            'permissions_helper' => ' ',
            'created_at'         => 'Created at',
            'created_at_helper'  => ' ',
            'updated_at'         => 'Updated at',
            'updated_at_helper'  => ' ',
            'deleted_at'         => 'Deleted at',
            'deleted_at_helper'  => ' ',
        ],
    ],
    'user' => [
        'title'          => 'کاربران',
        'title_singular' => 'استفاده کننده',
        'fields'         => [
            'id'                       => 'ID',
            'id_helper'                => ' ',
            'name'                     => 'Name',
            'name_helper'              => ' ',
            'email'                    => 'Email',
            'email_helper'             => ' ',
            'email_verified_at'        => 'Email verified at',
            'email_verified_at_helper' => ' ',
            'password'                 => 'Password',
            'password_helper'          => ' ',
            'roles'                    => 'Roles',
            'roles_helper'             => ' ',
            'remember_token'           => 'Remember Token',
            'remember_token_helper'    => ' ',
            'created_at'               => 'Created at',
            'created_at_helper'        => ' ',
            'updated_at'               => 'Updated at',
            'updated_at_helper'        => ' ',
            'deleted_at'               => 'Deleted at',
            'deleted_at_helper'        => ' ',
            'team'                     => 'Team',
            'team_helper'              => ' ',
            'phone'                    => 'Phone',
            'phone_helper'             => ' ',
            'picture'                  => 'Picture',
            'picture_helper'           => ' ',
            'job_type'                 => 'Job Type',
            'job_type_helper'          => ' ',
            'office'                   => 'Office',
            'office_helper'            => ' ',
            'can_see_prices'           => 'Can See Prices',
            'can_see_prices_helper'    => ' ',
            'can_set_prices'           => 'Can Set Prices',
            'can_set_prices_helper'    => ' ',
            'is_super'                 => 'Is Super',
            'is_super_helper'          => ' ',
        ],
    ],
    'team' => [
        'title'          => 'Teams',
        'title_singular' => 'Team',
        'fields'         => [
            'id'                     => 'ID',
            'id_helper'              => ' ',
            'created_at'             => 'Created at',
            'created_at_helper'      => ' ',
            'updated_at'             => 'Updated At',
            'updated_at_helper'      => ' ',
            'deleted_at'             => 'Deleted At',
            'deleted_at_helper'      => ' ',
            'name'                   => 'Name',
            'name_helper'            => ' ',
            'owner'                  => 'Owner',
            'owner_helper'           => ' ',
            'tax_no'                 => 'Tax Id',
            'tax_no_helper'          => ' ',
            'tax_office'             => 'Tax Office',
            'tax_office_helper'      => ' ',
            'website'                => 'Website',
            'website_helper'         => ' ',
            'address'                => 'Address',
            'address_helper'         => ' ',
            'phone'                  => 'Phone',
            'phone_helper'           => ' ',
            'email'                  => 'Email',
            'email_helper'           => ' ',
            'primary_contact'        => 'Primary Contact',
            'primary_contact_helper' => ' ',
            'logo'                   => 'Logo',
            'logo_helper'            => ' ',
            'country'                => 'Country',
            'country_helper'         => ' ',
        ],
    ],
    'country' => [
        'title'          => 'Countries',
        'title_singular' => 'Country',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'name'              => 'Name',
            'name_helper'       => ' ',
            'short_code'        => 'Short Code',
            'short_code_helper' => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => ' ',
            'code_inc'          => 'Code Inc',
            'code_inc_helper'   => ' ',
        ],
    ],
    'province' => [
        'title'          => 'Province',
        'title_singular' => 'Province',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'country'           => 'Country',
            'country_helper'    => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => ' ',
            'name'              => 'Name',
            'name_helper'       => ' ',
        ],
    ],
    'report' => [
        'title'          => 'Report',
        'title_singular' => 'Report',
    ],
    'auditLog' => [
        'title'          => 'Audit Logs',
        'title_singular' => 'Audit Log',
        'fields'         => [
            'id'                  => 'ID',
            'id_helper'           => ' ',
            'description'         => 'Description',
            'description_helper'  => ' ',
            'subject_id'          => 'Subject ID',
            'subject_id_helper'   => ' ',
            'subject_type'        => 'Subject Type',
            'subject_type_helper' => ' ',
            'user_id'             => 'User ID',
            'user_id_helper'      => ' ',
            'properties'          => 'Properties',
            'properties_helper'   => ' ',
            'host'                => 'Host',
            'host_helper'         => ' ',
            'created_at'          => 'Created at',
            'created_at_helper'   => ' ',
            'updated_at'          => 'Updated at',
            'updated_at_helper'   => ' ',
        ],
    ],
    'userAlert' => [
        'title'          => 'User Alerts',
        'title_singular' => 'User Alert',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'alert_text'        => 'Alert Text',
            'alert_text_helper' => ' ',
            'alert_link'        => 'Alert Link',
            'alert_link_helper' => ' ',
            'user'              => 'Users',
            'user_helper'       => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => ' ',
        ],
    ],
    'basicCRM' => [
        'title'          => 'Basic CRM',
        'title_singular' => 'Basic CRM',
    ],
    'crmStatus' => [
        'title'          => 'Statuses',
        'title_singular' => 'Status',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'name'              => 'Name',
            'name_helper'       => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated At',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted At',
            'deleted_at_helper' => ' ',
        ],
    ],
    'crmCustomer' => [
        'title'          => 'Customers',
        'title_singular' => 'Customer',
        'fields'         => [
            'id'                 => 'ID',
            'id_helper'          => ' ',
            'first_name'         => 'First name',
            'first_name_helper'  => ' ',
            'last_name'          => 'Last name',
            'last_name_helper'   => ' ',
            'status'             => 'Status',
            'status_helper'      => ' ',
            'email'              => 'Email',
            'email_helper'       => ' ',
            'phone'              => 'Phone',
            'phone_helper'       => ' ',
            'address'            => 'Address',
            'address_helper'     => ' ',
            'skype'              => 'Skype',
            'skype_helper'       => ' ',
            'website'            => 'Website',
            'website_helper'     => ' ',
            'description'        => 'Description',
            'description_helper' => ' ',
            'created_at'         => 'Created at',
            'created_at_helper'  => ' ',
            'updated_at'         => 'Updated At',
            'updated_at_helper'  => ' ',
            'deleted_at'         => 'Deleted At',
            'deleted_at_helper'  => ' ',
            'birthday'           => 'Birthday',
            'birthday_helper'    => ' ',
            'city'               => 'City',
            'city_helper'        => ' ',
            'campaign'           => 'Campaign',
            'campaign_helper'    => ' ',
        ],
    ],
    'crmNote' => [
        'title'          => 'Notes',
        'title_singular' => 'Note',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'customer'          => 'Customer',
            'customer_helper'   => ' ',
            'note'              => 'Note',
            'note_helper'       => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated At',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted At',
            'deleted_at_helper' => ' ',
        ],
    ],
    'crmDocument' => [
        'title'          => 'Documents',
        'title_singular' => 'Document',
        'fields'         => [
            'id'                   => 'ID',
            'id_helper'            => ' ',
            'customer'             => 'Customer',
            'customer_helper'      => ' ',
            'document_file'        => 'File',
            'document_file_helper' => ' ',
            'name'                 => 'Document name',
            'name_helper'          => ' ',
            'description'          => 'Description',
            'description_helper'   => ' ',
            'created_at'           => 'Created at',
            'created_at_helper'    => ' ',
            'updated_at'           => 'Updated At',
            'updated_at_helper'    => ' ',
            'deleted_at'           => 'Deleted At',
            'deleted_at_helper'    => ' ',
        ],
    ],
    'faqManagement' => [
        'title'          => 'FAQ Management',
        'title_singular' => 'FAQ Management',
    ],
    'faqCategory' => [
        'title'          => 'Categories',
        'title_singular' => 'Category',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'category'          => 'Category',
            'category_helper'   => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated At',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted At',
            'deleted_at_helper' => ' ',
        ],
    ],
    'faqQuestion' => [
        'title'          => 'Questions',
        'title_singular' => 'Question',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'category'          => 'Category',
            'category_helper'   => ' ',
            'question'          => 'Question',
            'question_helper'   => ' ',
            'answer'            => 'Answer',
            'answer_helper'     => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated At',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted At',
            'deleted_at_helper' => ' ',
        ],
    ],
    'taskManagement' => [
        'title'          => 'Task management',
        'title_singular' => 'Task management',
    ],
    'taskStatus' => [
        'title'          => 'Statuses',
        'title_singular' => 'Status',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'name'              => 'Name',
            'name_helper'       => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated At',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted At',
            'deleted_at_helper' => ' ',
        ],
    ],
    'taskTag' => [
        'title'          => 'Tags',
        'title_singular' => 'Tag',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'name'              => 'Name',
            'name_helper'       => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated At',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted At',
            'deleted_at_helper' => ' ',
        ],
    ],
    'task' => [
        'title'          => 'Tasks',
        'title_singular' => 'Task',
        'fields'         => [
            'id'                 => 'ID',
            'id_helper'          => ' ',
            'name'               => 'Name',
            'name_helper'        => ' ',
            'description'        => 'Description',
            'description_helper' => ' ',
            'status'             => 'Status',
            'status_helper'      => ' ',
            'tag'                => 'Tags',
            'tag_helper'         => ' ',
            'attachment'         => 'Attachment',
            'attachment_helper'  => ' ',
            'due_date'           => 'Due date',
            'due_date_helper'    => ' ',
            'assigned_to'        => 'Assigned to',
            'assigned_to_helper' => ' ',
            'created_at'         => 'Created at',
            'created_at_helper'  => ' ',
            'updated_at'         => 'Updated At',
            'updated_at_helper'  => ' ',
            'deleted_at'         => 'Deleted At',
            'deleted_at_helper'  => ' ',
        ],
    ],
    'tasksCalendar' => [
        'title'          => 'Calendar',
        'title_singular' => 'Calendar',
    ],
    'expenseManagement' => [
        'title'          => 'مدیریت مصارف',
        'title_singular' => 'مدیریت مصارف',
    ],
    'expenseCategory' => [
        'title'          => 'دسته بندی های هزینه',
        'title_singular' => 'طبقه بندی هزینه',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'name'              => 'Name',
            'name_helper'       => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated At',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted At',
            'deleted_at_helper' => ' ',
        ],
    ],
    'incomeCategory' => [
        'title'          => 'دسته بندی های درآمد',
        'title_singular' => 'دسته درآمد',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'name'              => 'Name',
            'name_helper'       => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated At',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted At',
            'deleted_at_helper' => ' ',
        ],
    ],
    'expense' => [
        'title'          => 'مصارف',
        'title_singular' => 'مصرف',
        'fields'         => [
            'id'                      => 'ID',
            'id_helper'               => ' ',
            'expense_category'        => 'Expense Category',
            'expense_category_helper' => ' ',
            'entry_date'              => 'Entry Date',
            'entry_date_helper'       => ' ',
            'amount'                  => 'Amount',
            'amount_helper'           => ' ',
            'description'             => 'Description',
            'description_helper'      => ' ',
            'created_at'              => 'Created at',
            'created_at_helper'       => ' ',
            'updated_at'              => 'Updated At',
            'updated_at_helper'       => ' ',
            'deleted_at'              => 'Deleted At',
            'deleted_at_helper'       => ' ',
        ],
    ],
    'income' => [
        'title'          => 'درآمد',
        'title_singular' => 'درآمد',
        'fields'         => [
            'id'                     => 'ID',
            'id_helper'              => ' ',
            'income_category'        => 'Income Category',
            'income_category_helper' => ' ',
            'entry_date'             => 'Entry Date',
            'entry_date_helper'      => ' ',
            'amount'                 => 'Amount',
            'amount_helper'          => ' ',
            'description'            => 'Description',
            'description_helper'     => ' ',
            'created_at'             => 'Created at',
            'created_at_helper'      => ' ',
            'updated_at'             => 'Updated At',
            'updated_at_helper'      => ' ',
            'deleted_at'             => 'Deleted At',
            'deleted_at_helper'      => ' ',
        ],
    ],
    'expenseReport' => [
        'title'          => 'گزارش ماهانه',
        'title_singular' => 'گزارش ماهانه',
        'reports'        => [
            'title'             => 'گزارش ها',
            'title_singular'    => 'گزارش',
            'incomeReport'      => 'گزارش درآمد',
            'incomeByCategory'  => 'درآمد بر اساس طبقه بندی',
            'expenseByCategory' => 'هزینه بر اساس طبقه بندی',
            'income'            => 'درآمد',
            'expense'           => 'مصرف',
            'profit'            => 'سود',
        ],
    ],
    'definition' => [
        'title'          => 'Definition',
        'title_singular' => 'Definition',
    ],
    'campaignChannel' => [
        'title'          => 'Campaign Channels',
        'title_singular' => 'Campaign Channel',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'title'             => 'Title',
            'title_helper'      => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => ' ',
        ],
    ],
    'campaignOrg' => [
        'title'          => 'Campaign Org',
        'title_singular' => 'Campaign Org',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'title'             => 'Title',
            'title_helper'      => ' ',
            'channel'           => 'Channel',
            'channel_helper'    => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => ' ',
            'started_at'        => 'Started At',
            'started_at_helper' => ' ',
            'status'            => 'Status',
            'status_helper'     => ' ',
        ],
    ],
    'translator' => [
        'title'          => 'Translator',
        'title_singular' => 'Translator',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'title'             => 'Title',
            'title_helper'      => ' ',
            'email'             => 'Email',
            'email_helper'      => ' ',
            'phone'             => 'Phone',
            'phone_helper'      => ' ',
            'city'              => 'City',
            'city_helper'       => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => ' ',
        ],
    ],
    'ministry' => [
        'title'          => 'Ministries',
        'title_singular' => 'Ministry',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'name'              => 'Name',
            'name_helper'       => ' ',
            'code'              => 'Code',
            'code_helper'       => ' ',
            'code_inc'          => 'Code Inc',
            'code_inc_helper'   => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => ' ',
        ],
    ],
    'setting' => [
        'title'          => 'Settings',
        'title_singular' => 'Setting',
        'fields'         => [
            'id'                               => 'ID',
            'id_helper'                        => ' ',
            'central_hospital_mail'            => 'Central Hospital Mail',
            'central_hospital_mail_helper'     => 'comma separator',
            'central_hospital_mail_cc'         => 'Central Hospital Mail Cc',
            'central_hospital_mail_cc_helper'  => ' ',
            'central_hospital_mail_bcc'        => 'Central Hospital Mail Bcc',
            'central_hospital_mail_bcc_helper' => ' ',
            'created_at'                       => 'Created at',
            'created_at_helper'                => ' ',
            'updated_at'                       => 'Updated at',
            'updated_at_helper'                => ' ',
            'deleted_at'                       => 'Deleted at',
            'deleted_at_helper'                => ' ',
        ],
    ],
    'travelGroup' => [
        'title'          => 'Travel Groups',
        'title_singular' => 'Travel Group',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'name'              => 'Name',
            'name_helper'       => ' ',
            'color'             => 'Color',
            'color_helper'      => '#AA0000',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => ' ',
        ],
    ],
    'department' => [
        'title'          => 'Departments',
        'title_singular' => 'Department',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'name'              => 'Name',
            'name_helper'       => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => ' ',
        ],
    ],
    'office' => [
        'title'          => 'Offices',
        'title_singular' => 'Office',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'name'              => 'Name',
            'name_helper'       => ' ',
            'phone'             => 'Phone',
            'phone_helper'      => ' ',
            'fax'               => 'Fax',
            'fax_helper'        => ' ',
            'address'           => 'Address',
            'address_helper'    => ' ',
            'city'              => 'City',
            'city_helper'       => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => ' ',
        ],
    ],
    'hospital' => [
        'title'          => 'Hospitals',
        'title_singular' => 'Hospital',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'name'              => 'Name',
            'name_helper'       => ' ',
            'email'             => 'Email',
            'email_helper'      => ' ',
            'phone'             => 'Phone',
            'phone_helper'      => ' ',
            'fax'               => 'Fax',
            'fax_helper'        => ' ',
            'address'           => 'Address',
            'address_helper'    => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => ' ',
        ],
    ],
    'doctor' => [
        'title'          => 'Doctors',
        'title_singular' => 'Doctor',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'name'              => 'Name',
            'name_helper'       => ' ',
            'phone'             => 'Phone',
            'phone_helper'      => ' ',
            'email'             => 'Email',
            'email_helper'      => ' ',
            'address'           => 'Address',
            'address_helper'    => ' ',
            'city'              => 'City',
            'city_helper'       => ' ',
            'hospital'          => 'Hospital',
            'hospital_helper'   => ' ',
            'department'        => 'Department',
            'department_helper' => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => ' ',
        ],
    ],
    'patient' => [
        'title'          => 'Patients',
        'title_singular' => 'Patient',
        'fields'         => [
            'id'                     => 'ID',
            'id_helper'              => ' ',
            'user'                   => 'User',
            'user_helper'            => ' ',
            'office'                 => 'Office',
            'office_helper'          => ' ',
            'campaign_org'           => 'Campaign Org',
            'campaign_org_helper'    => ' ',
            'city'                   => 'City',
            'city_helper'            => ' ',
            'name'                   => 'Name',
            'name_helper'            => ' ',
            'middle_name'            => 'Middle Name',
            'middle_name_helper'     => ' ',
            'surname'                => 'Surname',
            'surname_helper'         => ' ',
            'mother_name'            => 'Mother Name',
            'mother_name_helper'     => ' ',
            'father_name'            => 'Father Name',
            'father_name_helper'     => ' ',
            'citizenship'            => 'Citizenship',
            'citizenship_helper'     => ' ',
            'passport_no'            => 'Passport No',
            'passport_no_helper'     => ' ',
            'passport_origin'        => 'Passport Origin',
            'passport_origin_helper' => ' ',
            'phone'                  => 'Phone',
            'phone_helper'           => ' ',
            'foriegn_phone'          => 'Foriegn Phone',
            'foriegn_phone_helper'   => ' ',
            'email'                  => 'Email',
            'email_helper'           => ' ',
            'gender'                 => 'Gender',
            'gender_helper'          => ' ',
            'birthday'               => 'Birthday',
            'birthday_helper'        => ' ',
            'birth_place'            => 'Birth Place',
            'birth_place_helper'     => ' ',
            'address'                => 'Address',
            'address_helper'         => ' ',
            'weight'                 => 'Weight',
            'weight_helper'          => ' ',
            'height'                 => 'Height',
            'height_helper'          => ' ',
            'blood_group'            => 'Blood Group',
            'blood_group_helper'     => ' ',
            'code'                   => 'Code',
            'code_helper'            => ' ',
            'photo'                  => 'Photo',
            'photo_helper'           => ' ',
            'created_at'             => 'Created at',
            'created_at_helper'      => ' ',
            'updated_at'             => 'Updated at',
            'updated_at_helper'      => ' ',
            'deleted_at'             => 'Deleted at',
            'deleted_at_helper'      => ' ',
        ],
    ],
    'coordination' => [
        'title'          => 'Coordinations',
        'title_singular' => 'Coordination',
    ],
    'travel' => [
        'title'          => 'Travels',
        'title_singular' => 'Travel',
        'fields'         => [
            'id'                             => 'ID',
            'id_helper'                      => ' ',
            'patient'                        => 'Patient',
            'patient_helper'                 => ' ',
            'group'                          => 'Group',
            'group_helper'                   => ' ',
            'hospital'                       => 'Hospital',
            'hospital_helper'                => ' ',
            'department'                     => 'Department',
            'department_helper'              => ' ',
            'status'                         => 'Status',
            'status_helper'                  => ' ',
            'attendant_name'                 => 'Attendant Name',
            'attendant_name_helper'          => ' ',
            'attendant_address'              => 'Attendant Address',
            'attendant_address_helper'       => ' ',
            'attendant_phone'                => 'Attendant Phone',
            'attendant_phone_helper'         => ' ',
            'has_pestilence'                 => 'Has Pestilence',
            'has_pestilence_helper'          => ' ',
            'hospital_mail_notify'           => 'Hospital Mail Notify',
            'hospital_mail_notify_helper'    => 'comma separate',
            'reffering'                      => 'Reffering',
            'reffering_helper'               => ' ',
            'reffering_type'                 => 'Reffering Type',
            'reffering_type_helper'          => ' ',
            'reffering_other'                => 'Reffering Other',
            'reffering_other_helper'         => ' ',
            'hospitalization_date'           => 'Hospitalization Date',
            'hospitalization_date_helper'    => ' ',
            'planning_discharge_date'        => 'Planning Discharge Date',
            'planning_discharge_date_helper' => ' ',
            'arrival_date'                   => 'Arrival Date',
            'arrival_date_helper'            => ' ',
            'departure_date'                 => 'Departure Date',
            'departure_date_helper'          => ' ',
            'wants_shopping'                 => 'Wants Shopping',
            'wants_shopping_helper'          => ' ',
            'visa_status'                    => 'Visa Status',
            'visa_status_helper'             => ' ',
            'visa_start_date'                => 'Visa Start Date',
            'visa_start_date_helper'         => ' ',
            'visa_end_date'                  => 'Visa End Date',
            'visa_end_date_helper'           => ' ',
            'created_at'                     => 'Created at',
            'created_at_helper'              => ' ',
            'updated_at'                     => 'Updated at',
            'updated_at_helper'              => ' ',
            'deleted_at'                     => 'Deleted at',
            'deleted_at_helper'              => ' ',
        ],
    ],
    'travelTreatmentActivity' => [
        'title'          => 'Travel Treatment Activity',
        'title_singular' => 'Travel Treatment Activity',
        'fields'         => [
            'id'                 => 'ID',
            'id_helper'          => ' ',
            'user'               => 'User',
            'user_helper'        => ' ',
            'travel'             => 'Travel',
            'travel_helper'      => ' ',
            'description'        => 'Description',
            'description_helper' => ' ',
            'created_at'         => 'Created at',
            'created_at_helper'  => ' ',
            'updated_at'         => 'Updated at',
            'updated_at_helper'  => ' ',
            'deleted_at'         => 'Deleted at',
            'deleted_at_helper'  => ' ',
            'status'             => 'Status',
            'status_helper'      => ' ',
            'files'              => 'Files',
            'files_helper'       => ' ',
        ],
    ],
    'travelTreatmentStatus' => [
        'title'          => 'Travel Treatment Status',
        'title_singular' => 'Travel Treatment Status',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'title'             => 'Title',
            'title_helper'      => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => ' ',
        ],
    ],
    'activity' => [
        'title'          => 'Activity',
        'title_singular' => 'Activity',
        'fields'         => [
            'id'                 => 'ID',
            'id_helper'          => ' ',
            'user'               => 'User',
            'user_helper'        => ' ',
            'travel'             => 'Travel',
            'travel_helper'      => ' ',
            'description'        => 'Description',
            'description_helper' => ' ',
            'status'             => 'Status',
            'status_helper'      => ' ',
            'created_at'         => 'Created at',
            'created_at_helper'  => ' ',
            'updated_at'         => 'Updated at',
            'updated_at_helper'  => ' ',
            'deleted_at'         => 'Deleted at',
            'deleted_at_helper'  => ' ',
        ],
    ],

];
