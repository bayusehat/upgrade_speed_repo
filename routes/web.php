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

//Mola
Route::get('/mola','MolaController@index');
Route::post('/mola/insert','MolaController@insert');
Route::get('/mola/get','MolaController@getMolaDapros');
Route::get('/mola/notif/{param}','MolaController@mola_notif');

// Route::group(['middleware' => ['web']], function () {
Route::get('/','FormController@index');
Route::get('/home','FormController@home');
Route::post('/register','FormController@register');
Route::post('/getnumber','FormController@getNumber');
Route::get('/file/get','ApiController@getFileUploads');
Route::get('/tes','FormController@tes');
//Minipack
// Route::get('/minipack','FormMinipackController@index');
// Route::get('/mola','FormMinipackController@mola');
// Route::get('/myih','FormMinipackController@myih');
// Route::post('/register_minipack','FormMinipackController@register');
// Route::post('/getnumber_minipack','FormMinipackController@getNumber');
// });
Route::get('/login','LoginController@login');
Route::post('/dologin','LoginController@doLogin');
Route::get('/dologout','LoginController@doLogout');
Route::get('/create/admin','LoginController@create_admin');

Route::get('showuser','FormController@showuser');

Route::group(['middleware' => ['authlogin','web']],function(){
    Route::get('/obc','ObcController@index');
    Route::get('/obc/load','ObcController@loadData');
    Route::get('/obc/edit/{id}','ObcController@edit');
    Route::post('/obc/update/{id}','ObcController@update');

    Route::get('/oplang','OplangController@index');
    Route::get('/oplang/load','OplangController@loadData');
    Route::get('/oplang/edit/{id}','OplangController@edit');
    Route::post('/oplang/update/{id}','OplangController@update');

    //Mola
    Route::get('/oplang/mola','MolaController@view');
    Route::get('/oplang/mola/load','MolaController@listData');
    Route::get('/oplang/mola/edit/{id}','MolaController@edit');
    Route::post('/oplang/mola/update/{id}','MolaController@update');
    
    Route::get('report/sukses','ReportController@get_sukses_report');
    Route::get('report/anomali','ReportController@get_anomali_report');
    
    Route::get('/load_report','ReportController@getReport');
});
Route::get('/report_witel','ReportController@index');
Route::get('/download','ReportController@downloadReport');
Route::get('/notif','NotificationController@getNotification');
