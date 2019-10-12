<?php

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/**
 * Admin Auth Routes
 */
Route::group(['prefix' => 'auth'], function () {
    Route::get('/login', 'Auth\LoginController@index')->name('auth.login');						// 登录页
    Route::post('/login', 'Auth\LoginController@login')->name('auth.login');					// 登录动作
    Route::delete('/logout', 'Auth\LoginController@logout')->name('auth.logout');				// 注销动作
});

/**
 * Admin Routes
 */

;Route::group(['middleware' => 'auth'], function () {
    Route::get('/', 'HomeController@index')->name('home');						                    // Admin Home
    Route::resource('/apps', 'AppsController', ['except' => 'show']);				                // Apps Modules
    //Route::resource('apps', 'AppsController');
    Route::put('/apps/{app}','AppsController@update')->name('apps.update');  
    Route::patch('/apps/{app}', 'AppsController@change')->name('apps.change');                      // Apps Change Module
    Route::resource('/topics', 'TopicsController', ['except' => 'show']);			                // Topics Modules
    Route::resource('/members', 'MembersController', ['except' => 'show']);			                // Members Modules
    Route::resource('/ad_positions', 'AdPositionsController', ['except' => 'show', 'destroy']);	    // Ad Positions Modules
    Route::resource('/comments', 'CommentsController', ['except' => 'show']);	                    // Comments Modules
    Route::resource('/replies', 'RepliesController', ['except' => ['show', 'destroy']]);            // Replies Modules
    Route::resource('/sms', 'SmsController', ['except' => ['show', 'destroy', 'create', 'edit', 'update']]);  // Sms Modules
    Route::resource('/categories', 'CategoriesController', ['except' => ['show']]);                 // Categories Modules
    Route::resource('/ads', 'AdsController', ['except' => ['show']]);                               // Categories Modules
    Route::resource('/keywords', 'KeywordsController', ['except' => ['show']]);                     // Keywords Modules
    Route::resource('/modules', 'ModulesController', ['except' => ['show']]);                       // Modules Modules
    Route::resource('/modulegables', 'ModulegablesController', ['except' => ['show', 'create', 'update', 'edit']]);      // Modulegables Modules
    Route::resource('/app_category', 'AppCategoryController', ['except' => ['show', 'create', 'update', 'edit']]);       // AppCategory Modules
    Route::resource('/app_topic', 'AppTopicController', ['except' => ['show', 'create', 'update', 'edit']]);             // AppTopic Modules
    Route::resource('/settings', 'SettingsController', ['except' => ['show', 'edit', 'destroy']]);     // Settings Modules
    Route::put('/settings', 'SettingsController@update')->name('settings.update');                     // Settings Modules
});

/**
 * Admin Common Route
 */
Route::post('/common/sort', 'CommonController@sort')->name('common.sort');                             // Common Sort
