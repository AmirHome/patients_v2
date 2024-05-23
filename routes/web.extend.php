<?php
Route::group(['namespace' => 'Admin\Override'], function () {

    //https://patientsv2.test/share/hospital/cf99236573b09963694717bfd03a3645c73b
    Route::get('share/hospital/{code}','TravelController@shares')->name('share.hospital');
    //https://patientsv2.test/share/translator/b97ad6974329f7749667d5060a40a50ca1ed
    Route::get('share/translator/{code}','TravelController@share')->name('share.translator');


    Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => ['auth']], function () {

        // Livewire
        Route::get('counter','\App\Livewire\Counter');
        Route::get('travel','\App\Livewire\Travel');

        // Override
        // Route::get('travels','TravelController@index')->name('travels.index');


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