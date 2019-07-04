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

//Route::get('/', function () {
//    return view('welcome');
//});
Route::middleware('auth')->group(function (){
    // Home
    Route::get('/', 'HomeController@index')->name('home');
});

Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');
//Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home')->middleware('auth');

Route::middleware('auth')->group(function (){
	Route::get('table-list', function () {
		return view('pages.table_list');
	})->name('table');

	Route::get('typography', function () {
		return view('pages.typography');
	})->name('typography');

	Route::get('icons', function () {
		return view('pages.icons');
	})->name('icons');

	Route::get('map', function () {
		return view('pages.map');
	})->name('map');

	Route::get('notifications', function () {
		return view('pages.notifications');
	})->name('notifications');

	Route::get('rtl-support', function () {
		return view('pages.language');
	})->name('language');

	Route::get('upgrade', function () {
		return view('pages.upgrade');
	})->name('upgrade');

	Route::get('webspace','WebspaceController@list')->name('webspace.list');
	Route::get('department','DepartmentController@list')->name('department.list');
	Route::get('designation','DesignationController@list')->name('designation.list');
	Route::get('owner','OwnerController@list')->name('owner.list');
	Route::get('platform','PlatformController@list')->name('platform.list');

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

});

Route::middleware('auth')->group(function (){
	Route::resource('user', 'UserController', ['except' => ['show']]);
	Route::get('profile', ['as' => 'profile.edit', 'uses' => 'ProfileController@edit']);
	Route::put('profile', ['as' => 'profile.update', 'uses' => 'ProfileController@update']);
	Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'ProfileController@password']);
});

