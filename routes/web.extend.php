<?php

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => ['auth']], function () {

    Route::get('expenses-incomes/{patient}/index', 'ExpensesIncomeController@indexPatient')->name('expenses-incomes.patient.index');
    Route::get('expenses-incomes/index/{type}', 'ExpensesIncomeController@index')->name('expenses-incomes.index');
    Route::get('expenses-incomes/show/{expenses_income}', 'ExpensesIncomeController@show')->name('expenses-incomes.show');


    Route::get('report/finance', 'ExpensesIncomeController@report')->name('expenses-incomes.report.finance');


    // GUIDE Modal AJAX Route
    // crm_document
    Route::get('ajax-crm-documents/{crm_document}', 'CrmDocumentController@ajaxShow')->name('ajax.crm-documents.show');
    Route::get('ajax-activities/{activity}', 'ActivityController@ajaxShow')->name('ajax.activities.show');
    Route::get('ajax-treatmentActivities/{travel_treatment_activity}', 'TravelTreatmentActivityController@ajaxShow')->name('ajax.treatmentActivities.show');

    Route::get('ajax-provinces/{country}', 'ProvinceController@ajaxIndexByCountryId')->name('ajax.provinces.index');
    Route::get('ajax-campaign/{channel}', 'CampaignOrgController@ajaxIndexByChannelId')->name('ajax.campaign.index');
});

Route::group(['namespace' => 'Admin\Override'], function () {

    Route::get('admin/expense-reports', 'ExpenseReportController@index')->name('admin.expense-reports.index');
    Route::post('admin/expense-reports', 'ExpenseReportController@index')->name('admin.expense-reports.filter');

    //https://patientsv2.test/share/hospital/cf99236573b09963694717bfd03a3645c73b
    Route::get('share/hospital/{code}','TravelController@shares')->name('share.hospital');
    //https://patientsv2.test/share/translator/b97ad6974329f7749667d5060a40a50ca1ed
    Route::get('share/translator/{code}','TravelController@share')->name('share.translator');


    Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => ['auth']], function () {

        // Livewire
        Route::get('counter','\App\Livewire\Counter');
        Route::get('travel','\App\Livewire\Travel');

        // Override
        Route::resource('travels', 'TravelController');
        Route::get('ajax-travel-reffering/{type}', 'TravelController@ajaxIndexByType')->name('ajax.travel-reffering.index');
       

    });
});

#Support old version staffView/translator/9667/5d97f4dd7c44b29096675c799db681b80ce0
Route::get('staffView/translator/{id}/{code}', function($id, $code){
    $checkSecurityCode = makeShareCode($id, '');
    
    checkShareCode($checkSecurityCode,'');
    $checkSecurityCode = makeShareCode($id,'share_hospital');
    
    return redirect()->route('share.translator', ['code' => $checkSecurityCode]);
});

#Support old version staffView/hospital/6947/a424ded436368e3f9f10da14c23acc85
Route::get('staffView/hospital/{id}/{code}', function($id, $code){

    $checkSecurityCode = makeShareCode($id, '');
    checkShareCode($checkSecurityCode,'');

    $checkSecurityCode = makeShareCode($id,'share_hospital');

    return redirect()->route('share.hospital', ['code' => $checkSecurityCode]);
});