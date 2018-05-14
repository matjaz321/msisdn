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

Route::get('/', function () {
    return view('home');
});

Route::post('/validate', 'RecordsController@validateNumber')->name('number.validate');

Route::prefix('record')->group(function () {
  // URL /record/details/id
  Route::get('details/{record}', 'RecordsController@show')->name('record.item');
  // URL /record/list
  Route::get('list', 'RecordsController@index')->name('records.list');
});
