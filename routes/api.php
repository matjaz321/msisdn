<?php

use Illuminate\Http\Request;

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

// API for records
Route::prefix('/record')->group(function () {
  Route::post('validate', 'APIController@validateNumber')->name('number.validate');
  Route::get('details/{record}', 'APIController@show')->name('record.item');
  Route::get('list', 'APIController@index')->name('records.list');
});
