<?php


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['prefix' => 'v1'], function () {
    Route::post('dsmr/raw', 'ApiController@DsmrTelegramRaw');

    Route::get('cost-price', 'CostPriceController@index');
    Route::get('cost-price/last/{type}', 'CostPriceController@last');
    Route::post('cost-price', 'CostPriceController@store');

    Route::resource('settings', 'SettingController', ['except' => [
        'create', 'edit',
    ]]);
});
