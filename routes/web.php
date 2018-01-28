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


Route::get('/','LoginController@getLogin')->name('login');
Route::post('/','LoginController@postLogin');

Route::group(['middleware' => ['rule:timses']],function(){
    
Route::get('/people', 'PeopleController@index');
Route::post('/people/add', 'PeopleController@store')->name('addpeople');
Route::get('/people/data','PeopleController@data')->name('datapeople');
Route::post('/people/edit','PeopleController@update')->name('editpeople');
Route::post('/people/delete','PeopleController@destroy')->name('deletepeople');

});

Route::group(['middleware' => ['rule:timses,timdes,gubernur,superadmin']],function(){
    Route::get('/changepassword','UserController@indexchange');
    Route::post('/changepassword','UserController@changepassword');

    Route::get('/home','DashboardController@index');
    Route::get('/home/data','DashboardController@data')->name('pemetaan');
});


Route::group(['middleware' => ['rule:superadmin']],function(){

Route::get('/user','UserController@index');
Route::post('/user','UserController@store')->name('adduser');
Route::get('/user/data','UserController@data')->name('datauser');
Route::post('/user/edit','UserController@update')->name('edituser');
Route::post('/user/delete','UserController@destroy')->name('deleteuser');
        
Route::get('/lokasi','TpsController@index');

Route::post('/kabupaten','TpsController@postkabupaten');
Route::get('/kabupaten/data','TpsController@datakabupaten')->name('datakabupaten');
Route::get('/kabupaten/{id}','TpsController@editkabupaten');
Route::get('/kabupaten/{id}/delete','TpsController@deletekabupaten');
Route::post('/kabupaten/edit','TpsController@updatekabupaten');

Route::post('/kecamatan','TpsController@postkecamatan');
Route::get('/kecamatan/data','TpsController@datakecamatan')->name('datakecamatan');
Route::get('/kecamatan/{id}','TpsController@editkecamatan');
Route::get('/kecamatan/{id}/delete','TpsController@deletekecamatan');
Route::post('/kecamatan/edit','TpsController@updatekecamatan');

Route::post('/desa','TpsController@postdesa');
Route::get('/desa/data','TpsController@datadesa')->name('datadesa');
Route::get('/desa/{id}','TpsController@editdesa');
Route::get('/desa/{id}/delete','TpsController@deletedesa');
Route::post('/desa/edit','TpsController@updatedesa');

Route::post('/tps','TpsController@posttps');
Route::get('/tps/data','TpsController@datatps')->name('datatps');
Route::get('/tps/{id}','TpsController@edittps');
Route::get('/tps/{id}/delete','TpsController@deletetps');
Route::post('/tps/edit','TpsController@updatetps');

});

Route::get('/logout',function (){
    Auth::logout();
    return redirect('/')->with('error', 'Logout Berhasil');
});