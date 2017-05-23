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
Route::get('error', function(){
	abort(401);
});

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
	Route::get('entry/print', 'EntriesController@test');
	Route::get('category/getCategory/{id}', 'CategoriesController@show');
	Route::get('unit/getUnit/{id}', 'UnitsController@show');
	Route::get('material/getMaterial/{id}', 'MaterialsController@show');
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
}) ;	
