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
Route::post('/number-validate', [
  'as' => 'number.validate',
  'uses' => 'APIController@validateNumber',
]);

Route::get('/record/{record}', [
  'as' => 'record.item',
  'uses' => 'APIController@show',
]);

Route::get('/records', [
  'as' => 'records.list',
  'uses' => 'APIController@index',
]);
