<?php

Route::group(['prefix' => 'v1', 'as' => 'api.', 'namespace' => 'Api\V1\Admin', 'middleware' => ['auth:sanctum']], function () {
    // Users
    Route::post('users/media', 'UsersApiController@storeMedia')->name('users.storeMedia');
    Route::apiResource('users', 'UsersApiController');

    // Countries
    Route::apiResource('countries', 'CountriesApiController');

    // Province
    Route::apiResource('provinces', 'ProvinceApiController');

    // User Alerts
    Route::apiResource('user-alerts', 'UserAlertsApiController', ['except' => ['update']]);

    // Crm Status
    Route::apiResource('crm-statuses', 'CrmStatusApiController');

    // Crm Customer
    Route::apiResource('crm-customers', 'CrmCustomerApiController');

    // Crm Note
    Route::apiResource('crm-notes', 'CrmNoteApiController');

    // Crm Document
    Route::post('crm-documents/media', 'CrmDocumentApiController@storeMedia')->name('crm-documents.storeMedia');
    Route::apiResource('crm-documents', 'CrmDocumentApiController');

    // Faq Category
    Route::apiResource('faq-categories', 'FaqCategoryApiController');

    // Faq Question
    Route::post('faq-questions/media', 'FaqQuestionApiController@storeMedia')->name('faq-questions.storeMedia');
    Route::apiResource('faq-questions', 'FaqQuestionApiController');

    // Task Status
    Route::apiResource('task-statuses', 'TaskStatusApiController');

    // Task Tag
    Route::apiResource('task-tags', 'TaskTagApiController');

    // Task
    Route::post('tasks/media', 'TaskApiController@storeMedia')->name('tasks.storeMedia');
    Route::apiResource('tasks', 'TaskApiController');

    // Campaign Channels
    Route::apiResource('campaign-channels', 'CampaignChannelsApiController');

    // Campaign Org
    Route::apiResource('campaign-orgs', 'CampaignOrgApiController');

    // Translator
    Route::apiResource('translators', 'TranslatorApiController');

    // Ministries
    Route::apiResource('ministries', 'MinistriesApiController');

    // Settings
    Route::apiResource('settings', 'SettingsApiController', ['except' => ['store', 'show', 'destroy']]);

    // Travel Group
    Route::apiResource('travel-groups', 'TravelGroupApiController');

    // Department
    Route::apiResource('departments', 'DepartmentApiController');

    // Office
    Route::apiResource('offices', 'OfficeApiController');

    // Hospital
    Route::apiResource('hospitals', 'HospitalApiController');

    // Doctor
    Route::apiResource('doctors', 'DoctorApiController');

    // Patient
    Route::post('patients/media', 'PatientApiController@storeMedia')->name('patients.storeMedia');
    Route::apiResource('patients', 'PatientApiController');

    // Travel
    Route::apiResource('travels', 'TravelApiController');

    // Travel Treatment Activity
    Route::post('travel-treatment-activities/media', 'TravelTreatmentActivityApiController@storeMedia')->name('travel-treatment-activities.storeMedia');
    Route::apiResource('travel-treatment-activities', 'TravelTreatmentActivityApiController');

    // Activity
    Route::post('activities/media', 'ActivityApiController@storeMedia')->name('activities.storeMedia');
    Route::apiResource('activities', 'ActivityApiController');

    // Travel Status
    Route::apiResource('travel-statuses', 'TravelStatusApiController');

    // Content Category
    Route::apiResource('content-categories', 'ContentCategoryApiController');

    // Content Tag
    Route::apiResource('content-tags', 'ContentTagApiController');

    // Content Page
    Route::post('content-pages/media', 'ContentPageApiController@storeMedia')->name('content-pages.storeMedia');
    Route::apiResource('content-pages', 'ContentPageApiController');

    // Hotel
    Route::apiResource('hotels', 'HotelApiController');

    // Travel Hospital
    Route::apiResource('travel-hospitals', 'TravelHospitalApiController');

    // Expenses Income
    Route::apiResource('expenses-incomes', 'ExpensesIncomeApiController');
});
