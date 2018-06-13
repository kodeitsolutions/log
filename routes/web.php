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

Route::get('/', 'HomeController@index');

Route::group(['middleware' => ['auth','revalidate']], function(){
	Route::get('entry', 'EntriesController@index');
	Route::get('entry/add', 'EntriesController@add');
	Route::post('entry/add', 'EntriesController@store');
	Route::get('entry/getEntry/{id}', 'EntriesController@show');
	Route::get('entry/{entry}/edit', 'EntriesController@edit');
	Route::get('entry/search', 'EntriesController@search');
	Route::get('entry/searching', 'EntriesController@searching');
	Route::patch('entry/{entry}', 'EntriesController@update');	
	Route::delete('entry/{entry}', 'EntriesController@destroy');
	Route::get('entry/print/{date}', 'EntriesController@printPDF');
	Route::post('entry/send', 'EntriesController@sendMail');
	Route::get('entry/notification/{entry}', 'EntriesController@notifications');
	Route::get('entry/{entry}/duplicate', 'EntriesController@duplicate');
	Route::get('entry/worker', 'EntriesController@worker')->name('workers');
	Route::get('entry/worker/{operation}/{id}', 'EntriesController@entryWorker');
	Route::get('unit/getUnit/{id}', 'UnitsController@show');
	Route::get('material/getMaterial/{id}', 'MaterialsController@show');
	Route::get('category/getCategory/{id}', 'CategoriesController@show');
	Route::get('shift/choose','ShiftsController@choose');	
	Route::patch('shift/choose','ShiftsController@chosen');	

	Route::get('employees/search/{data?}', 'WorkersController@search2');

	
});

Route::group(['middleware' => ['auth','user','revalidate']], function(){
	Route::get('user', 'UsersController@index');
	Route::get('user/add', 'UsersController@add');
	Route::post('user/add', 'UsersController@store');
	Route::get('user/getUser/{id}', 'UsersController@show');
	Route::get('user/search', 'UsersController@search');
	Route::get('user/searching', 'UsersController@searching');
	Route::patch('user/{user}', 'UsersController@update');
	Route::delete('user/{user}', 'UsersController@destroy');
	Route::get('user/reset/{user}', 'UsersController@resetForm');
	Route::post('user/reset/{user}','UsersController@updatePassword');

	Route::get('operation', 'OperationsController@index');
	Route::get('operation/add', 'OperationsController@add');
	Route::post('operation/add', 'OperationsController@store');
	Route::get('operation/getOperation/{id}', 'OperationsController@show');
	Route::patch('operation/{operation}', 'OperationsController@update');
	Route::get('operation/search', 'OperationsController@search');
	Route::get('operation/searching', 'OperationsController@searching');
	Route::delete('operation/{operation}','OperationsController@destroy');

	Route::get('category', 'CategoriesController@index');
	Route::get('category/add', 'CategoriesController@add');
	Route::post('category/add', 'CategoriesController@store');
	Route::patch('category/{category}', 'CategoriesController@update');
	Route::get('category/search', 'CategoriesController@search');
	Route::get('category/searching', 'CategoriesController@searching');
	Route::delete('category/{category}','CategoriesController@destroy');

	Route::get('company', 'CompaniesController@index');
	Route::get('company/add', 'CompaniesController@add');
	Route::post('company/add', 'CompaniesController@store');
	Route::get('company/getCompany/{id}', 'CompaniesController@show');
	Route::patch('company/{company}', 'CompaniesController@update');
	Route::get('company/search', 'CompaniesController@search');
	Route::get('company/searching', 'CompaniesController@searching');
	Route::delete('company/{company}','CompaniesController@destroy');

	Route::get('unit', 'UnitsController@index');
	Route::get('unit/add', 'UnitsController@add');
	Route::post('unit/add', 'UnitsController@store');	
	Route::patch('unit/{unit}', 'UnitsController@update');
	Route::get('unit/search', 'UnitsController@search');
	Route::get('unit/searching', 'UnitsController@searching');
	Route::delete('unit/{unit}','UnitsController@destroy');

	Route::get('material', 'MaterialsController@index');
	Route::get('material/add', 'MaterialsController@add');
	Route::post('material/add', 'MaterialsController@store');	
	Route::patch('material/{material}', 'MaterialsController@update');
	Route::get('material/search', 'MaterialsController@search');
	Route::get('material/searching', 'MaterialsController@searching');
	Route::delete('material/{material}','MaterialsController@destroy');

	Route::get('notification', 'NotificationsController@index');
	Route::get('notification/add', 'NotificationsController@add');
	Route::post('notification/add', 'NotificationsController@store');
	Route::get('notification/getNotification/{id}', 'NotificationsController@show');
	Route::patch('notification/{notification}', 'NotificationsController@update');
	Route::get('notification/search', 'NotificationsController@search');
	Route::get('notification/searching', 'NotificationsController@searching');
	Route::delete('notification/{notification}','NotificationsController@destroy');
	Route::get('notification/notify', 'NotificationsController@notification');
	Route::get('notification/{notification}/edit', 'NotificationsController@edit');

	Route::get('shift', 'ShiftsController@index');
	Route::get('shift/add', 'ShiftsController@add');
	Route::post('shift/add', 'ShiftsController@store');
	Route::get('shift/getShift/{id}', 'ShiftsController@show');
	Route::patch('shift/{shift}', 'ShiftsController@update');
	Route::get('shift/search', 'ShiftsController@search');
	Route::get('shift/searching', 'ShiftsController@searching');
	Route::delete('shift/{shift}','ShiftsController@destroy');

	Route::get('worker', 'WorkersController@index');
	Route::get('worker/add', 'WorkersController@add');
	Route::post('worker/add', 'WorkersController@store');
	Route::get('worker/getWorker/{id}', 'WorkersController@show');
	Route::patch('worker/{worker}', 'WorkersController@update');
	Route::get('worker/search', 'WorkersController@search');
	Route::get('worker/searching', 'WorkersController@searching');
	Route::delete('worker/{worker}','WorkersController@destroy');
	Route::get('worker/upload', 'WorkersController@upload');
	Route::post('worker/import', 'WorkersController@import');
}) ;	


