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

    Route::group(['middleware' => ['role']], function () {

        Route::resource('rawdata','RawdataController');
        Route::resource('kpi','KpiController');
        Route::resource('recipient','recipientController');
        Route::resource('user','userController');

        Route::get('alldata', 'RawdataController@alldata');
        Route::get('alldata-list', 'RawdataController@alldataList');
        Route::get('download', 'RawdataController@download')->name("rawdata.download");
        Route::get('delete', 'RawdataController@delete')->name("rawdata.delete");

        Route::post('/send-mail', 'MailController@send')->name("mail.send");
        
        Route::get('recipient/delete/{id}', 'UserController@destroy')->name("user.delete");

    });

    Route::get('/home', 'HomeController@index')->name('home');
    Route::post('/home', 'HomeController@message')->name('home.post');
});
