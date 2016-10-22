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
    Route::resource('currencies', 'CurrenciesController');
    Route::resource('users', 'UsersController');
    Route::resource('roles', 'RolesController');
    Route::resource('permissions', 'PermissionsController');
});
