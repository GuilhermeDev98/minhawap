<?php

use Illuminate\Http\Request;

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('v1')->name('api.')->group(function(){
    Route::get('notes', 'Api\NoteController@index');

    Route::get('statistics', 'Api\StatisticsController@index');
    Route::post('{comunity}/statistics', 'Api\StatisticsController@store');
    Route::get('{comunity}/statistics', 'Api\StatisticsController@show');

    Route::prefix('domain')->group(function(){
        Route::post('search', 'Services\FreenonController@searchdomain');
    });

    Route::prefix('invoices')->name('invoices.')->group(function(){
        Route::post('{invoice}/send/sms/', 'Api\InvoiceController@sendInvoiceBySms')->name('send.sms');
        Route::post('{invoice}/send/email/', 'Api\InvoiceController@sendInvoiceByEmail')->name('send.email');
    });
});
