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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes(['register' => false]);
Route::group(['middleware' => ['auth']], function () {

    Route::get('/home', 'HomeController@index')->name('home');
    Route::post('/home', 'HomeController@message');
    Route::get('alldata', 'RawdataController@alldata');
    Route::get('alldata-list', 'RawdataController@alldataList');
    Route::get('download', 'RawdataController@download')->name("rawdata.download");
    Route::get('delete', 'RawdataController@delete')->name("rawdata.delete");

    Route::resource('rawdata','RawdataController');
    Route::resource('kpi','KpiController');

});
