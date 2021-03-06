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
//Route::group([
//    'prefix'     => Loc::setLocale(),
//    'middleware' => ['localeSessionRedirect', 'localizationRedirect']
//], function () {
//    Route::get('/', 'HomePageController@show');
//    Route::get('menu', 'MenuPageController@show');
//    Route::get('events', 'EventsController@index');
//    Route::get('events/{slug}', 'EventsController@show');
//    Route::get('contact', 'ContactController@show');
//    Route::get('about', 'AboutPageController@show');
//});

Route::get('/', 'HomePageController@show');
Route::get('menu', 'MenuPageController@show');
Route::get('events', 'EventsController@index');
Route::get('events/{slug}', 'EventsController@show');
Route::get('contact', 'ContactController@show');

Route::post('contact', 'ContactController@store');

Route::get('service/instagram/feed', 'InstagramController@index');

Route::get('admin/login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('admin/login', 'Auth\LoginController@login');
Route::post('admin/logout', 'Auth\LoginController@logout')->name('logout');

// Registration Routes...
//$this->get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('admin/users', 'Auth\RegisterController@register');

// Password Reset Routes...
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset', 'Auth\ResetPasswordController@reset');

Route::group(['prefix' => 'admin/services', 'namespace' => 'Admin\Services'], function () {


    Route::group(['middleware' => 'auth'], function () {
        Route::get('users', 'UsersServiceController@index');

        Route::get('menu/groups', 'MenuGroupServicesController@index');

        Route::get('menu/items', 'MenuItemsServiceController@index');
        Route::get('menu/groups/{group}/items', 'MenuGroupItemsServicesController@index');

        Route::get('events', 'EventsServiceController@index');

        Route::get('specials', 'SpecialsServicesController@index');

        Route::get('menu/featured', 'FeaturedMenuItemsServiceController@index');

        Route::get('menu/order/lists', 'MenuOrderedListsController@show');

        Route::get('menu/pages', 'MenuPagesServiceController@index');
        Route::post('menu/pages/order', 'MenuPagesOrderController@update');

        Route::get('menu/pages/{page}/groups', 'MenuPagesMenuGroupsServicesController@index');

        Route::post('menu/pages/{page}/groups/order', 'MenuGroupsOrderController@update');

        Route::post('menu/groups/{group}/items/order', 'MenuItemsOrderController@update');

        Route::delete('media/{media}', 'MediaServicesController@delete');
    });
});

Route::group(['prefix' => 'admin', 'namespace' => 'Admin'], function () {


    Route::group(['middleware' => 'auth'], function () {
        Route::get('/', 'DashboardController@dashboard');

        Route::get('users', 'UsersController@index');
        Route::delete('users/{user}', 'UsersController@delete')->middleware('superadmin');

        Route::get('users/passwords', 'UsersPasswordController@edit');
        Route::post('users/passwords', 'UsersPasswordController@update');

        Route::get('menu/overview', 'MenuOverviewController@show');

        Route::get('menu/pages', 'MenuPagesController@index');
        Route::get('menu/pages/{page}', 'MenuPagesController@show');
        Route::post('menu/pages', 'MenuPagesController@store');
        Route::post('menu/pages/{page}', 'MenuPagesController@update');
        Route::delete('menu/pages/{page}', 'MenuPagesController@delete');



        Route::post('menu/pages/{page}/publish', 'MenuPagePublishingController@update');

        Route::post('menu/pages/{page}/groups', 'MenuPagesMenuGroupsController@store');
        Route::delete('menu/pages/{page}/groups/{group}', 'MenuPagesMenuGroupsController@delete');

        Route::get('menu/groups', 'MenuGroupController@index');
        Route::get('menu/groups/{group}', 'MenuGroupController@show');
        Route::post('menu/groups', 'MenuGroupController@store');
        Route::post('menu/groups/{group}', 'MenuGroupController@update');
        Route::delete('menu/groups/{group}', 'MenuGroupController@delete');

        Route::post('menu/groups/{group}/publish', 'MenuGroupPublishingController@update');

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
        Route::post('events/{event}/feature', 'EventsFeaturingController@update');
        Route::post('events/{event}/image', 'EventsImageController@store');

        Route::get('specials', 'SpecialsController@index');
        Route::post('specials', 'SpecialsController@store');
        Route::post('specials/{special}', 'SpecialsController@update');
        Route::delete('specials/{special}', 'SpecialsController@delete');

        Route::post('specials/{special}/image', 'SpecialImagesController@store');
        Route::post('specials/{special}/publish', 'SpecialPublishingController@update');

        Route::delete('specials/{special}/dated', 'DatedSpecialsController@delete');

        Route::get('menu/featured', 'FeaturedMenuItemsController@index');
        Route::post('menu/featured', 'FeaturedMenuItemsController@update');
        Route::delete('menu/featured/{menuItemId}', 'FeaturedMenuItemsController@delete');
    });
});

