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

Route::group(['prefix' => 'admin/services', 'namespace' => 'Admin\Services'], function() {


    Route::group(['middleware' => 'auth'], function() {
        Route::get('users', 'UsersServiceController@index');
    });
});

Route::group(['prefix' => 'admin', 'namespace' => 'Admin'], function() {


    Route::group(['middleware' => 'auth'], function() {
        Route::get('/', 'DashboardController@dashboard');

        Route::get('users', 'UsersController@index');
        Route::delete('users/{user}', 'UsersController@delete')->middleware('superadmin');
    });
});

