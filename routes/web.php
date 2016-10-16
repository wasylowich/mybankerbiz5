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

// Admin Interface Routes
Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin'], function ()
{
    Route::resource('currencies', 'CurrenciesController');
});
