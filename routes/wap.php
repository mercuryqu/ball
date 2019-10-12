<?php

/*
|--------------------------------------------------------------------------
| WAP Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "wap" middleware group. Enjoy building your API!
|
*/

/** Home **/
Route::get('/', 'HomeController@index')->name('home');
Route::get('/modules', 'HomeController@modules')->name('modules.index');         // ajax
Route::get('/modules/{module}/apps', 'HomeController@moduleApps')->name('modules.apps');        // ajax

/** Search **/
Route::get('/search', 'SearchController@index')->name('search.index');
Route::get('/search/data', 'SearchController@data')->name('search.data');        // ajax

/** Categories **/
Route::get('/categories', 'CategoriesController@index')->name('categories.index');
Route::get('/categories/{category}', 'CategoriesController@show')->name('categories.show');
Route::get('/categories/{category}/apps', 'CategoriesController@apps')->name('categories.apps');        // ajax

/** Apps **/
Route::get('/apps/guide', 'AppsController@guide')->name('apps.guide');
Route::get('/apps/preview', 'AppsController@preview')->name('apps.preview');
Route::get('/apps/create', 'AppsController@create')->name('apps.create');
Route::post('/apps', 'AppsController@store')->name('apps.store');             // ajax
Route::get('/apps/{app}', 'AppsController@show')->name('apps.show');
Route::get('/apps/{app}/comments', 'AppsController@comments')->name('apps.comments');
Route::get('/apps/{app}/comments/create', 'AppsController@commentCreate')->name('apps.comments.create');
Route::post('/apps/{app}/comments/store', 'AppsController@commentStore')->name('apps.comments.store');

/** Auth **/
Route::get('/auth/login', 'LoginController@index')->name('auth.login');
Route::get('/auth/verification', 'LoginController@verification')->name('auth.verification');
Route::post('/auth/login', 'LoginController@login')->name('auth.login');             // ajax

/** Topics **/
Route::get('/topics/{topic}/show_pull', 'TopicsController@show_pull')->name('topics.show_pull');
Route::get('/topics/{topic}', 'TopicsController@show')->name('topics.show');

/** Members **/
Route::get('/members/profile', 'MembersController@show')->name('members.show');
Route::get('/members/apps', 'MembersController@index')->name('members.apps.index');