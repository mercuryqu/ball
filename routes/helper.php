<?php

/*
|--------------------------------------------------------------------------
| Helper Routes
|--------------------------------------------------------------------------
|
| Here is where you can register Helper routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('/sms', 'SmsController@store')->name('sms.store');
Route::post('/image/upload', 'UploadController@image')->name('image.upload');			    // Files Upload Modules
