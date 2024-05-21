<?php

Route::group(['prefix' => 'v1', 'as' => 'api.', 'namespace' => 'Api\V1\Admin', 'middleware' => ['auth:sanctum']], function () {
    // Team
    Route::post('teams/media', 'TeamApiController@storeMedia')->name('teams.storeMedia');
    Route::apiResource('teams', 'TeamApiController');

    // Countries
    Route::apiResource('countries', 'CountriesApiController');

    // Province
    Route::apiResource('provinces', 'ProvinceApiController');

    // Crm Customer
    Route::apiResource('crm-customers', 'CrmCustomerApiController');

    // Crm Document
    Route::post('crm-documents/media', 'CrmDocumentApiController@storeMedia')->name('crm-documents.storeMedia');
    Route::apiResource('crm-documents', 'CrmDocumentApiController');

    // Task
    Route::post('tasks/media', 'TaskApiController@storeMedia')->name('tasks.storeMedia');
    Route::apiResource('tasks', 'TaskApiController');

    // Expense Category
    Route::apiResource('expense-categories', 'ExpenseCategoryApiController');

    // Income Category
    Route::apiResource('income-categories', 'IncomeCategoryApiController');

    // Expense
    Route::apiResource('expenses', 'ExpenseApiController');

    // Income
    Route::apiResource('incomes', 'IncomeApiController');

    // Campaign Channels
    Route::apiResource('campaign-channels', 'CampaignChannelsApiController');

    // Campaign Org
    Route::apiResource('campaign-orgs', 'CampaignOrgApiController');

    // Ministries
    Route::apiResource('ministries', 'MinistriesApiController');

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

    // Hotel
    Route::apiResource('hotels', 'HotelApiController');
});
