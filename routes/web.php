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

Route::get('/', 'Admin\KijiController@index'); 
    
Route::group(['prefix' => 'admin','middleware' => 'auth'], function() {
    Route::get('kiji/create', 'Admin\KijiController@add');
    Route::post('kiji/create', 'Admin\KijiController@create');
    Route::get('kiji','Admin\KijiController@index');
    Route::get('kiji/edit','Admin\KijiController@edit');
    Route::post('kiji/edit','Admin\KijiController@update');
    
    Route::get('kiji/show','Admin\KijiController@show');
    Route::post('kiji/show','Admin\KijiController@show');
    
    Route::get('kiji/delete','Admin\KijiController@delete');
    
    Route::get('profile/create', 'Admin\ProfileController@add');
    Route::post('profile/create', 'Admin\ProfileController@create');
    
    Route::get('profile','Admin\ProfileController@index');
    Route::post('profile','Admin\ProfileController@index');
    
    Route::get('profile/edit', 'Admin\ProfileController@edit');
    Route::post('profile/edit', 'Admin\ProfileController@update');
    
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/', 'KijiController@index'); 
Route::get('kiji/show','KijiController@show');
Route::post('kiji/show','KijiController@show');


