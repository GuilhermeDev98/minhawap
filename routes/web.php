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

Route::get('/', function () {
    return view('welcome');
});
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => 'auth'], function () {
	Route::resource('user', 'UserController', ['except' => ['show']]);
	Route::get('profile', ['as' => 'profile.edit', 'uses' => 'ProfileController@edit']);
	Route::put('profile', ['as' => 'profile.update', 'uses' => 'ProfileController@update']);
	Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'ProfileController@password']);
	Route::get('{page}', ['as' => 'page.index', 'uses' => 'PageController@index']);
	
	Route::prefix('note')->name('note.')->group(function () {
		Route::get('/', 'Admin\NoteController@index')->middleware('role:admin')->name('index');
		Route::get('show/{comunity}', 'NoteController@show')->middleware('role:admin')->name('show');		
	});

	Route::prefix('comunity')->name('comunity.')->group(function () {
		Route::get('/', 'ComunityController@index')->middleware('role:admin')->name('index');
		Route::get('{comunity}', 'ComunityController@show')->middleware('role:admin')->name('show');
	});

	Route::prefix('admin')->middleware(['role:admin'])->name('admin.')->group(function () {
		Route::prefix('comunity')->name('comunity.')->group(function () {
			Route::get('/', 'Admin\ComunityController@index')->middleware('role:admin')->name('index');
		});
		Route::prefix('note')->name('note.')->group(function () {
			Route::get('/', 'Admin\NoteController@index')->name('index');
			Route::get('show/{comunity}', 'Admin\NoteController@show')->middleware('role:admin')->name('show');		
			Route::get('create', 'Admin\NoteController@create')->name('create');
			Route::post('create', 'Admin\NoteController@store')->name('create');
			Route::get('edit/{note}', 'Admin\NoteController@edit')->name('edit');
			Route::post('edit/{note}', 'Admin\NoteController@update')->name('edit');
			Route::get('destroy/{note}', 'Admin\NoteController@destroy')->name('destroy');
		});
	});
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home')->middleware('auth');

Route::group(['middleware' => 'auth'], function () {
		Route::get('icons', ['as' => 'pages.icons', 'uses' => 'PageController@icons']);
		Route::get('maps', ['as' => 'pages.maps', 'uses' => 'PageController@maps']);
		Route::get('notifications', ['as' => 'pages.notifications', 'uses' => 'PageController@notifications']);
		Route::get('rtl', ['as' => 'pages.rtl', 'uses' => 'PageController@rtl']);
		Route::get('tables', ['as' => 'pages.tables', 'uses' => 'PageController@tables']);
		Route::get('typography', ['as' => 'pages.typography', 'uses' => 'PageController@typography']);
		Route::get('upgrade', ['as' => 'pages.upgrade', 'uses' => 'PageController@upgrade']);
});

Route::group(['middleware' => 'auth'], function () {
	Route::resource('user', 'UserController', ['except' => ['show']]);
	Route::get('profile', ['as' => 'profile.edit', 'uses' => 'ProfileController@edit']);
	Route::put('profile', ['as' => 'profile.update', 'uses' => 'ProfileController@update']);
	Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'ProfileController@password']);
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => 'auth'], function () {
	Route::resource('user', 'UserController', ['except' => ['show']]);
	Route::get('profile', ['as' => 'profile.edit', 'uses' => 'ProfileController@edit']);
	Route::put('profile', ['as' => 'profile.update', 'uses' => 'ProfileController@update']);
	Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'ProfileController@password']);
	Route::get('{page}', ['as' => 'page.index', 'uses' => 'PageController@index']);
});

