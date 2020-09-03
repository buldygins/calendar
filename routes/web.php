<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', 'EventController@index');

Auth::routes();

Route::resource('event', 'EventController')->except('index')->middleware('auth');

Route::resource('company', 'CompanyController');

Route::get('/events', 'EventController@index')->name('event.index');

Route::get('/tester','EventController@companies');

Route::get('/test/{id}','EventController@xmlEvents');


