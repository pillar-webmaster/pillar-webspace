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

Route::middleware('auth')->group(function (){
	// Home
	Route::get('/', 'HomeController@index')->name('home');
	Route::get('profile', ['as' => 'profile.edit', 'uses' => 'ProfileController@edit']);
	Route::put('profile', ['as' => 'profile.update', 'uses' => 'ProfileController@update']);
	Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'ProfileController@password']);
	Route::get('webspace','WebspaceController@list')->name('webspace.list');
	Route::post('webspace-details','WebspaceController@details')->name('webspace.details');
	Route::get('platform-webspace','HomeController@get_platform_webspace')->name('dashboard.platform');
	Route::get('created-webspace','HomeController@get_webspace_created')->name('dashboard.webspace-created');
	Route::get('support-webspace','HomeController@get_webspace_support')->name('dashboard.support');
	Route::get('administration/export-webspace','WebspaceController@export')->name('webspace.export');
	Route::post('administration/export-to-csv','WebspaceController@export_to_csv')->name('webspace.export_to_csv');
	Route::get('changelog','HomeController@changelog')->name('changelog');
});

/* Role based routing */

/*
Route::group(['middleware' => ['role:super-admin|admin|editor|subscriber']], function () {

});*/

Route::group(['middleware' => ['role:super-admin|admin|editor']], function () {
	Route::get('webspace/edit/{id}','WebspaceController@edit')->name('webspace.edit');
	Route::get('department/edit/{id}','DepartmentController@edit')->name('department.edit');
	Route::get('designation/edit/{id}','DesignationController@edit')->name('designation.edit');
	Route::get('owner/edit/{id}','OwnerController@edit')->name('owner.edit');
	Route::get('platform/edit/{id}','PlatformController@edit')->name('platform.edit');

	Route::post('webspace/update/{id}','WebspaceController@update')->name('webspace.update');
	Route::post('department/update/{id}','DepartmentController@update')->name('department.update');
	Route::post('designation/update/{id}','DesignationController@update')->name('designation.update');
	Route::post('owner/update/{id}','OwnerController@update')->name('owner.update');
	Route::post('platform/update/{id}','PlatformController@update')->name('platform.update');
	Route::post('website/update','WebsiteController@update')->name('website.update');

	Route::get('department','DepartmentController@list')->name('department.list');
	Route::get('designation','DesignationController@list')->name('designation.list');
	Route::get('owner','OwnerController@list')->name('owner.list');
	Route::get('platform','PlatformController@list')->name('platform.list');

	Route::get('department','DepartmentController@list')->name('department.list');
	Route::get('designation','DesignationController@list')->name('designation.list');
	Route::get('owner','OwnerController@list')->name('owner.list');
	Route::get('platform','PlatformController@list')->name('platform.list');

	Route::post('department-details','DepartmentController@details')->name('department.details');
	Route::post('designation-details','DesignationController@details')->name('designation.details');
	Route::post('platform-details','PlatformController@details')->name('platform.details');
	Route::post('owner-details','OwnerController@details')->name('owner.details');
	Route::post('user-details','UserController@details')->name('user.details');

	Route::post('webspace/add-history','WebspaceController@add_history')->name('webspace.add-history');

	Route::post('/webspace/media','MediaController@create')->name('webspace.media');
	Route::post('webspace/upload-media','MediaController@store')->name('webspace.upload-media');
	Route::get('/webspace/media/download/{media_id}','MediaController@download')->name('media.download');

});

Route::group(['middleware' => ['role:super-admin|admin']], function () {
	Route::get('user', 'UserController@index')->name('user.index');
	Route::get('user/create', 'UserController@create')->name('user.create');
	Route::post('user/store', 'UserController@store')->name('user.store');
	Route::delete('user/{user}}', 'UserController@destroy')->name('user.destroy');
	Route::get('user/{user}/edit', 'UserController@edit')->name('user.edit');
	Route::put('user/{user}', 'UserController@update')->name('user.update');

	Route::get('webspace/add','WebspaceController@add')->name('webspace.add');
	Route::get('department/add','DepartmentController@add')->name('department.add');
	Route::get('designation/add','DesignationController@add')->name('designation.add');
	Route::get('owner/add','OwnerController@add')->name('owner.add');
	Route::get('platform/add','PlatformController@add')->name('platform.add');

	Route::post('webspace/create','WebspaceController@create')->name('webspace.create');
	Route::post('department/create','DepartmentController@create')->name('department.create');
	Route::post('designation/create','DesignationController@create')->name('designation.create');
	Route::post('owner/create','OwnerController@create')->name('owner.create');
	Route::post('platform/create','PlatformController@create')->name('platform.create');
	Route::post('website/create/{id}','WebsiteController@create')->name('website.create');

	Route::post('webspace/remove/{id}','WebspaceController@remove')->name('webspace.remove');
	Route::post('department/remove/{id}','DepartmentController@remove')->name('department.remove');
	Route::post('designation/remove/{id}','DesignationController@remove')->name('designation.remove');
	Route::post('owner/remove/{id}','OwnerController@remove')->name('owner.remove');
	Route::post('platform/remove/{id}','PlatformController@remove')->name('platform.remove');
	Route::post('website/remove','WebsiteController@remove')->name('website.remove');
});

Route::group(['middleware' => ['role:super-admin']], function () {
	Route::get('administration/site-settings','SettingsController@edit')->name('settings.edit');
	Route::get('administration/import-webspace','WebspaceController@import')->name('webspace.import');
	Route::post('administration/import-from-csv','WebspaceController@import_from_csv')->name('webspace.import_from_csv');
	Route::get('administration/server','ServerController@index')->name('server.list');
	Route::get('/webspace/media/download-misc/{filename}','MediaController@download_misc')->name('media.download_misc');
});

/* Permission based routing
Route::group(['middleware' => ['permission:publish articles|edit articles']], function () {
	//
});
*/

