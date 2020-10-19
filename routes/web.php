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
        // Route::resource('rawdata-rekon','RawdataRekonController');
        Route::resource('kpi','KpiController');
        Route::resource('recipient','RecipientController');
        Route::resource('user','UserController');
        
        // routing for rawdata crm
        Route::get('alldata', 'RawdataController@alldata');
        Route::get('alldata-list', 'RawdataController@alldataList');
        Route::get('download', 'RawdataController@download')->name("rawdata.download");
        Route::get('delete', 'RawdataController@delete')->name("rawdata.delete");

        // Mail and Recipient
        Route::post('/send-mail', 'MailController@send')->name("mail.send");
        Route::get('recipient/delete/{id}', 'UserController@destroy')->name("user.delete");
        // update password and name
        // reset password each
        
        // routing for rawdata rekon
        Route::get('rawdata-rekon', 'RawdataRekonController@index');
        Route::post('rawdata-rekon', 'RawdataRekonController@store')->name('rawdata-rekon.store');
        Route::get('alldata-rekon', 'RawdataRekonController@alldata');
        Route::get('alldata-rekon-list', 'RawdataRekonController@alldataList');
        Route::get('rawdata-rekon-delete', 'RawdataRekonController@delete')->name('rawdata-rekon.delete');

        // Routing for daily report
        Route::get('daily-report','DailyReportController@index')->name('daily-report.index');
        Route::post('daily-report/dashboard', 'DailyReportController@query')->name('daily-report.query');
        Route::post('daily-report/store', 'DailyReportController@store')->name('daily-report.store');
        Route::get('alldata-daily-report', 'DailyReportController@alldata');
        Route::get('alldata-daily-report-list', 'DailyReportController@alldataList');
        Route::get('daily-report-delete', 'DailyReportController@delete')->name('daily-report.delete');
    });
    
    // routing for dashboard crm
    Route::get('/home', 'HomeController@index')->name('home');
    Route::post('/home', 'HomeController@message')->name('home.post');
    
    // routing for dashboard Rekon
    Route::get('/dashboard-rekon', 'RawdataRekonController@dashboardRekon')->name('dashboard-rekon');
    Route::post('/dashboard-rekon', 'RawdataRekonController@queryRekon')->name('dashboard-rekon.post');

    Route::get('daily-report/dashboard','DailyReportController@dashboard')->name('daily-report.dashboard');
});
