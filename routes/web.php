<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

# Overriding the latest change in Laravel 5.3 which changes the logout route to a POST request
Route::get('/logout', 'Auth\LoginController@logout');

// Admin Interface Routes
Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin'], function ()
{
    // Dashboard route
    Route::get('dashboard', ['as' => 'dashboard', 'uses' => 'DashboardController@index']);

    // Country management routes
    Route::post('countries/{country}/toggleEnabled', ['as' => 'countries.toggleEnabled', 'uses' => 'CountriesController@toggleEnabled']);
    Route::get('countries/disabled', ['as' => 'countries.disabled', 'uses' => 'CountriesController@disabled']);
    Route::resource('countries', 'CountriesController');

    // Currency management routes
    Route::post('currencies/{currency}/toggleEnabled', ['as' => 'currencies.toggleEnabled', 'uses' => 'CurrenciesController@toggleEnabled']);
    Route::get('currencies/disabled', ['as' => 'currencies.disabled', 'uses' => 'CurrenciesController@disabled']);
    Route::resource('currencies', 'CurrenciesController');

    // User (& related resources) management routes
    Route::get('users/profile', ['as' => 'users.profile', 'uses' => 'UsersController@editProfile']);
    Route::put('users/{user}/updateprofile', ['as' => 'users.updateprofile', 'uses' => 'UsersController@updateProfile']);
    Route::put('users/{user}/changepassword', ['as' => 'users.changepassword', 'uses' => 'UsersController@changePassword']);
    Route::post('users/{user}/updateavatar', ['as' => 'users.updateavatar', 'uses' => 'UsersController@updateAvatar']);
    Route::resource('users', 'UsersController');
    Route::resource('roles', 'RolesController');
    Route::resource('permissions', 'PermissionsController');
    Route::resource('depositorTypes', 'DepositorTypesController');

    // Bank (& related resources) management routes
    Route::put('banks/{bank}/updateprofile', ['as' => 'banks.updateprofile', 'uses' => 'BanksController@updateProfile']);
    Route::post('banks/{bank}/updatelogo', ['as' => 'banks.updatelogo', 'uses' => 'BanksController@updateLogo']);
    Route::resource('bankTypes', 'BankTypesController');
    Route::resource('interestConventions', 'InterestConventionsController');
    Route::resource('interestTerms', 'InterestTermsController');
    Route::resource('banks', 'BanksController');
});

// Banker Interface Routes
Route::group(['prefix' => 'banker', 'as' => 'banker.', 'namespace' => 'Banker'], function () {
    // Dashboard route
    Route::get('dashboard', ['as' => 'dashboard', 'uses' => 'DashboardController@index']);

    // OfferChances routes
    Route::post('offerChances/{offerChance}/decline', ['as' => 'offerChances.decline', 'uses' => 'OfferChancesController@decline']);
    Route::resource('offerChances', 'OfferChancesController', ['only' => ['index']]);

    // Offers routes
    Route::post('offers/{offer}/cancel', ['as' => 'offers.cancel', 'uses' => 'OffersController@cancel']);
    Route::resource('offers', 'OffersController', ['only' => ['index', 'create', 'store']]);
});

// Customer Interface Routes
Route::group(['prefix' => 'customer', 'as' => 'customer.', 'namespace' => 'Customer'], function () {
    // Dashboard route
    Route::get('dashboard', ['as' => 'dashboard', 'uses' => 'DashboardController@index']);

    // DepositorProfiles routes
    Route::resource('depositorProfiles', 'DepositorProfilesController');

    // Enquiries routes
    Route::resource('enquiries', 'EnquiriesController', ['only' => ['index', 'create', 'store']]);

    // Offers routes
    Route::get('offers/{offer}/accept', ['as' => 'offers.accept', 'uses' => 'OffersController@accept']);
    Route::post('offers/{offer}/reject', ['as' => 'offers.reject', 'uses' => 'OffersController@reject']);
    Route::resource('offers', 'OffersController', ['only' => ['index']]);
});
