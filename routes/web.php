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

	Route::prefix('note')->name('note.')->group(function () {
		Route::get('/', 'NoteController@index')->middleware('role:admin')->name('index');
		Route::get('show/{comunity}', 'NoteController@show')->middleware('role:admin')->name('show');
	});

	Route::prefix('comunities')->name('comunity.')->group(function () {
		Route::get('/all', 'ComunityController@index')->name('index');
		Route::get('/create', 'ComunityController@create')->name('create');
		Route::post('/create', 'ComunityController@store')->name('create');
        Route::get('{comunity}/show', 'ComunityController@show')->name('show');
		Route::get('{comunity}/edit', 'ComunityController@edit')->name('edit');
		Route::post('{comunity}/edit', 'ComunityController@update')->name('edit');
        Route::get('{comunity}/cancel', 'ComunityController@cancelForm')->name('cancel');
        Route::post('{comunity}/cancel', 'ComunityController@cancel')->name('cancel');
    });

	Route::prefix('admin')->middleware(['role:admin'])->namespace('Admin')->name('admin.')->group(function () {
		Route::prefix('comunities')->name('comunity.')->group(function () {
			Route::get('/', 'ComunityController@index')->name('index');
            Route::get('/create', 'ComunityController@create')->name('create');
            Route::post('/create', 'ComunityController@store')->name('create');
            Route::get('{comunity}/edit', 'ComunityController@edit')->name('edit');
            Route::post('{comunity}/edit', 'ComunityController@update')->name('edit');
            Route::get('{comunity}/show', 'ComunityController@show')->name('show');
            Route::get('{comunity}/aprove', 'ComunityController@aprove')->name('aprove');
			Route::get('{comunity}/reprove', 'ComunityController@reprove')->name('reprove');
			Route::get('{comunity}/cancel', 'ComunityController@cancel')->name('cancel');
			Route::get('{comunity}/restore', 'ComunityController@restore')->name('restore');
            Route::prefix('{comunity}/offers')->name('offer.')->group(function () {
                Route::get('create', 'ComunityController@addOffer')->name('create');
                Route::post('create', 'ComunityController@attachOffer')->name('create');
                Route::get('{offer}/destroy', 'ComunityController@detachOffer')->name('destroy');
            });
		});
		Route::prefix('offers')->name('offer.')->group(function () {
			Route::get('/', 'OfferController@index')->name('index');
			Route::get('/create', 'OfferController@create')->name('create');
			Route::post('/create', 'OfferController@store')->name('create');
			Route::get('{offer}/edit', 'OfferController@edit')->name('edit');
			Route::post('{offer}/edit', 'OfferController@update')->name('edit');
			Route::get('{offer}/destroy', 'OfferController@destroy')->name('destroy');
		});
		Route::prefix('notes')->name('note.')->group(function () {
			Route::get('/', 'NoteController@index')->name('index');
			Route::get('show/{comunity}', 'NoteController@show')->name('show');
			Route::get('create', 'NoteController@create')->name('create');
			Route::post('create', 'NoteController@store')->name('create');
			Route::get('{note}/edit', 'NoteController@edit')->name('edit');
			Route::post('{note}/edit', 'NoteController@update')->name('edit');
			Route::get('{note}/destroy', 'NoteController@destroy')->name('destroy');
		});
		Route::prefix('plans')->name('plan.')->group(function () {
			Route::get('/', 'PlanController@index')->name('index');
			Route::get('create', 'PlanController@create')->name('create');
			Route::post('create', 'PlanController@store')->name('create');
			Route::get('{plan}/edit', 'PlanController@edit')->name('edit');
			Route::post('{plan}/edit', 'PlanController@update')->name('edit');
			Route::get('{plan}/destroy', 'PlanController@destroy')->name('destroy');
			Route::get('{plan}/show', 'PlanController@show')->name('show');

            Route::prefix('{plan}/offers')->name('offer.')->group(function () {
                Route::get('create', 'PlanController@addOffer')->name('create');
                Route::post('create', 'PlanController@attachOffer')->name('create');
                Route::get('{offer}/destroy', 'PlanController@detachOffer')->name('destroy');
            });
		});

        Route::prefix('invoices')->name('invoice.')->group(function () {
            Route::get('/', 'InvoiceController@index')->name('index');
            Route::get('{invoice}/cancel', 'InvoiceController@cancel')->name('cancel');
            Route::get('{invoice}/show', 'InvoiceController@show')->name('show');
        });

        Route::prefix('users')->name('user.')->group(function () {
            Route::get('/', 'UserController@index')->name('index');
            Route::get('{user}/show', 'UserController@show')->name('show');
            Route::get('{user}/edit', 'UserController@edit')->name('edit');
            Route::post('{user}/edit', 'UserController@update')->name('edit');
            Route::post('{user}/edit/status', 'UserController@editStatus')->name('edit.status');
            Route::get('{user}/reset/password', 'UserController@resetPassword')->name('resetPassword');
            Route::get('{user}/delete', 'UserController@delete')->name('delete');
            Route::get('{user}/restore', 'UserController@restore')->name('restore');
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
	Route::resource('users', 'UserController', ['except' => ['show']]);
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
});

