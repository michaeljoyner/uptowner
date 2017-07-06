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


//localised routes
Route::group([
    'prefix'     => Loc::setLocale(),
    'middleware' => ['localeSessionRedirect', 'localizationRedirect']
], function () {
    Route::get('/', function () {
        return view('front.home.page');
    });
});

Route::get('admin/login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('admin/login', 'Auth\LoginController@login');
Route::post('admin/logout', 'Auth\LoginController@logout')->name('logout');

// Registration Routes...
//$this->get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
$this->post('admin/users', 'Auth\RegisterController@register');

// Password Reset Routes...
$this->get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
$this->post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
$this->get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
$this->post('password/reset', 'Auth\ResetPasswordController@reset');

Route::group(['prefix' => 'admin/services', 'namespace' => 'Admin\Services'], function () {


    Route::group(['middleware' => 'auth'], function () {
        Route::get('users', 'UsersServiceController@index');

        Route::get('menu/groups', 'MenuGroupServicesController@index');

        Route::get('menu/groups/{group}/items', 'MenuItemServicesController@index');

        Route::get('events', 'EventsServiceController@index');

        Route::get('specials', 'SpecialsServicesController@index');
    });
});

Route::group(['prefix' => 'admin', 'namespace' => 'Admin'], function () {


    Route::group(['middleware' => 'auth'], function () {
        Route::get('/', 'DashboardController@dashboard');

        Route::get('users', 'UsersController@index');
        Route::delete('users/{user}', 'UsersController@delete')->middleware('superadmin');

        Route::get('users/passwords', 'UsersPasswordController@edit');
        Route::post('users/passwords', 'UsersPasswordController@update');

        Route::get('menu/groups', 'MenuGroupController@index');
        Route::get('menu/groups/{group}', 'MenuGroupController@show');
        Route::post('menu/groups', 'MenuGroupController@store');
        Route::post('menu/groups/{group}', 'MenuGroupController@update');

        Route::post('menu/groups/{group}/items', 'MenuItemsController@store');
        Route::post('menu/items/{item}', 'MenuItemsController@update');
        Route::delete('menu/items/{item}', 'MenuItemsController@delete');

        Route::post('menu/items/{item}/publish', 'MenuItemTogglesController@publish');
        Route::post('menu/items/{item}/spicy', 'MenuItemTogglesController@spicy');
        Route::post('menu/items/{item}/vegetarian', 'MenuItemTogglesController@vegetarian');
        Route::post('menu/items/{item}/recommended', 'MenuItemTogglesController@recommended');
        Route::post('menu/items/{item}/image', 'MenuItemsImageController@store');

        Route::get('events', 'EventsController@index');
        Route::post('events', 'EventsController@store');
        Route::post('events/{event}', 'EventsController@update');
        Route::delete('events/{event}', 'EventsController@delete');

        Route::post('events/{event}/publish', 'EventsPublishingController@update');

        Route::get('specials', 'SpecialsController@index');
        Route::post('specials', 'SpecialsController@store');
        Route::post('specials/{special}', 'SpecialsController@update');
        Route::delete('specials/{special}', 'SpecialsController@delete');

        Route::post('specials/{special}/image', 'SpecialImagesController@store');
        Route::post('specials/{special}/publish', 'SpecialPublishingController@update');
    });
});

