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
    Route::post('countries/{country}/toggleEnabled', ['as' => 'countries.toggleEnabled', 'uses' => 'CountriesController@toggleEnabled']);
    Route::get('countries/disabled', ['as' => 'countries.disabled', 'uses' => 'CountriesController@disabled']);
    Route::resource('countries', 'CountriesController');
    Route::resource('currencies', 'CurrenciesController');
    Route::resource('users', 'UsersController');
    Route::resource('roles', 'RolesController');
    Route::resource('permissions', 'PermissionsController');

    Route::resource('bankTypes', 'BankTypesController');
    Route::resource('interestConventions', 'InterestConventionsController');
    Route::resource('interestTerms', 'InterestTermsController');
    Route::resource('banks', 'BanksController');
});
