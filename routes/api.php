<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/company/{id}/users', 'CompanyController@userlist');

Route::delete('/delete/event/{event}','EventController@apiDestroy');

Route::get('/event/{company_id}/{date}', 'EventController@checkAvailableShifts');

Route::get('/parse/{id}','Api\RssController@xmlParseToLog');

Route::get('/getdata','EventController@EventTable');

Route::delete('/test/{id}','EventController@ajaxhandle');

