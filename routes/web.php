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

Route::get('/','LoginController@getLogin');

Route::group(['middleware' => ['rule:user']],function(){
    
});
Route::get('/user','UserController@index');
    Route::post('/user','UserController@store')->name('adduser');
    Route::get('/user/data','UserController@data')->name('datauser');
    Route::post('/user/edit','UserController@update')->name('edituser');
    Route::post('/user/delete','UserController@destroy')->name('deleteuser');
