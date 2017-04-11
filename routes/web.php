<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();
Route::get('/', 'PageController@index')->name('dashboard');

Route::get('archive', function () {})->name('archive');
Route::get('trends', function () {})->name('trends');
Route::get('statistics', function () {})->name('statistics');
Route::get('compare', function () {})->name('compare');
Route::get('status', function () {})->name('status');
Route::get('export', function () {})->name('export');

Route::get('configuration', 'PageController@configuration')->name('configuration');

Route::get('faq', function () {})->name('faq');
Route::get('feedback', function () {})->name('feedback');