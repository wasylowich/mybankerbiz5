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
    // Country management routes
    Route::post('countries/{country}/toggleEnabled', ['as' => 'countries.toggleEnabled', 'uses' => 'CountriesController@toggleEnabled']);
    Route::get('countries/disabled', ['as' => 'countries.disabled', 'uses' => 'CountriesController@disabled']);
    Route::resource('countries', 'CountriesController');

    // Currency management routes
    Route::post('currencies/{currency}/toggleEnabled', ['as' => 'currencies.toggleEnabled', 'uses' => 'CurrenciesController@toggleEnabled']);
    Route::get('currencies/disabled', ['as' => 'currencies.disabled', 'uses' => 'CurrenciesController@disabled']);
    Route::resource('currencies', 'CurrenciesController');

    // User (& related resources) management routes
    Route::resource('users', 'UsersController');
    Route::resource('roles', 'RolesController');
    Route::resource('permissions', 'PermissionsController');

    // Bank (& related resources) management routes
    Route::resource('bankTypes', 'BankTypesController');
    Route::resource('interestConventions', 'InterestConventionsController');
    Route::resource('interestTerms', 'InterestTermsController');
    Route::resource('banks', 'BanksController');
});
