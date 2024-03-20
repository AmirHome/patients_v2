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
});